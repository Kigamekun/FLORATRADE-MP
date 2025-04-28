<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plants;

class PlantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage_plants', [
            'data' => Plants::all()
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plants.create-or-edit',['act'=>'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Plants::create([
            'name_indonesia' => $request->name_indonesia,
            'name_latin' => $request->name_latin,
        ]);

        return redirect()->back()->with(['message'=>'Plants berhasil ditambahkan','status'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Plants::find($id);
        return view('plants.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Plants::find($id);
        return view('plants.create-or-edit', [
            'data' => $data,
            'act' => 'edit'
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Plants::where('id', $id)
        ->update([
            'name_indonesia' => $request->name_indonesia,
            'name_latin' => $request->name_latin,

        ]);



        return redirect()->back()->with(['message'=>'Plants berhasil di update','status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plants  $plants
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Plants::destroy($id);
        return redirect()->back()->with(['message'=>'Plants berhasil di delete','status'=>'success']);
    }
}
