<!DOCTYPE html>
<html lang="en">

@extends('layouts/header')

@push('stylesheets')
<link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endpush

@section('title', 'In Rememberance of Joshua Barton')

@section('links')
@parent
@endsection

<body>

  @extends('layouts/navigation')

  @section('navigation')
  @parent
  @endsection

  <!-- Main Content -->
  <div style="padding-top:50px;" class="container">
    <div class="row">
      <div class="col-11 mx-auto">
        @if(Route::currentRouteName() == 'comments.show')
        <div style="padding: 10px 0 10px 0;"class="row">
          <div style="padding-top: 20px;" class="col-11 text-left">
            <a href="{{ route('index') }}"><i class="fas fa-angle-left"></i> Back to guestbook</a>
          </div>
        </div>
        <div class="post-preview">
          <p class="post-subtitle">
            {{ $comment->message }}
          </p>
          <hr>
          <div class="row">
          @foreach($comment->photos()->latest()->get() as $photo)
            <div class="col-md-3 col-lg-3 col-11 offset-1" style="padding: 10px;">
              <img data-toggle="modal" data-target="#photo-{{ str_limit($photo->id, 8, '') }}" width="250px;" src="{{ Storage::url($photo->photo_path) }}" class="rounded">
            </div>
            <div class="modal fade" id="photo-{{ str_limit($photo->id, 8, '') }}" tabindex="-1" role="dialog" aria-labelledby="{{ $photo->id }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <img class="img-fluid mx-auto" src="{{ Storage::url($photo->photo_path) }}">
              </div>
            </div>
          @endforeach
          </div>
          <p class="post-meta">
            {{ title_case($comment->user->first . " " . $comment->user->last) . " on " . str_limit($comment->created_at, 10, '') }}
            @auth
              @if($comment->user_id == Auth::user()->id)
              <div class="row">
                <div class="col-5">
                  <a class="text-left" href="{{ route('comments.edit', ['comment' => $comment->id]) }}"><i class="far fa-edit"></i> edit comment</a>
                </div>
                <div class="col-5 offset-2 text-right">
                  <a href="{{ route('comments.destroy', ['comment' => $comment->id]) }}"
                  onclick="event.preventDefault(); document.getElementById('destroy-comment').submit();"><i class="far fa-trash-alt"></i> delete comment</a>
                </div>
                <form id="destroy-comment" action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="POST" style="display: none;">
                    @method('DELETE')
                    @csrf
                </form>
              </div>
              @endif
            @endauth
          </p>
        </div>
        @else
        <p>Type your message below.</p>
        @isset($comment)
        <form enctype="multipart/form-data" method="POST" action="{{ route('comments.update', ['comment' => $comment->id]) }}" name="sentMessage" id="contactForm" novalidate>
          @method('PATCH')
          @else
          <form enctype="multipart/form-data" method="POST" action="{{ route('comments.store') }}" name="sentMessage" id="contactForm" novalidate>
            @endif
            @csrf
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Message</label>
                <textarea name="message" rows="5" class="form-control{{ $errors->has('message') ? ' is-invalid' : '' }}" placeholder="Message" id="message" required data-validation-required-message="Please enter a message.">{{ isset($comment) ? $comment->message : '' }}</textarea>
                <p class="help-block text-danger"></p>
                @if ($errors->has('message'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('message') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <p>Upload a png, jpeg, or bmp photo</p>
                <input style="font-size: unset;" type="file" name="photos[]" multiple>
                <p class="help-block text-danger"></p>
                @if ($errors->has('photos'))
                <span style="display:block;" class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('photos') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button onclick="document.getElementById('spinner').classList.remove('d-none');document.getElementById('text').classList.add('sr-only');" type="submit" class="btn btn-primary" id="sendMessageButton">
                <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                @isset($comment)
                <span id="text" class="">Update Comment</span>
                @else
                <span id="text" class="">Sign Guestbook</span>
                @endif
              </button>
            </div>
          </form>
          @endif
        </div>
      </div>
    </div>

    <hr>

    @extends('layouts/footer')

    @extends('layouts/scripts')

  </body>

  </html>
