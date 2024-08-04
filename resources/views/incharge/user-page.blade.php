@extends('layout.layout')

@section('page')
  User List
@endsection

@section('content')
  @include('incharge.shared.navigation')
  <section class="content container mt-3">
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6 text-right mb-2">
        <button class="btn btn-primary" data-target="#add" data-toggle="modal">
          Add user
        </button>
      </div>
      <div class="col-md-12">
        <table class="table bg-light">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Image</th>
              <th scope="col">First name</th>
              <th scope="col">Last name</th>
              <th scope="col">Gender</th>
              <th scope="col">Email</th>
              <th scope="col">Contact number</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $user)
              <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>
                  <img src="{{ $user->userImage() }}" alt="" width="70" height="70">
                </td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name }}</td>
                <td>{{ $user->gender }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->contact_number }}</td>
                <td>
                  <button class="btn btn-info" data-target="#edit{{ $user->id }}" data-toggle="modal">
                    Edit
                  </button>
                  <button class="btn btn-danger" data-target="#delete{{ $user->id }}" data-toggle="modal">
                    Delete
                  </button>
                </td>
              </tr>
              @include('layout.user-crud')
            @empty
              <td colspan="8">No users</td>
            @endforelse
          </tbody>
        </table>
        {{ $users->links() }}
      </div>
    </div>
  </section>
  <footer></footer>
@endsection
