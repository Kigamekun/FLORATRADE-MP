<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Plant,Plants};
class PlantController extends Controller
{


    public function uploadThumb($file,$thumbname,$destinationPath)
    {
        $info = getimagesize($file);
        $image = '';
        if ($info['mime'] == 'image/jpeg')
        {
            $image = imagecreatefromjpeg($file);
        }
        elseif ($info['mime'] == 'image/gif')
        {
            $image = imagecreatefromgif($file);
        }
        elseif ($info['mime'] == 'image/png')
        {
            $image = imagecreatefrompng($file);
        }

        imagejpeg($image, $destinationPath.$thumbname, 100);
        return $thumbname;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage_plant', [
            'data' => Plant::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plant.create-or-edit',['act'=>'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $data = [];


        $request->validate($request, [
            'name' => 'required',
            'stock' => 'required',
            'price' => 'required',
            'description' => 'required',
            'thumb.*' => 'required|image|mimes:jpeg,png,jpg'

        ]);


        $wholesale = [];
        foreach ($request->wholesale_price as $key => $value) {
            $wholesale[$request->max[$key]] = $request->wholesale_price[$key];
        }

        try {
            $categoryId = Plants::where('name_latin', $request->category_id)->first()->id;
            $request->merge(['category_id' => $categoryId]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['message'=>'Gagal ditambahkan','status'=>'danger']);
        }


        if ($request->hasFile('thumb')) {
            $path = public_path() . '/thumbPlant'.'/';
            foreach ($request->file('thumb') as $key => $file) {
                $name = time() . '-' . $file->getClientOriginalName();
                $this->uploadThumb($file,$name,$path);
                $data[] = $name;
            }


        Plant::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'thumb' => json_encode($data),
            'category_id' => $request->category_id,
            'price' => $request->price,
            'wholesale_price' => json_encode($wholesale),
            'description' => $request->description,
            'status' => isset($request->status) ? 1 : 0,
        ]);


        }else {

        Plant::create([
            'name' => $request->name,
            'stock' => $request->stock,

            'category_id' => $request->category_id,
            'price' => $request->price,
            'wholesale_price' => json_encode($wholesale),
            'status' => isset($request->status) ? 1 : 0,
            'description' => $request->description,
        ]);

        }


        return redirect()->back()->with(['message'=>'Plant berhasil ditambahkan','status'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Plant::find($id);
        return view('plant.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Plant::find($id);
        return view('plant.create-or-edit', [
            'data' => $data,
            'act' => 'edit'
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        if ($request->hasFile('thumb')) {

            $data = [];
            $path = public_path() . '/thumbPlant'.'/';
            foreach ($request->file('thumb') as $key => $file) {
                $name = time() . '-' . $file->getClientOriginalName();
                $this->uploadThumb($file,$name,$path);
                $data[] = $name;
            }


        Plant::where('id', $id)
        ->update([
            'name' => $request->name,
            'stock' => $request->stock,

            'description' => $request->description,
            'thumb' => json_encode($data),
        ]);

        }else {

            Plant::where('id', $id)
            ->update([
                'name' => $request->name,
                'stock' => $request->stock,
                'description' => $request->description,
            ]);
        }


        return redirect()->back()->with(['message'=>'Plant berhasil di update','status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plant  $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Plant::destroy($id);
        return redirect()->route('admin.plant.index')->with(['message'=>'Plant berhasil di delete','status'=>'success']);
    }

    public function changeStatus(Request $request)
    {
        $data = Plant::find($request->id);
        $data->status = $request->status;
        $data->save();
        return response()->json(['message'=>'status has been edited'], 200);
    }
}
