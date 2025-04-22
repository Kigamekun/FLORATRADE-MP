<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use PayPal\Api\{Item,Payer,Amount,Details,Payment,ItemList,WebProfile,InputFields,Transaction,RedirectUrls,PaymentExecution};
use App\Models\{User,Cart,Plant,Order};
use Carbon\Carbon;
use Stripe;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.invoice', [
            'data' => Invoice::all()
        ]);
    }



    public function create()
    {
        return view('admin.createInvoice');
    }

    public function shareInvoiceLink($id)
    {
        return view('admin.shareInvoiceLink', [
            'data' => DB::table('invoices')->where('id',$id)->first(),
            'id' => $id
        ]);
    }


    public function stripePayment(Request $request)
    {


        $order = DB::table('invoices')->where('id',$request->id)->first();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));



        Stripe\Charge::create ([
            "amount" => $order->total_price,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Payment for Transaction Code ".$order->kode_transaksi,
            "receipt_email" => $order->email_penerima,
            "metadata" => [
                "kode_transaksi" => $order->kode_transaksi,
                "name" => $order->nama_penerima,
                "email" => $order->email_penerima,
                "address" => $order->alamat_penerima,
                "ship" => $order->shipping_method,
                "ship_cost" => $order->shipping_price
            ],
        ]);

        $id = DB::table('invoices')->where('id',$request->id)->update([
            'tax' => 0,
            'status' => 1,
            'payment_method' => 3,
            'currency'=>"USD",
            'hasPaid'=>1,
        ]);


    }

    public function execute_payment(Request $request)
    {
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                env('PAYPAL_SANDBOX_CLIENT_ID'),     // ClientID
                env('PAYPAL_SANDBOX_CLIENT_SECRET')      // ClientSecret
            )
        );

        $paymentId = $request->paymentID;
        $payment = Payment::get($paymentId, $apiContext);


        $execution = new PaymentExecution();
        $execution->setPayerId($request->payerID);

        try {
            $result = $payment->execute($execution, $apiContext);
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }

        DB::table('invoices')->where('id',$request->id)->update([
            'tax' => 0,
            'status' => 1,
            'payment_method' => 2,
            'currency'=>'USD',
            'manual_payment_id'=>$request->manual_payment_id,
            'hasPaid'=>1
        ]);

        return $result;
    }

    public function manualPayment(Request $request)
    {

        $cc = DB::table('credit_cards')->where('id',$request->manual_payment_id)->first();
        $order = DB::table('invoices')->where('id',$request->id)->first();
        $file = $request->file('file_payment');
        $thumbname = time() . '-' . $file->getClientOriginalName();
        $file->move(public_path() . '/manualPayment' . '/', $thumbname);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=".$cc->currency_code."&from=USD&amount=".$order->total_price,
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
        CURLOPT_URL => "https://api.apilayer.com/currency_data/convert?to=".$cc->currency_code."&from=USD&amount=".$order->shipping_price,
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

        DB::table('invoices')->where('id',$request->id)->update([
            'tax' => 0,
            'status' => 0,
            'payment_method' => 1,
            'currency'=>$cc->currency_code,
            'manual_payment_id'=>$request->manual_payment_id,
            'manual_file'=>$thumbname,
            'hasPaid'=>1
        ]);

        return redirect()->back()->with('success','Payment Success');

    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $kode_transaksi = 'MTPLC-PLT-#'.Str::upper(Str::random(3).time());


        $total_price = 0;
        foreach ($request->price as $key => $value) {
            $total_price += $value;
        }

        $id = DB::table('invoices')->insert([
            'kode_transaksi' => $kode_transaksi,
            'date'=>date('Y-m-d'),
            'total_price' => $total_price,
            'tax' => $request->tax,
            'status' => NULL,
            'payment_method' => NULL,
            'currency'=>NULL,
            'hasPaid'=>0,

            'nama_penerima' => $request->nama_penerima,
            'alamat_penerima' =>  $request->alamat_penerima,
            'email_penerima' =>  $request->email_penerima,
            'negara_tujuan' =>  $request->negara_tujuan,
            'provinsi_tujuan' =>  $request->provinsi_tujuan,
            'kota_tujuan' =>  $request->kota_tujuan,
            'zipcode' =>  $request->zipcode,
            'shipping_method' =>  $request->shipping_method,
            'shipping_price' =>  $request->shipping_price,
            'plants' => json_encode([$request->plants,$request->qty,$request->price])
        ]);


        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Invoice created successfully'
        ]);
    }

    public function approve($id)
    {
        DB::table('invoices')->where('id',$id)->update([
            'status' => 1
        ]);
        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Invoice approved successfully'
        ]);
    }


    public function download($id)
    {
            $file = DB::table('invoices')->where('id',$id)->first()->manual_file;
            $file_path = public_path('manualPayment/'.$file);
            return response()->download($file_path);
    }

    public function changeStatus(Request $request)
    {
        DB::table('invoices')->where('id',$request->id)->update([
            'status'=>$request->status
        ]);


        $statusMain = [];
        $status[0] = 'Waiting Approval';
        $status[1] = 'Order Processed';
        $status[2] = 'Quarantine Processed';
        $status[3] = 'Order Shipping';
        $status[4] = 'Shipped';
        $status[5] = 'Done / Reviews';


    return response()->json(['id'=>$request->id, 'status'=>$request->status,'data'=>DB::table('invoices')->where('id',$request->id)->first()], 200);
    }

    public function addResi(Request $request,$id)
    {


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileresi = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/fileResi' . '/', $fileresi);

            DB::table('invoices')->where('id',$id)->update([
                'file_resi'=>$fileresi,
                'no_resi'=>$request->no_resi,

            ]);
        }else {
            DB::table('invoices')->where('id',$id)->update([
                'no_resi'=>$request->no_resi
            ]);
        }


        return redirect()->back()->with(['message'=>'Success add receipt','status'=>'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('invoices')->where('id',$id)->first();
        return view('order.create-or-edit', [
            'data' => $data,
            'act' => 'edit'
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // dd($request->all());
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $thumbname = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/thumbOrder' . '/', $thumbname);


        DB::table('invoices')->where('id', $id)
        ->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'description' => $request->description,
            'thumb' => $thumbname,
        ]);

        }else {

            DB::table('invoices')->where('id', $id)
            ->update([
                'name' => $request->name,
                'stock' => $request->stock,
                'description' => $request->description,

            ]);

        }


        return redirect()->back()->with(['message'=>'Order berhasil di update','status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('invoices')->where('id',$id)->delete();
        return redirect()->route('admin.invoice.index')->with(['message'=>'Order berhasil di delete','status'=>'success']);
    }

    public function detailOrder(Request $request)
    {
        $solve = [];
        $data = DB::table('invoices')->where('id',$request->id)->first();
        $data = json_decode($data->plants,TRUE);
        foreach ($data[0] as $key => $value) {
            $solve[] = Plant::where('id',$value)->first()->name;
        }


        return response()->json($solve, 200);
    }
}
