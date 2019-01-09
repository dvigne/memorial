<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photos;

class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photos::latest()->paginate('21');
        return view('pictures')->with('photos', $photos);
    }
}
