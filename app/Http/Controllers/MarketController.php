<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Cart,Plant,User,Order,OrderDetail};
// use App\Models\;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules;
use App\Rules\NumWords;
use App\Mail\{NewManualOrderMail,NotificationMail};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;



class MarketController extends Controller
{

    public function clean($string) {
        $string = str_replace(' ', '-', $string);

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }


    public function add_to_cart(Request $request,$id)
    {

        if (Plant::where('id',$id)->first()->stock - $request->qty < 0) {
            return response()->json(['message'=>'Failed add to cart','status'=>'danger'], 400);
        }

        if (Auth::user()) {
            if (Cart::where('user_id',Auth::user()->id)->where(['plant_id'=>$id,'order_id'=>NULL])->exists()) {

                $data = Cart::where('user_id',Auth::user()->id)->where(['plant_id'=>$id,'order_id'=>NULL])->first();

                $data->qty += $request->qty;
                $data->total = Plant::find($id)->price * $data->qty;
                $data->save();


            }else {

                Cart::create([
                    'user_id' => Auth::user()->id,
                    'plant_id' => $id,
                    'qty' => $request->qty,
                    'total' => Plant::where('id',$id)->first()->price * $request->qty,
                    'has_paid' => false,
                ]);
            }


        }else {

            if (!is_null(json_decode(Cookie::get('cart'),TRUE))) {
                $dt = json_decode(Cookie::get('cart'),TRUE);

                try {

                if (!is_null($dt[$id])) {
                    $dt[$id]['qty'] += $request->qty;
                    $dt[$id]['total'] = Plant::where('id',$id)->first()->price * $dt[$id]['qty'];
                    Cookie::queue('cart', json_encode($dt), env('COOKIE_LIFETIME'));
                }

                } catch (\Throwable $th) {

                    $dt[$id] = [
                        'user_id' => 'Anonim',
                        'plant_id' => $id,
                        'qty' => $request->qty,
                        'total' => Plant::where('id',$id)->first()->price * $request->qty,
                        'has_paid' => false,
                    ];
                    Cookie::queue('cart', json_encode($dt), env('COOKIE_LIFETIME'));
                }

            }
            else {

                $data[$id] = [
                    'user_id' => 'Anonim',
                    'plant_id' => $id,
                    'qty' => $request->qty,
                    'total' => Plant::where('id',$id)->first()->price * $request->qty,
                    'has_paid' => false,
                ];
                Cookie::queue('cart', json_encode($data), env('COOKIE_LIFETIME'));
            }


        }
        return response()->json(['message'=>'Success add to cart','status'=>'success'], 200);
        // return redirect()->back()->with(['message'=>'success add to cart','status'=>'success'],200);
    }

    private function getCoordinatesFromAddress($address)
    {
        $formattedAddress = urlencode($address);
        $url = "https://nominatim.openstreetmap.org/search?q={$formattedAddress}&format=json&limit=1";

        // Set user agent (wajib agar tidak ditolak oleh Nominatim)
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: MyLaravelApp/1.0\r\n"
            ]
        ];
        $context = stream_context_create($opts);

        $response = file_get_contents($url, false, $context);
        $data = json_decode($response, true);

        if (!empty($data)) {
            return [
                'lat' => $data[0]['lat'],
                'lng' => $data[0]['lon']
            ];
        } else {
            return null;
        }
    }

    public function checkout(Request $request)
    {

        if ($request['voucher_code'] != NULL && is_null(DB::table('vouchers')->where('code', $request['voucher_code'])->first())) {
            return redirect()->back()->with(['message'=>'discount code doesnt exists','errdisc'=>TRUE]);
        }
        $item = explode('|',$request->item_selected);
        $item = array_filter($item);
        $total = 0;
        $whl = FALSE;
        $err = [];

        if (Auth::check()) {
            foreach ($item as $key => $value) {
                $cart = Cart::where('id',$value)->first();

                $plt =  Plant::where('id',$cart->plant_id)->first();

            //   Whole sale logic
                if (!is_null($plt->wholesale_price)) {
                    $wholesale = json_decode($plt->wholesale_price,TRUE);
                    krsort($wholesale);
                    foreach ($wholesale as $key_sale => $value_whole) {
                        if ($cart->qty >= $key_sale) {
                            $plt->price = $value_whole;
                            $whl = TRUE;
                            break;
                        }
                    }
                }
                $total += $plt->price * $cart->qty;
                // end Whole sale logic


                if ($cart->qty > $plt->stock) {
                    $err[$cart->plant_id]['plant_id'] = $cart->plant_id;
                    $err[$cart->plant_id]['message'] = 'Sorry, '.$plt->name.' item is not available in the quantity you want :(';
                }
            }

        }
        else {
            $cart = json_decode(Cookie::get('cart'),TRUE);

            foreach ($cart as $key => $value) {
                $plt =  Plant::where('id',$key)->first();

                //   Whole sale logic
                if (!is_null($plt->wholesale_price)) {
                $wholesale = json_decode($plt->wholesale_price,TRUE);
                krsort($wholesale);
                foreach ($wholesale as $key_sale => $value_whole) {
                    if ($value['qty'] >= $key_sale) {
                        $plt->price = $value_whole;
                        $whl = TRUE;
                        break;
                    }
                }
                }

                $total += $plt->price * $value['qty'];
                // end Whole sale logic


                if ($value['qty'] > $plt->stock) {
                    $err[$key]['plant_id'] = $key;
                    $err[$key]['message'] = 'Sorry, '.$plt->name.' item is not available in the quantity you want :(';
                }
            }
        }

        if (!empty($err)) {
            return redirect()->back()->with(['error'=>$err,'status'=>'error'],200);
        }
        else {

            // return view('user.checkout',['total'=>$request->subtotal,'cart'=>$cart,'voucher_code'=>$request['voucher_code'],'item'=>$request->item_selected]);

            // With Wholesale
            return view('user.checkout',['whl'=>$whl,'total'=>$total,'cart'=>$cart,'voucher_code'=>$request['voucher_code'],'item'=>$request->item_selected]);
        }
    }


    public function checkout_page(Request $request)
    {
        return view('user.checkout');
    }

    public function history_transaction(Request $request)
    {
        $transaction = Order::where([
            'user_id' => Auth::user()->id,

        ])->get();

    }

    public function my_cart(Request $request)
    {
        $authenticable = FALSE;
        if (Auth::user()) {
            $authenticable = TRUE;
            $data = Cart::where(['user_id'=>Auth::id(),'order_id'=>NULL])->get();
            $total = Cart::where(['user_id'=>Auth::id(),'order_id'=>NULL])->sum('total');
            return view('user.cart',['data'=>$data,'total'=>$total,'authenticable'=>$authenticable]);
        }else {

            $authenticable = FALSE;
            return view('user.cart',['data'=>is_null(Cookie::get('cart')) ? [] : json_decode(Cookie::get('cart')),'authenticable'=>$authenticable]);
        }
    }

    public function decrease(Request $request)
    {

        $total = $request->total;
        if (Auth::check()) {
            $data = Cart::where('id',$request->id)->first();
            if ($data->qty > 1) {
                $total -= Plant::find($data->plant_id)->price * $data->qty;
                $data->qty = $data->qty - 1;
                $data->total = Plant::find($data->plant_id)->price * $data->qty;
                $total += Plant::find($data->plant_id)->price * $data->qty;
                $data->save();
            }else {
                $total -= Plant::find($data->plant_id)->price * $data->qty;
                $data->qty = $data->qty;
                $data->total = Plant::find($data->plant_id)->price * $data->qty;
                $total += Plant::find($data->plant_id)->price * $data->qty;
                $data->save();
            }

            return response()->json(['message'=>'Success Decrease A Cart Plant','id'=>$data->id,'qty'=>$data->qty,'total'=>$data->total,'total_all'=>$total], 200);
        }
        else {
            $id = $request->id;
            if (!is_null(json_decode(Cookie::get('cart'),TRUE))) {
                $dt = json_decode(Cookie::get('cart'),TRUE);
                if (!is_null($dt[$id])) {

                    if ($dt[$id]['qty'] - 1 < 1) {

                    }else {
                        $total -= Plant::where('id', $id)->first()->price * $dt[$id]['qty'];


                        $dt[$id]['qty'] -= 1;
                        $dt[$id]['total'] = Plant::where('id', $id)->first()->price * $dt[$id]['qty'];

                        $total += Plant::where('id', $id)->first()->price * $dt[$id]['qty'];

                        Cookie::queue('cart', json_encode($dt), env('COOKIE_LIFETIME'));
                    }
                }
            }

            return response()->json(['message'=>'Success Decrease A Cart Plant','id'=>$id,'qty'=>$dt[$id]['qty'],'total'=>$dt[$id]['total'],'total_all'=>$total], 200);
        }

    }
    public function increase(Request $request)
    {

        $total = $request->total;
        if (Auth::check()) {


            $data = Cart::where('id',$request->id)->first();

            $total -= Plant::find($data->plant_id)->price * $data->qty;

            $data->qty = $data->qty + 1;
            $data->total = Plant::find($data->plant_id)->price * $data->qty;

            $total += Plant::find($data->plant_id)->price * $data->qty;

            $data->save();



            return response()->json(['message'=>'Success Increase A Cart Plant','id'=>$data->id,'qty'=>$data->qty,'total'=>$data->total,'total_all'=>$total], 200);
        }
        else {

            $id = $request->id;
            if (!is_null(json_decode(Cookie::get('cart'),TRUE))) {

                $dt = json_decode(Cookie::get('cart'),TRUE);
                if (!is_null($dt[$id])) {

                    $total -= Plant::where('id',$id)->first()->price * $dt[$id]['qty'];


                    $dt[$id]['qty'] += 1;
                    $dt[$id]['total'] = Plant::where('id',$id)->first()->price * $dt[$id]['qty'];

                    $total += Plant::where('id',$id)->first()->price * $dt[$id]['qty'];

                    Cookie::queue('cart', json_encode($dt), env('COOKIE_LIFETIME'));
                }


            }
            else {

                $total -= Plant::where('id',$id)->first()->price * 1;

                $data[$id] = [
                    'user_id' => 'Anonim',
                    'plant_id' => $id,
                    'qty' => 1,
                    'total' => Plant::where('id',$id)->first()->price * 1,
                    'has_paid' => false,
                ];

                $total += Plant::where('id',$id)->first()->price * 1;
                Cookie::queue('cart', json_encode($data), env('COOKIE_LIFETIME'));
            }



            return response()->json(['message'=>'Success Increase A Cart Plant','id'=>$id,'qty'=>$dt[$id]['qty'],'total'=>$dt[$id]['total'],'total_all'=>$total], 200);
        }

    }

    public function delete_cart($id)
    {
        if (Auth::user()) {
            Cart::where('id',$id)->delete();
            return redirect()->back()->with(['message'=>'Success delete item in your cart !','status'=>'success']);
        }else {
            $dt = json_decode(Cookie::get('cart'),TRUE);
            unset($dt[$id]);
            Cookie::queue('cart', json_encode($dt), env('COOKIE_LIFETIME'));
            return redirect()->back()->with(['message'=>'Success delete item in your cart !','status'=>'success']);
        }

    }

    public function delete_cart_all(Request $request)
    {


        if (Auth::check()) {
            Cart::where('user_id',Auth::id())->delete();
        }else {
            Cookie::queue(Cookie::forget('cart'));

        }

        return redirect()->back()->with(['message'=>'Success delete all item in your cart !','status'=>'success']);
    }

public function search(Request $request)
{
    $query = Plant::where('status', 1); // Base query to fetch active plants

    // Apply category filter if provided
    if ($request->has('category')) {
        $query->where('category_id', $request->category);
    }

    // Apply price filter if provided
    if ($request->has('price')) {
        $query->where('price', '<=', $request->price);
    }

    // Apply search filter if provided
    if ($request->has('search')) {
        $query->where('name', 'LIKE', '%' . $request->search . '%');
    }

    // Paginate the results
    $data = $query->paginate(20);

    // Return the view with the filtered data
    return view('user.result', ['data' => $data]);
}

    public function chat(Request $request,$for)
    {
        $user_id = Auth::id();
        $for_name = User::find($for)->name;
        $from_name = Auth::user()->name;

        return view('chat',['for'=>$for,'user_id'=>$user_id,'for_name'=>$for_name,'from_name'=>$from_name]);
    }

    public function useVoucher(Request $request)
    {
        if (!is_null($disc = DB::table('vouchers')->where('code',$request->code)->first())) {
            return response()->json(['status'=>TRUE,'message'=>'Voucher has been used','res'=>'<p class="info-code-apply">'.$disc->disc.'% off discount</p>','disc_value'=>$request->total_cart * $disc->disc/100 , 'after_disc'=>$request->total_cart - ($request->total_cart * $disc->disc/100)], 200);
        }
        else {
            return response()->json(['status'=>FALSE,'message'=>'Voucher cant be used','res'=>'<p class="info-code-apply danger-text">promo cant be used</p>'], 200);

        }

    }

    public function detailPlant($id)
    {
        $data = Plant::find($id);

        if (Auth::user()) {
            $cart = Cart::where(['user_id'=>Auth::id()])->get();


        }else {
            $cart = json_decode(Cookie::get('cart'),TRUE);
        }

        return view('user.plant-detail',['data'=>$data,'cart'=>$cart]);
    }


    public function count_cart(Request $request)
    {
        if (Auth::check()) {
            return response()->json(['count' => Cart::where(['user_id'=>Auth::user()->id,'order_id'=>NULL])->count()],200);
        }else {
            return response()->json(['count' => count(json_decode(Cookie::get('cart'),TRUE))], 200);
        }
    }


    public function historyTransaksi(Request $request)
    {
        $data = Order::where(['user_id' => Auth::id()])->get();
        if (isset($_GET['message'])) {
            return view('user.history-transaksi',['data'=>$data,'message'=>$_GET['message'],'status'=>'success']);
        }else {
            return view('user.history-transaksi',['data'=>$data]);
        }
    }


    public function getInfoManualTransaction(Request $request)
    {

        $cc = DB::table('credit_cards')->where('id',$request->id)->first();
        $fill = '<table class="table table-bordered">';



            if (!is_null($cc->account_holder) && $cc->account_holder != '') {
                $fill .= '<li><b>Account Holder :</b> '.$cc->account_holder.'</li>';

            }
            if (!is_null($cc->account_number) && $cc->account_number != '') {
                $fill .= '<li><b>Account Number :</b> '.$cc->account_number.'</li>';

            }
            if (!is_null($cc->BIC) && $cc->BIC != '') {
                $fill .= '<li><b>BIC :</b> '.$cc->BIC.'</li>';

            }

            if (!is_null($cc->IBAN) && $cc->IBAN != '') {
                $fill .= '<li><b>IBAN :</b> '.$cc->IBAN.'</li>';

            }

            if (!is_null($cc->institution_number)  && $cc->institution_number != '') {
                $fill .= '<li><b>Institution Number :</b> '.$cc->institution_number.'</li>';

            }
            if (!is_null($cc->routing_number) && $cc->routing_number != '') {
                $fill .= '<li><b>Routing Number :</b> '.$cc->routing_number.'</li>';

            }
            if (!is_null($cc->sort_code) && $cc->sort_code != '') {
                $fill .= '<li><b>Sort Code :</b> '.$cc->sort_code.'</li>';

            }
            if (!is_null($cc->transit_number) && $cc->transit_number != '') {
                $fill .= '<li><b>Transit Number :</b> '.$cc->transit_number.'</li>';

            }

            if (!is_null($cc->wise_address) && $cc->wise_address != '') {
                $fill .= '<li><b>Wise Address :</b> '.$cc->wise_address.'</li>';

            }

            $fill .= '</table>';

            return response()->json([$fill,$cc->id], 200);

    }


    public function getDetailItemTransaction(Request $request)
    {
        $data = [];
        $cart = Cart::where('order_id',$request->id)->get();

        foreach ($cart as $key => $value) {
            $plt = Plant::where('id',$value->plant_id)->first();
            $data[$key]['nama'] = $plt->name;
            $data[$key]['price'] = $plt->price;
            $data[$key]['qty'] = $value->qty;
            $data[$key]['total'] = $value->total;
            if ($plt->thumb != null) {
                $thumb = json_decode($plt->thumb , TRUE);
                $data[$key]['thumb'] = env('APP_URL').'/thumbPlant/'.$thumb[0];
            }else {
                $data[$key]['thumb'] = NULL;
            }

        }

        return response()->json($data, 200);
    }


    public function buy(Request $request)
    {


        parse_str(urldecode($request->checkoutInformation),$checkoutInfo);
        $shipping = explode('-',$request->ship);
        $info = $checkoutInfo;


        $cc = DB::table('credit_cards')->where('id',$request->manual_payment_id)->first();

        if (!Auth::check()) {

            if (User::where('email',$info['email'])->count() > 0) {
                return redirect()->route('my-cart')->with(['message'=>'Email already registered','status'=>'error']);
            }

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
                            'has_paid' => false,
                        ]);

                        $cr .= $cartsId.'|';
                    }
                }

                $info['item'] = $cr;

        }

        $kode_transaksi = 'MTPLC-PLT-#'.Str::upper(Str::random(3).time());


        if (!is_null(DB::table('vouchers')->where('code',$info['voucher_code'])->first())) {


        $cc = DB::table('credit_cards')->where('id',$request->manual_payment_id)->first();


        $disc = DB::table('vouchers')->where('code',$info['voucher_code'])->first()->disc;
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=".$cc->currency_code."&from=USD&amount=".$info['total']."",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: ElBZILCuhTRwRkxAKgOwcaMlg39qY9cM"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $price = curl_exec($curl);
        curl_close($curl);

            $hgs = $info['total'] - ($info['total'] * $disc/100);
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=".$cc->currency_code."&from=USD&amount=".$hgs,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: ElBZILCuhTRwRkxAKgOwcaMlg39qY9cM"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $price_after_disc = curl_exec($curl);

        curl_close($curl);


        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=".$cc->currency_code."&from=USD&amount=".$shipping[1]."",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: ElBZILCuhTRwRkxAKgOwcaMlg39qY9cM"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $ship = curl_exec($curl);

        curl_close($curl);

        $price = json_decode($price,TRUE);
        $price_after_disc = json_decode($price_after_disc,TRUE);
        $ship = json_decode($ship,TRUE);

        $id = Order::insertGetId([
            'user_id' => Auth::id(),
            'kode_transaksi' => $kode_transaksi,
            'date'=>date('Y-m-d'),
            'total_price' => $price['result'],
            'total_price_after_disc' => $price_after_disc['result'],
            'tax' => 0,
            'status' => '0',
            'payment_method' => 1,
            'currency'=>$cc->currency_code,
            'hasPaid'=>0,
            'discount' => $disc,
            'manual_payment_id'=>$request->manual_payment_id,
            'discount_code' => $info['voucher_code'],
            'nama_penerima' => Auth::user()->name,
            'alamat_penerima' => $info['address'],
            'email_penerima' => Auth::user()->email,
            'negara_tujuan' => $info['country'],
            'provinsi_tujuan' => $info['province'],
            'kota_tujuan' => $info['city'],
            'zipcode' => $info['zipcode'],
            'shipping_method' => $shipping[0],
            'shipping_price' => $ship['result']
        ]);

    }else {



        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=".$cc->currency_code."&from=USD&amount=".$info['total'],
        CURLOPT_HTTPHEADER => array(
            "Content-Type: text/plain",
            "apikey: ElBZILCuhTRwRkxAKgOwcaMlg39qY9cM"
        ),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $product = curl_exec($curl);

    curl_close($curl);
    echo $product;


    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=".$cc->currency_code."&from=USD&amount=".$shipping[1]."",
    CURLOPT_HTTPHEADER => array(
        "Content-Type: text/plain",
        "apikey: ElBZILCuhTRwRkxAKgOwcaMlg39qY9cM"
    ),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET"
    ));

    $ship = curl_exec($curl);

    curl_close($curl);

    $product = json_decode($product,TRUE);
    $ship = json_decode($ship,TRUE);


        $id = Order::insertGetId([
            'user_id' => Auth::id(),
            'kode_transaksi' => $kode_transaksi,
            'date'=>date('Y-m-d'),
            'total_price' => $product['result'],
            'total_price_after_disc' => $product['result'],
            'tax' => 0,
            'status' => '0',
            'payment_method' => 1,
            'currency'=>$cc->currency_code,
            'manual_payment_id'=>$request->manual_payment_id,
            'hasPaid'=>0,
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
            'shipping_price' => $ship['result']
        ]);
    }

        $item = explode('|',$info['item']);
        $item = array_filter($item);
        foreach ($item as $key => $value) {
            $data = Cart::where('id',$value)->update(['order_id'=>$id]);
            $itm = Cart::where('id',$value)->first();
            Plant::where('id',$itm->plant_id)->decrement('stock', $itm->qty);
        }

        // MAIL TO ADMIN
        Mail::to(env('MAIL_ADMIN'))->send(new NewManualOrderMail($id));

        Cookie::queue(Cookie::forget('cart'));

        return redirect()->route('history-transaction')->with(['message'=>'Checkout has been successed !','status'=>'success']);

    }

    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $dt = [];
        $filterResult = DB::table('countries')->where('country_name', 'LIKE', '%'. $query. '%')->get();
        foreach ($filterResult as $key => $value) {
                $dt[] = $value->country_name;
        }
        return response()->json($dt);
    }


    // DEPRECEATED

    public function getPaypallCreateOrder(Request $request)
    {

        $data =
        [
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "1000.00"
                    ]
                ]
            ]
        ];
        return response()->json($data, 200);

    }

    // END DEPRECEATED

    public function addBuktiPembayaran(Request $request)
    {
        $file = $request->file('file');
        $thumbname = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/manualPayment' . '/', $thumbname);


        Order::where('id', $request->id)->update([
            'manual_file' =>$thumbname
        ]);


        return redirect()->back()->with(['success' => 'Bukti Pembayaran Berhasil Diupload', 'status' => 'success']);
    }


    public function cancelPaymentPaypal(Request $request)
    {
        return view('cancel-payment');
    }


    public function selengkapnya(Request $request)
    {
        return view('user.result',['data'=>Plant::where('status',1)->paginate(20)]);
    }

    public function catalog(Request $request)
    {

        $data = Plant::all();
        return view('user.catalog',['data'=>$data]);

    }

    public function faq(Request $request)
    {

        return view('user.faq');

    }

    public function terms(Request $request)
    {

        return view('user.terms');

    }

    public function margaSearch(Request $request)
    {
        $query = $request->get('query');
        $data = [];

        $filterResult = DB::table('base_plants')->where('name_latin', 'LIKE', '%'. $query. '%')->get();
        foreach ($filterResult as $key => $value) {
                $data[] = $value->name_latin;

        }
        return response()->json($data);
    }

    public function addAddress(Request $request)
    {
        DB::table('address_users')->insert([
            'user_id' => Auth::id(),
            'address' => $request->address,
        ]);

        return redirect()->back()->with(['success' => 'Alamat Berhasil Ditambahkan', 'status' => 'success']);
    }


    public function removeAddress(Request $request,$id)
    {
        DB::table('address_users')->wheere('id',$id)->delete();
        return redirect()->back()->with(['success' => 'Alamat Berhasil Ditambahkan', 'status' => 'success']);
    }

}

