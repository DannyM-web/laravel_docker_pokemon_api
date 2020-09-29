<nav class="navbar fixed-top navbar-light" id="nav-bar">

  <div class="w-100 d-flex justify-content-between">
    <div class="nav align-self-start">
      <a href="{{route('index')}}"><img src="https://fontmeme.com/permalink/200923/900c0ea07f5b43064c73820ea7fcc832.png" alt="font-pokemon" border="0"></a>
    </div>
    <div class="align-self-center">
      @auth
      <ul class="nav d-flex">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('profile', Auth::user()->id) }}">Your profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}">Logout</a>
        </li>

        @if(Auth::user()->hasRoles('admin'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin') }}">Admin Panel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('requests') }}">Requests</a>
        </li>
        @endif
      </ul>
      @endauth

      @guest
      <ul class="nav d-flex">
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login_form')}}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register_form') }}">Register</a>
        </li>
      </ul>
      @endguest
    </div>

  </div>
</nav>