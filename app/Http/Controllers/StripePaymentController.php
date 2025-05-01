<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Cart,Plant,User,Order,OrderDetail};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
// use Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use App\Rules\NumWords;
use Illuminate\Support\Facades\Hash;
use Session;
use Stripe;



class StripePaymentController extends Controller

{
    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripe()

    {
        return view('stripe');

    }



    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        parse_str(urldecode($request->checkoutInformation),$checkoutInfo);
        $shipping = explode('-',$request->ship);
        $info = $checkoutInfo;

        if (!Auth::check()) {
            $name = explode(' ',$info['name']);
            $back = sprintf('%06X', mt_rand(0xFF9999, 0xFFFF00));
            $color = substr(str_shuffle('ABCDEF0123456789'), 0, 6);
            $img = "https://ui-avatars.com/api/?name=".$name[0]."+".$name[1]."&color=7F9CF5&background=EBF4FF";
            $cart = json_decode(Cookie::get('cart'),TRUE);
            $selected_item = explode('|',$info['item']);
            $user = User::create([
                'name' => $info['name'],
                'email' => $info['email'],
                'thumb' => $img,
                'password' => Hash::make($info['password']),
                'address' => $info['address'],
                'phone' => $info['phone'],
            ]);
                Auth::login($user);
                $cr = '';
                foreach ($cart as $key => $value) {
                    if (in_array($key,$selected_item)) {
                        $cartsId = Cart::insertGetId([
                            'user_id' => Auth::user()->id,
                            'plant_id' => $value['plant_id'],
                            'qty' => $value['qty'],
                            'total' => Plant::where('id',$value['plant_id'])->first()->price * $value['qty'],
                            'has_paid' => true,
                        ]);
                        $cr .= $cartsId.'|';
                    }
                }
                $info['item'] = $cr;
        }
        $kode_transaksi = 'MTPLC-PLT-#'.Str::upper(Str::random(3).time());
        if (!is_null(DB::table('vouchers')->where('code',$info['voucher_code'])->first())) {
        $disc = DB::table('vouchers')->where('code',$info['voucher_code'])->first()->disc;

        Stripe\Charge::create ([
            "amount" => ($info['total'] - ($info['total'] * $disc/100) + $shipping[1]) * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment for Transaction Code ".$kode_transaksi,
            "receipt_email" => Auth::user()->email,
            "metadata" => [
                "kode_transaksi" => $kode_transaksi,
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "address" => $info['address'],
                "phone" => Auth::user()->phone,
                "ship" => $shipping[0],
                "ship_cost" => $shipping[1],
            ],
        ]);
        $id = Order::insertGetId([
            'user_id' => Auth::id(),
            'kode_transaksi' => $kode_transaksi,
            'date'=>date('Y-m-d'),
            'total_price' => $info['total'],
            'total_price_after_disc' => $info['total'] - ($info['total'] * $disc/100),
            'tax' => 0,
            'status' => 1,
            'payment_method' => 3,
            'currency'=>"USD",
            'hasPaid'=>0,
            'discount' => $disc,
            'discount_code' => $info['voucher_code'],
            'nama_penerima' => Auth::user()->name,
            'alamat_penerima' => $info['address'],
            'email_penerima' => Auth::user()->email,
            'negara_tujuan' => $info['country'],
            'provinsi_tujuan' => $info['province'],
            'kota_tujuan' => $info['city'],
            'zipcode' => $info['zipcode'],
            'shipping_method' => $shipping[0],
            'shipping_price' => $shipping[1]
        ]);

    }else {
        Stripe\Charge::create ([
            "amount" => ($info['total'] + $shipping[1]) * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment with Transaction Code ".$kode_transaksi,
            "receipt_email" => Auth::user()->email,
            "metadata" => [
                "kode_transaksi" => $kode_transaksi,
                "name" => Auth::user()->name,
                "email" => Auth::user()->email,
                "address" => $info['address'],
                "phone" => Auth::user()->phone,
                "ship" => $shipping[0],
                "ship_cost" => $shipping[1],
            ]
        ]);

        $id = Order::insertGetId([
            'user_id' => Auth::id(),
            'kode_transaksi' => $kode_transaksi,
            'date'=>date('Y-m-d'),
            'total_price' => $info['total'],
            'total_price_after_disc' => $info['total'],
            'tax' => 0,
            'status' => 1,
            'payment_method' => 3,
            'currency'=>"USD",
            'hasPaid'=>1,
            'discount' => 0,
            'discount_code' => NULL,
            'nama_penerima' => Auth::user()->name,
            'alamat_penerima' => $info['address'],
            'email_penerima' => Auth::user()->email,
            'negara_tujuan' => $info['country'],
            'provinsi_tujuan' => $info['province'],
            'kota_tujuan' => $info['city'],
            'zipcode' => $info['zipcode'],
            'shipping_method' => $shipping[0],
            'shipping_price' => $shipping[1]
        ]);
    }

        $item = explode('|',$info['item']);
        $item = array_filter($item);
        foreach ($item as $key => $value) {
            $data = Cart::where('id',$value)->update(['order_id'=>$id]);
            $itm = Cart::where('id',$value)->first();
            Plant::where('id',$itm->plant_id)->decrement('stock', $itm->qty);
        }

        Cookie::queue(Cookie::forget('cart'));
        return redirect()->route('history-transaction');
    }


    public function getStripeCheckout(Request $request)
    {
        parse_str(urldecode($request->items[0]['checkoutInformation']),$checkoutInfo);
        $shipping = explode('-',$request->items[0]['ship']);
        $info = $checkoutInfo;


        $kode_transaksi = 'MTPLC-PLT-'.Str::upper(Str::random(3).time());

        if (!is_null(DB::table('vouchers')->where('code',$info['voucher_code'])->first())) {
        $disc = DB::table('vouchers')->where('code',$info['voucher_code'])->first()->disc;


        $paymentIntent = \Stripe\PaymentIntent::create([
            "amount" => ($info['total'] - ($info['total'] * $disc/100) + $shipping[1]) * 100,
            "currency" => "usd",
                // "source" => $request->stripeToken,
            "description" => "Payment for Transaction Code ".$kode_transaksi,
            "metadata" => [
                "kode_transaksi" => $kode_transaksi,
                "address" => $info['address'],
                "ship" => $shipping[0],
                "ship_cost" => $shipping[1],
            ],
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);

        // Stripe\Charge::create ([
        //     "amount" => ($info['total'] - ($info['total'] * $disc/100) + $shipping[1]) * 100,
        //     "currency" => "usd",
        //     "source" => $request->stripeToken,
        //     "description" => "Payment for Transaction Code ".$kode_transaksi,
        //     "receipt_email" => Auth::user()->email,
        //     "metadata" => [
        //         "kode_transaksi" => $kode_transaksi,
        //         "name" => Auth::user()->name,
        //         "email" => Auth::user()->email,
        //         "address" => $info['address'],
        //         "phone" => Auth::user()->phone,
        //         "ship" => $shipping[0],
        //         "ship_cost" => $shipping[1],
        //     ],
        // ]);



    }else {
        $paymentIntent = \Stripe\PaymentIntent::create([
                "amount" => ($info['total'] + $shipping[1]) * 100,
                "currency" => "usd",
            // "source" => $request->stripeToken,
                "description" => "Payment with Transaction Code ".$kode_transaksi,
                "metadata" => [
                    "kode_transaksi" => $kode_transaksi,
                    "address" => $info['address'],
                    "ship" => $shipping[0],
                    "ship_cost" => $shipping[1],
                ],

                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
        ]);
        // Stripe\Charge::create ([
        //     "amount" => ($info['total'] + $shipping[1]) * 100,
        //     "currency" => "usd",
        //     "source" => $request->stripeToken,
        //     "description" => "Payment with Transaction Code ".$kode_transaksi,
        //     "receipt_email" => Auth::user()->email,
        //     "metadata" => [
        //         "kode_transaksi" => $kode_transaksi,
        //         "name" => Auth::user()->name,
        //         "email" => Auth::user()->email,
        //         "address" => $info['address'],
        //         "phone" => Auth::user()->phone,
        //         "ship" => $shipping[0],
        //         "ship_cost" => $shipping[1],
        //     ]
        // ]);
    }

    // $paymentIntent = \Stripe\PaymentIntent::create([
    //     'amount' => 1400,
    //     'currency' => 'eur',
    //     'automatic_payment_methods' => [
    //         'enabled' => true,
    //     ],
    // ]);


        $output = [
            'clientSecret' => $paymentIntent->client_secret,
            'kodeTransaksi' => $kode_transaksi,
        ];
        echo json_encode($output);


    }


    public function geocodeWithRetry($fullAddress) {
        // Catat alamat asli untuk referensi
        $originalAddress = $fullAddress;

        // Fungsi dasar untuk geocoding dengan Nominatim
        function performGeocode($address) {
            // Format address for URL
            $formattedAddress = urlencode($address);

            // Create URL for Nominatim API with country code ID (Indonesia)
            $url = "https://nominatim.openstreetmap.org/search?q={$formattedAddress}&format=json&limit=1&countrycodes=id";

            // Set user agent (required by Nominatim's usage policy)
            $options = [
                'http' => [
                    'header' => "User-Agent: PHP Geocoding App/1.0\r\n",
                    'method' => 'GET'
                ]
            ];

            $context = stream_context_create($options);

            // Send request and get response
            $response = file_get_contents($url, false, $context);

            // Check if request was successful
            if ($response === false) {
                return null;
            }

            // Parse JSON response
            $data = json_decode($response, true);

            // Check if any results were returned
            if (empty($data)) {
                return null;
            }

            // Return the coordinates
            return [
                'address' => $address,
                'latitude' => $data[0]['lat'],
                'longitude' => $data[0]['lon'],
                'display_name' => $data[0]['display_name']
            ];
        }

        // ==============================================
        // STEP 1: Coba dengan alamat lengkap dulu
        // ==============================================
        $result = performGeocode($fullAddress);
        if ($result !== null) {
            return array_merge($result, ['original_address' => $originalAddress]);
        }

        // Tunggu 1 detik untuk menghormati batasan API
        sleep(1);

        // ==============================================
        // STEP 2: Pecah alamat dan buat kombinasi logis
        // ==============================================

        // Array untuk menyimpan semua kombinasi alamat yang akan dicoba
        $addressCombinations = [];

        // 2.1. Pecah berdasarkan delimiters umum (koma, slash, backslash)
        $parts = preg_split('/[,\/\\\\]/', $fullAddress);
        $parts = array_map('trim', $parts); // Bersihkan whitespace
        $parts = array_filter($parts); // Hapus elemen kosong

        // 2.2. Generasi kombinasi progresif dari elemen pertama
        for ($i = 1; $i <= count($parts); $i++) {
            $addressCombinations[] = implode(', ', array_slice($parts, 0, $i));
        }

        // 2.3. Generasi kombinasi progresif dari elemen terakhir
        for ($i = 1; $i <= count($parts); $i++) {
            $addressCombinations[] = implode(', ', array_slice($parts, -$i));
        }

        // 2.4. Coba kombinasi dari awal + akhir (jika ada cukup elemen)
        if (count($parts) >= 3) {
            $addressCombinations[] = $parts[0] . ', ' . end($parts);
            $addressCombinations[] = $parts[0] . ', ' . $parts[1] . ', ' . end($parts);
        }

        // ==============================================
        // STEP 3: Ekstraksi elemen khusus alamat
        // ==============================================

        // 3.1. Ekstrak jalan
        $streetPattern = '/\b(?:Jl\.?|Jalan)\s+([^,]+)/i';
        if (preg_match($streetPattern, $fullAddress, $streetMatches)) {
            $addressCombinations[] = $streetMatches[0];
        }

        // 3.2. Ekstrak kota/kabupaten
        $cityPattern = '/\b(?:Kota|Kab\.?|Kabupaten)\s+([^,\d]+)/i';
        if (preg_match($cityPattern, $fullAddress, $cityMatches)) {
            $addressCombinations[] = $cityMatches[0];

            // Kombinasikan jalan + kota jika keduanya ada
            if (isset($streetMatches[0])) {
                $addressCombinations[] = $streetMatches[0] . ', ' . $cityMatches[0];
            }
        }

        // 3.3. Ekstrak kecamatan
        $kecPattern = '/\b(?:Kec\.?|Kecamatan)\s+([^,\d]+)/i';
        if (preg_match($kecPattern, $fullAddress, $kecMatches)) {
            $addressCombinations[] = $kecMatches[0];

            // Kombinasikan dengan kota jika ada
            if (isset($cityMatches[0])) {
                $addressCombinations[] = $kecMatches[0] . ', ' . $cityMatches[0];
            }
        }

        // 3.4. Ekstrak kelurahan/desa
        $kelPattern = '/\b(?:Kel\.?|Kelurahan|Desa)\s+([^,\d]+)/i';
        if (preg_match($kelPattern, $fullAddress, $kelMatches)) {
            $addressCombinations[] = $kelMatches[0];
        }

        // 3.5. Ekstrak lokasi penting (perumahan, mall, dll)
        $placePatterns = [
            '/\b(?:Perumahan|Komplek|Cluster|Komp\.?)\s+([^,\d]+)/i',
            '/\b(?:Apartemen|Apartment|Apt\.?)\s+([^,\d]+)/i',
            '/\b(?:Mall|Plaza|Square|Park|City|Residence|Estate|Tower|Boulevard)\s+([^,\d]+)/i'
        ];

        foreach ($placePatterns as $pattern) {
            if (preg_match($pattern, $fullAddress, $placeMatches)) {
                $addressCombinations[] = $placeMatches[0];

                // Kombinasikan dengan kota jika ada
                if (isset($cityMatches[0])) {
                    $addressCombinations[] = $placeMatches[0] . ', ' . $cityMatches[0];
                }
            }
        }

        // ==============================================
        // STEP 4: Ekstraksi kata kunci berdasarkan pola umum
        // ==============================================

        // Ekstrak kata-kata dan frasa penting
        preg_match_all('/\b[A-Z][a-z]+ [A-Z][a-z]+(?:\s[A-Z][a-z]+)*\b/', $fullAddress, $nameMatches);
        foreach ($nameMatches[0] as $name) {
            if (strlen($name) > 5) { // Hindari kata-kata terlalu pendek
                $addressCombinations[] = $name;
            }
        }

        // Ekstrak potongan kata-kata penting (bisa digunakan untuk nama tempat)
        $words = preg_split('/\s+/', $fullAddress);
        foreach ($words as $word) {
            // Hanya kata-kata yang cukup panjang (biasanya nama tempat)
            if (strlen($word) > 5 && !preg_match('/^\d+$/', $word)) {
                $addressCombinations[] = $word;
            }
        }

        // ==============================================
        // STEP 5: Coba semua kombinasi dari yang paling spesifik
        // ==============================================

        // Hapus duplikat
        $addressCombinations = array_unique($addressCombinations);

        // Urutkan berdasarkan panjang (dari yang paling spesifik)
        usort($addressCombinations, function($a, $b) {
            return strlen($b) - strlen($a);
        });

        // Batasi jumlah kombinasi untuk menghindari terlalu banyak API calls
        $addressCombinations = array_slice($addressCombinations, 0, 15);

        // Loop melalui semua kombinasi dan coba geocode
        foreach ($addressCombinations as $address) {
            // Tampilkan percobaan (untuk debug)
            // echo "Mencoba: " . $address . "\n";

            $result = performGeocode($address);

            if ($result !== null) {
                return array_merge($result, ['original_address' => $originalAddress]);
            }

            // Tunggu 1 detik untuk menghormati batasan API
            sleep(1);
        }

        // ==============================================
        // STEP 6: Coba API alternatif jika Nominatim gagal
        // ==============================================

        function performPhotonGeocode($address) {
            // Format address for URL
            $formattedAddress = urlencode($address);

            // Create URL for Photon API
            $url = "https://photon.komoot.io/api/?q={$formattedAddress}&limit=1";

            // Set options for the request
            $options = [
                'http' => [
                    'header' => "User-Agent: PHP Geocoding App/1.0\r\n",
                    'method' => 'GET'
                ]
            ];

            $context = stream_context_create($options);

            // Send request and get response
            $response = file_get_contents($url, false, $context);

            // Check if request was successful
            if ($response === false) {
                return null;
            }

            // Parse JSON response
            $data = json_decode($response, true);

            // Check if any results were returned
            if (empty($data) || empty($data['features'])) {
                return null;
            }

            // Extract coordinates (note: GeoJSON format uses lon,lat order)
            $coordinates = $data['features'][0]['geometry']['coordinates'];
            $properties = $data['features'][0]['properties'];

            // Return the coordinates (reordered to lat,lon)
            return [
                'address' => $address,
                'latitude' => $coordinates[1],
                'longitude' => $coordinates[0],
                'display_name' => isset($properties['name']) ? $properties['name'] : 'Location found',
                'original_address' => $address,
                'source' => 'Photon API'
            ];
        }

        // Coba beberapa kombinasi dengan Photon API
        foreach (array_slice($addressCombinations, 0, 5) as $address) {
            $result = performPhotonGeocode($address);
            if ($result !== null) {
                return array_merge($result, ['original_address' => $originalAddress]);
            }
            sleep(1);
        }

        // Jika semua upaya gagal
        return [
            'error' => 'No geocoding results found after trying multiple address combinations',
            'original_address' => $originalAddress,
            'tried_combinations' => $addressCombinations
        ];
    }


    public function payStripe(Request $request)
    {

        $kode = $_GET['kode'];
        parse_str(urldecode($request->items[0]['checkoutInformation']),$checkoutInfo);
        $shipping = explode('-',$request->items[0]['ship']);
        $info = $checkoutInfo;

        $lotEntry = $this->geocodeWithRetry($info['address']);



        if (!Auth::check()) {
            $name = explode(' ',$info['name']);
            $back = sprintf('%06X', mt_rand(0xFF9999, 0xFFFF00));
            $color = substr(str_shuffle('ABCDEF0123456789'), 0, 6);
            $img = "https://ui-avatars.com/api/?name=".$name[0]."+".$name[1]."&color=7F9CF5&background=EBF4FF";
            $cart = json_decode(Cookie::get('cart'),TRUE);
            $selected_item = explode('|',$info['item']);
            $user = User::create([
                'name' => $info['name'],
                'email' => $info['email'],
                'thumb' => $img,
                'password' => Hash::make($info['password']),
                'address' => $info['address'],
                'phone' => $info['phone'],
            ]);
                Auth::login($user);
                $cr = '';
                foreach ($cart as $key => $value) {
                    if (in_array($key,$selected_item)) {
                        $cartsId = Cart::insertGetId([
                            'user_id' => Auth::user()->id,
                            'plant_id' => $value['plant_id'],
                            'qty' => $value['qty'],
                            'total' => Plant::where('id',$value['plant_id'])->first()->price * $value['qty'],
                            'has_paid' => true,
                        ]);
                        $cr .= $cartsId.'|';
                    }
                }
                $info['item'] = $cr;
        }



        if (!is_null(DB::table('vouchers')->where('code',$info['voucher_code'])->first())) {
        $disc = DB::table('vouchers')->where('code',$info['voucher_code'])->first()->disc;
        $id = Order::insertGetId([
            'user_id' => Auth::id(),
            'kode_transaksi' => $kode,
            'date'=>date('Y-m-d'),
            'total_price' => $info['total'],
            'total_price_after_disc' => $info['total'] - ($info['total'] * $disc/100),
            'tax' => 0,
            'status' => 1,
            'payment_method' => 3,
            'currency'=>"USD",
            'hasPaid'=>0,
            'discount' => $disc,
            'discount_code' => $info['voucher_code'],
            'nama_penerima' => Auth::user()->name,
            'alamat_penerima' => $info['address'],
            'email_penerima' => Auth::user()->email,
            'negara_tujuan' => $info['country'],
            'provinsi_tujuan' => $info['province'],
            'kota_tujuan' => $info['city'],
            'zipcode' => $info['zipcode'],
            'shipping_method' => $shipping[0],
            'shipping_price' => $shipping[1],
            'latitude' => $lotEntry['latitude'],
            'longitude' => $lotEntry['longitude'],
        ]);

    }else {
        $id = Order::insertGetId([
            'user_id' => Auth::id(),
            'kode_transaksi' => $kode,
            'date'=>date('Y-m-d'),
            'total_price' => $info['total'],
            'total_price_after_disc' => $info['total'],
            'tax' => 0,
            'status' => 1,
            'payment_method' => 3,
            'currency'=>"USD",
            'hasPaid'=>1,
            'discount' => 0,
            'discount_code' => NULL,
            'nama_penerima' => Auth::user()->name,
            'alamat_penerima' => $info['address'],
            'email_penerima' => Auth::user()->email,
            'negara_tujuan' => $info['country'],
            'provinsi_tujuan' => $info['province'],
            'kota_tujuan' => $info['city'],
            'zipcode' => $info['zipcode'],
            'shipping_method' => $shipping[0],
            'shipping_price' => $shipping[1],
            'latitude' => $lotEntry['latitude'],
            'longitude' => $lotEntry['longitude'],
        ]);
    }

        $item = explode('|',$info['item']);
        $item = array_filter($item);
        foreach ($item as $key => $value) {
            $data = Cart::where('id',$value)->update(['order_id'=>$id]);
            $itm = Cart::where('id',$value)->first();
            Plant::where('id',$itm->plant_id)->decrement('stock', $itm->qty);
        }

        Cookie::queue(Cookie::forget('cart'));

        echo json_encode('Success');

    }

}
