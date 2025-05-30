<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Rules\NumWords;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user', [
            'data' => User::all()
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

        $request->validate([
            'name' => ['required', 'string', 'max:255',new NumWords(2)],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        $name = explode(' ',$request->name);


        $back = sprintf('%06X', mt_rand(0xFF9999, 0xFFFF00));
        $color = substr(str_shuffle('ABCDEF0123456789'), 0, 6);
        $img = "https://ui-avatars.com/api/?name=".$name[0]."+".$name[1]."&color=7F9CF5&background=EBF4FF";

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'thumb' => $img,
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'User created successfully'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $plant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::find($id);
        return view('plant.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $plant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        return view('plant.create-or-edit', [
            'data' => $data,
            'act' => 'edit'
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $plant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validasi input dari pengguna
        $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'string', 'email', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'role'    => ['nullable', 'string'],
        ]);

        // Cari user berdasarkan ID
        $user = User::findOrFail($id); // Menggunakan findOrFail untuk memastikan user ada

        // Update data user
        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'role'    => $request->role,
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with([
            'message' => 'User berhasil di update',
            'status'  => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $plant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Menghapus user berdasarkan ID
        User::destroy($id);

        // Redirect ke route yang benar, misalnya ke halaman daftar user
        return redirect()->route('admin.user.index')->with([
            'message' => 'User berhasil di delete',
            'status' => 'success'
        ]);
    }
}
