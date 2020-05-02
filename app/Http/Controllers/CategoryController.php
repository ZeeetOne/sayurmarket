<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Image;
use File;

class CategoryController extends Controller
{
    public function index()
    {
        $cat = Category::all();

        return view('layouts/pelanggan/category', compact('cat'));
    }

    public function i_admin()
    {
        $cat = Category::all();

        return view('layouts/admin/category/index', compact('cat'));
    }

    public function store(Request $request)
    {
        $cat = $request->validate([
            'nama_category' => 'required|string',
            'photo_category' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        $photo = null;

        if($request->hasFile('photo_category')){
            $photo = $this->saveFile($request->name , $request->file('photo_category'));
        }

        $cat = Category::create([
            'nama_category' => $request->nama_category,
            'photo_category' => $photo,
        ]);

        return redirect()->back()->with(['success' => 'Data Berhasil Di Input']);
    }

    public function edit($id_category)
    {
        $cat = Category::findOrFail($id_category);

        return view('layouts/admin/category/edit', compact('cat'));
    }

    public function update(Request $request, $id_category)
    {
        $cat = $request->validate([
            'nama_category' => 'required|string',
            'photo_category' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);

        $cat = Category::findOrFail($id_category);
        $photo = $cat->photo_category;

        if($request->hasFile('photo_category')){
            !empty($photo) ? File::delete(public_path('uploads/cat/' . $photo)) : null;

            $photo = $this->saveFile($request->name , $request->file('photo_category'));
        }

        $cat->update([
            'nama_category' => $request->nama_category,
            'photo_category' => $photo,
        ]);

        return redirect(route('cat.index'))->with(['success' => 'Data Berhasil Di Edit']);
    }

    public function destroy($id_category)
    {
        $cat = Category::findOrFail($id_category);

        if(!empty($cat->photo_category)){
            File::delete(public_path('uploads/cat/' . $cat->photo_category));
        }

        $cat->delete();

        return redirect()->back()->with(['success' => 'Data Berhasil Di Delete']);
    }

    public function saveFile($name, $photo)
    {
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/cat');

        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }

        Image::make($photo)->save($path . '/' . $images);

        return $images;
    }
}
