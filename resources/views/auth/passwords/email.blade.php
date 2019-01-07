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
          <p>Please enter your email below to receieve a password reset link</p>
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif
          <form method="POST" action="{{ route('password.email') }}" name="sentMessage" id="contactForm" novalidate>
            @csrf
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Email Address</label>
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address" id="email" value="{{ old('email') }}" name="email" required data-validation-required-message="Please enter your email address.">
                <p class="help-block text-danger"></p>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <br>
            <div id="success"></div>
            <div class="form-group">
              <button onclick="document.getElementById('spinner').classList.remove('d-none');document.getElementById('text').classList.add('sr-only');" type="submit" class="btn btn-primary" id="sendMessageButton">
                <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                <span id="text" class="">Send Password Reset</span>
              </button>
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
