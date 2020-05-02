<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;
use File;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('role', 1)->get();
        $user2 = User::where('role', 2)->get();

        return view('layouts/admin/user/index' , compact('user', 'user2'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string',
            'passowrd' => 'required|min:8',
            'phone' => 'required',
            'photo' => 'nullable|image',
            'level' => 'required',
        ]);

        $photo = null;

        if($request->hasFile('photo')){

            $photo = $this->saveFile($request->name , $request->file('photo'));
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'photo' => $photo,
            'role' => $request->role,
        ]);

        return redirect()->back()->with(['success' => 'Data Berhasil DiInput']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id_user)
    {
        $user = User::findOrFail($id_user);

        return view('layouts/admin/user/edit' , compact('user'));
    }

    public function update(Request $request, $id_user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string',
            'password' => 'required|min:8',
            'phone' => 'required',
            'photo' => 'nullable|image',
        ]);

        $user = User::findOrFail($id_user);
        $photo = $user->photo;
        $role = $user->role;

        if($request->hasFile('photo')){
            !empty($photo) ? File::delete(public_path('uploads/user/' . $photo)) : null;

            $photo = $this->saveFile($request->name , $request->file('photo'));
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'photo' => $photo,
            'role' => $role,
        ]);

        return redirect(route('users.index'))->with(['success' => 'Data Berhasil Di Edit']);
    }

    public function destroy($id_user)
    {
        $user = User::findOrFail($id_user);

        if(!empty($user->photo)){
            File::delete(public_path('uploads/user/' . $user->photo));
        }

        $user->delete();

        return redirect()->back()->with(['success' => 'Data Berhasil Di Hapus']);
    }

    public function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/user');

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        Image::make($photo)->save($path . '/' . $images);

        return $images;
    }

    public function defadd()
    {
        $data = User::where('id_user', Auth::user()->id_user)->value('default_address');

        return $data;
    }

    public function setadd(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id_user);
        $user->default_address = $request->address;
        $user->save();

        return $request->address;
    }
}
