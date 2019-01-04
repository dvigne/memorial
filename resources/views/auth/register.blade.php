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
          <p>Please register below to comment and upload photos. If you already have an account you may login <a href="{{ route('login') }}">here</a></p>
          <form method="POST" action="{{ route('register') }}" name="sentMessage" id="contactForm" novalidate>
            @csrf
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>First Name</label>
                <input type="text" class="form-control{{ $errors->has('first') ? ' is-invalid' : '' }}" placeholder="First Name" id="first" name="first" required data-validation-required-message="Please enter your first name.">
                <p class="help-block text-danger"></p>
                @if ($errors->has('first'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('first') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Last Name</label>
                <input type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Last Name" id="last" name="last" required data-validation-required-message="Please enter your last name.">
                <p class="help-block text-danger"></p>
                @if ($errors->has('last'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('last') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Email Address</label>
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address" id="email" name="email" required data-validation-required-message="Please enter your email address.">
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
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Confirm Password</label>
                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Confirm Your Password" id="password" name="password_confirmation" required data-validation-required-message="Please confirm your password">
                <p class="help-block text-danger"></p>
                @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="sendMessageButton">Register</button>
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
