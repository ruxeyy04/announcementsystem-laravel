@extends('layout.layout')

@section('page')
  User Details
@endsection

@section('content')
  @include('client.shared.navigation')
  <section>
    <div class="content container mt-3">
      <div class="row text-center">
        <div class="col-md-12">
          <img src="{{ $user->userImage() }}" class="imgprof" />
        </div>
        <div class="col-md-4 mt-3">
          <h5>Name:</h5>
          <h6>{{ $user->first_name . ' ' . $user->last_name }}</h6>
        </div>
        <div class="col-md-4 mt-3">
          <h5>Gender:</h5>
          <h6>{{ $user->gender }}</h6>
        </div>
        <div class="col-md-4 mt-3">
          <h5>Email:</h5>
          <h6>{{ $user->email }}</h6>
        </div>
        <div class="col-md-4 mt-3">
          <h5>Contact number:</h5>
          <h6>{{ $user->contact_number }}</h6>
        </div>
      </div>
    </div>
    <h5 class="container mt-5">Settings:</h5>
    <div class="content container mt-3 text-center">
      <button class="btn btn-secondary" data-target="#edit" data-toggle="modal">
        Edit profile
      </button>
    </div>
  </section>
  <footer></footer>

  <!-- update -->
  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <input type="hidden" name="profile" value="page">
        <div class="modal-content">
          <div class="modal-header" id="mheader">
            <h5 class="modal-title">Update details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label for="image">Image</label>
            <input type="file" class="form-control" name="image" id="image" />
            <label for="first_name">First name</label>
            <input type="text" class="form-control" name="first_name" id="first_name"
              value="{{ $user->first_name }}" />
            <label for="last_name">Last name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name }}" />
            <label for="gender">Gender</label>
            <select id="gender" class="form-control" name="gender">
              <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
              <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
              <option value="other" {{ $user->gender === 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}" />
            <label for="contact_number">Contact number</label>
            <input type="text" class="form-control" name="contact_number" id="contact_number"
              value="{{ $user->contact_number }}" />
            <label for="password">New Password</label>
            <input type="text" class="form-control" name="password" id="password"
              placeholder="Enter new password if you wish to update it" />
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
              Close
            </button>
            <button type="submit" class="btn btn-info">Update</button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
