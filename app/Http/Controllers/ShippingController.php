<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->view('admin.shipping', [
            'data' => DB::table('shipping_fees')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('shipping.create-or-edit', ['act' => 'create']);
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
            'ship_method' => 'required',
            'count' => 'required',
            'price' => 'required',
        ]);

        if (DB::table('shipping_fees')->where(['ship_method'=>$request->ship_method,'count'=>$request->count])->exists()) {

            return redirect()->back()->with(['message'=>'Fee shippng berhasil ditambahkan','status'=>'success']);
        }else {

        DB::table('shipping_fees')->insert([
            'ship_method' => $request->ship_method,
            'count' => $request->count,
            'price' => $request->price,

        ]);

        return redirect()->back()->with(['message'=>'Fee shippng berhasil ditambahkan','status'=>'success']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DB::table('shipping_fees')  $shipping
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('shipping_fees')->find($id);
        return view('shipping.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DB::table('shipping_fees')  $shipping
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('shipping_fees')->where('id',$id)->first();
        return view('shipping.create-or-edit', [
            'data' => $data,
            'act' => 'edit'
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DB::table('shipping_fees')  $shipping
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        DB::table('shipping_fees')->where('id', $id)
        ->update([
            'ship_method' => $request->ship_method,
            'count' => $request->count,
            'price' => $request->price,

        ]);



        return redirect()->back()->with(['message'=>'Update Shipping berhasil di update','status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DB::table('shipping_fees')  $shipping
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('shipping_fees')->where('id',$id)->delete();
        return redirect()->back()->with(['message'=>'Delete berhasil di delete','status'=>'success']);
    }
}
