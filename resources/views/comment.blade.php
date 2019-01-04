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
        <div class="col-lg-8 col-md-10 mx-auto">
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
                <input style="font-size: unset;" type="file" name="photo">
                <p class="help-block text-danger"></p>
                @if ($errors->has('photo'))
                    <span style="display:block;" class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('photo') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              @isset($comment)
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Update Comment</button>
              @else
                <button type="submit" class="btn btn-primary" id="sendMessageButton">Sign Guestbook</button>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>

    <hr>

    @extends('layouts/footer')

    @extends('layouts/scripts')

  </body>

</html>
