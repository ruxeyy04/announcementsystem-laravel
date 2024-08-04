<div class="nav d-flex justify-content-center">
  <a class="nav-item nav-link active text-dark" href="{{ route('admins.index') }}">Home</a>
  <a class="nav-item nav-link active text-dark" href="{{ route('announcements.index') }}">Announcement</a>
  <a class="nav-item nav-link active text-dark" href="{{ route('users.show', Auth::user()->id) }}">Profile</a>
  <a class="nav-item nav-link active text-dark" href="{{ route('users.index', ['user_type' => 'user']) }}">Users</a>
  <a class="nav-item nav-link active text-dark" href="{{ route('users.index', ['user_type' => 'incharge']) }}">In-charge</a>
  <a class="nav-item nav-link text-dark" href="#" data-toggle="modal" data-target="#logout">Logout</a>
</div>
<h5 class="container mt-3">@yield('page'):</h5>
@include('layout.logout')