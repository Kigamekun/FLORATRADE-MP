<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TermsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.terms', [
            'data' => DB::table('terms')->get()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Terms  $plant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('terms')->update([
            'terms' => $request->terms,
        ]);
        return redirect()->back()->with(['message'=>'terms berhasil di update','status'=>'success']);
    }

}
