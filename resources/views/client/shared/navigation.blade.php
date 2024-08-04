<div class="nav d-flex justify-content-center">
  <a class="nav-item nav-link active text-dark" href="{{ route('clients.index') }}">Home <span class="sr-only">(current)</span></a>
  <a class="nav-item nav-link active text-dark" href="{{ route('users.show', Auth::user()->id) }}">Profile</a>
  <a class="nav-item nav-link text-dark" href="#" data-toggle="modal" data-target="#logout">Logout</a>
</div>
<h5 class="container mt-3">@yield('page'):</h5>
@include('layout.logout')
