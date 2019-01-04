@section('navigation')
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
  <div class="container">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      Menu
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('index') }}">Guestbook Comments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('photos') }}">Photos</a>
        </li>
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Create an Account</a>
          </li>
        @endguest
        @auth
          <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                Logout {{ Auth::user()->first . " " . Auth::user()->last }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
@show
