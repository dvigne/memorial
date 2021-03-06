<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Photos;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Auth;
use Storage;

class CommentsController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $comments = Comments::latest()->paginate(15);
    return view('index')->with('comments', $comments);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('comment');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(CommentRequest $request)
  {
    $data = $request->validated();

    $createdComment = Auth::user()->comments()->create([
      'message' => $data['message']
    ]);

    if($request->has('_photos')) {
      $photos = $photos = explode(",", $request->_photos[0]);
      foreach($photos as $photo) {
        $photo = Photos::findOrFail($photo);
        if(Auth::user()->id == $photo->user_id) {
          $photo->comment_id = $createdComment->id;
          $photo->save();
        }
        else {
          abort(401);
        }
      }
    }

    return redirect()->route('index');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Comments  $comments
  * @return \Illuminate\Http\Response
  */
  public function show(Comments $comment)
  {
    return view('comment')->with('comment', $comment);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Comments  $comments
  * @return \Illuminate\Http\Response
  */
  public function edit(Comments $comment)
  {
    if($comment->user_id == Auth::user()->id){
      return view('comment')->with('comment', $comment);
    }
    else{
      abort(401);
    }
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Comments  $comments
  * @return \Illuminate\Http\Response
  */
  public function update(CommentRequest $request, Comments $comment)
  {
    $data = $request->validated();

    if($comment->user_id == Auth::user()->id) {
      $comment = Comments::findOrFail($comment->id);
      $comment->message = $data['message'];
      $comment->save();

      if($request->has('_photos')) {
        $photos = $photos = explode(",", $request->_photos[0]);
        foreach($photos as $photo) {
          $photo = Photos::findOrFail($photo);
          $photo->comment_id = $comment->id;
          $photo->save();
        }
      }

    }
    else {
      abort(401);
    }

    return redirect()->route('index');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Comments  $comments
  * @return \Illuminate\Http\Response
  */
  public function destroy(Comments $comment)
  {
    if($comment->user_id == Auth::user()->id) {
      $comment = Comments::findOrFail($comment->id);
      foreach ($comment->photos()->get()->all() as $photo) {
        Storage::delete($photo->photo_path);
        $photo->delete();
      }
      $comment->delete();
    }
    else {
      abort(401);
    }

    return redirect()->route('index');
  }
}
