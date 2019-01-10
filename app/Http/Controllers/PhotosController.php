<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PhotosRequest;
use App\Photos;
use Storage;
use Auth;
use Validator;

class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photos::latest()->paginate('21');
        return view('pictures')->with('photos', $photos);
    }

    public function store(PhotosRequest $request)
    {
      $request->validated();
      
      if($request->hasFile('photo')) {
        $file = $request->photo;
        $path = Storage::putFile('photo', $file, 'public');
        $createdPhoto = Auth::user()->photos()->create([
          'photo_path' => $path
        ]);
        return response()->json(['id' => $createdPhoto->id]);
      }
      abort(500);
    }
}
