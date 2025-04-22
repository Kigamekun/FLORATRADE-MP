<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Cart,Plant,User,Order,OrderDetail};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
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



    public function payStripe(Request $request)
    {
        $kode = $_GET['kode'];
        parse_str(urldecode($request->items[0]['checkoutInformation']),$checkoutInfo);
        $shipping = explode('-',$request->items[0]['ship']);
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
            'shipping_price' => $shipping[1]
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

        echo json_encode('Success');

    }

}
