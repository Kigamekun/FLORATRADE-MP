<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Order,Cart,Plant,Comment};
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Mail;
class OrderController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order', [
            'data' => Order::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create-or-edit',['act'=>'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate( [
            'name' => 'required',

            'stock' => 'required',
            'price' => 'required',
            'description' => 'required',
            'thumb' => 'required',
        ]);


    $file = $request->file('thumb');
    $thumbname = time() . '-' . $file->getClientOriginalName();
    $file->move(public_path() . '/thumbOrder' . '/', $thumbname);

        Order::create([
            'name' => $request->name,

            'stock' => $request->stock,
            'thumb' => $thumbname,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->back()->with(['message'=>'Order berhasil ditambahkan','status'=>'success']);
    }


    public function approve($id)
    {
        $order = Order::where('id',$id)->update([
            'status' => 1
        ]);

        return redirect()->back()->with(['message'=>'Order berhasil di approve','status'=>'success']);
    }

    public function download($id)
    {
            $file = Order::where('id',$id)->first()->manual_file;
            $file_path = public_path('manualPayment/'.$file);
            return response()->download($file_path);
    }

    public function changeStatus(Request $request)
    {
        Order::where('id',$request->id)->update([
            'status'=>$request->status
        ]);


        $statusMain = [];
        $status[0] = 'Waiting Approval';
        $status[1] = 'Order Processed';
        $status[2] = 'Quarantine Processed';
        $status[3] = 'Order Shipping';
        $status[4] = 'Shipped';
        $status[5] = 'Done / Reviews';

        Mail::to(Order::where('id',$request->id)->first()->email_penerima)->send(new NotificationMail($request->id));


    return response()->json(['id'=>$request->id, 'status'=>$request->status,'data'=>Order::where('id',$request->id)->first()], 200);
    }

    public function addResi(Request $request,$id)
    {


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileresi = time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/fileResi' . '/', $fileresi);

            Order::where('id',$id)->update([
                'file_resi'=>$fileresi,
                'no_resi'=>$request->no_resi,

            ]);
        }else {
            Order::where('id',$id)->update([
                'no_resi'=>$request->no_resi
            ]);
        }


        return redirect()->back()->with(['message'=>'Success add receipt','status'=>'success']);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Order::find($id);
        return view('order.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Order::find($id);
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


        Order::where('id', $id)
        ->update([
            'name' => $request->name,
            'stock' => $request->stock,

            'description' => $request->description,
            'thumb' => $thumbname,
        ]);

        }else {

            Order::where('id', $id)
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

        Order::destroy($id);
        return redirect()->back()->with(['message'=>'Order berhasil di delete','status'=>'success']);
    }

    public function detailOrder(Request $request)
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



    public function getPlants($orderId)
{
    $order = Order::with('orderItems.plant')->findOrFail($orderId);

    $plants = $order->orderItems->map(function ($item) {
        $plant = $item->plant;

           if ($plant->thumb != null) {
                $thumb = json_decode($plant->thumb , TRUE);
                $plant->image_url = env('APP_URL').'/thumbPlant/'.$thumb[0];
            }else {
                $plant->image_url = NULL;
            }

        $plant->sudah_review = Comment::where('user_id', auth()->id())
                            ->where('plant_id', $plant->id)
                            ->where('order_id', $item->order_id)
                            ->exists();
        return $plant;
    });

    return response()->json($plants);
}

}
