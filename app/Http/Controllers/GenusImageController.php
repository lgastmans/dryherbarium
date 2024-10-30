<?php

namespace App\Http\Controllers;

use App\Models\GenusImage;
use Illuminate\Http\Request;

class GenusImageController extends Controller
{
    public function index()
    {
        $images = GenusImage::all();
        return view('genus-images', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->file('image')) {
            $path = $request->file('image')->store('images', 'public');
            
            GenusImage::create(['path' => $path]);
        }

        return redirect()->back();
    }
}
