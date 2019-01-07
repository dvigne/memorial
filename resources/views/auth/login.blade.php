<!DOCTYPE html>
<html lang="en">

  @extends('layouts/header')

  @push('stylesheets')
    <link href="css/auth.css" rel="stylesheet">
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
          <p>Please login below to comment or <a href="{{ route('register') }}">sign up</a> if you are not currently registered</p>
          <form method="POST" action="{{ route('login') }}" name="sentMessage" id="contactForm" novalidate>
            @csrf
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Email Address</label>
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address" id="email" name="email" value="{{ old('email') }}" required data-validation-required-message="Please enter your email address.">
                <p class="help-block text-danger"></p>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Password</label>
                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" id="password" name="password" required data-validation-required-message="Please enter your password">
                <p class="help-block text-danger"></p>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button onclick="document.getElementById('spinner').classList.remove('d-none');document.getElementById('text').classList.add('sr-only');" type="submit" class="btn btn-primary" id="sendMessageButton">
                <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                <span id="text" class="">Login</span>
              </button>
              <a style="float:right;" href="{{ route('password.request') }}">Forgot my password</a>
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
