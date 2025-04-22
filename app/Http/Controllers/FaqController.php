<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage_faq', [
            'data' => Faq::all()
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

        Faq::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with(['message'=>'Faq berhasil ditambahkan','status'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $plants
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Faq::find($id);
        return view('plants.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $plants
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Faq::find($id);
        return view('plants.create-or-edit', [
            'data' => $data,
            'act' => 'edit'
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $plants
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        Faq::where('id', $id)
        ->update([
            'title' => $request->title,
            'description' => $request->description,

        ]);



        return redirect()->back()->with(['message'=>'Faq berhasil di update','status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $plants
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Faq::destroy($id);
        return redirect()->back()->with(['message'=>'Faq berhasil di delete','status'=>'success']);
    }
}
