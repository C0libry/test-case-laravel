<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class GalleryCntroller extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            "sort" => ['string', 'max:255'],
        ]);

        $images = match ($request->sort) {
            'created_at' => Image::orderBy('created_at', 'ASC')->paginate(6),
            'name' => Image::orderBy('name')->paginate(6),
            '-name' => Image::orderBy('name', 'DESC')->paginate(6),
            default => Image::orderBy('created_at', 'DESC')->paginate(6),
        };

        $images->appends(['sort' => $request->sort])->links();

        return view('gallery')->
            with('images', $images);
    }
}
