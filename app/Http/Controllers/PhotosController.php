<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;

class PhotosController extends Controller
{
    public function index()
    {
        $photos = Comments::whereNotNull('photo_path')->latest()->paginate('60');
        return view('pictures')->with('photos', $photos);
    }
}
