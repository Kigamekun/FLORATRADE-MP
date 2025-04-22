<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage_pricing', [
            'data' => DB::table('pricings')->get()
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
        DB::table('pricings')->insert([
            'count'=>$request->count,
            'value'=>$request->value,

        ]);


        return redirect()->back()->with(['message'=>'Success create plant','status'=>'success']);
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
        DB::table('pricings')->where('id',$id)->update([
            'count'=>$request->count,
            'value'=>$request->value,


        ]);
        return redirect()->back()->with(['message'=>'Success esit plant','status'=>'success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('pricings')->where('id',$id)->delete();

        return redirect()->back()->with(['message'=>'Success deleted plant','status'=>'success']);
    }



}
