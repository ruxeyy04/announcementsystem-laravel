@extends('layout.layout')

@section('page')
  Announcement List:
@endsection

@section('content')
  @include('admin.shared.navigation')
  <section class="content container mt-3">
    <div class="row">
      <div class="col-md-6"></div>
      <div class="col-md-6 text-right mb-2">
        <button class="btn btn-primary" data-target="#add" data-toggle="modal">
          Add Announcement
        </button>
      </div>
      <div class="col-md-12">
        <table class="table bg-light">
          <thead>
            <tr>
              <th scope="col">Image</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Date</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($announcements as $announcement)
              <tr>
                <th scope="row"><img src="{{ $announcement->announcementImage() }}" width="70" height="70"></th>
                <td>{{ $announcement->title }}</td>
                <td>{{ $announcement->description }}</td>
                <td>{{ $announcement->created_at->format('F j, Y, h:i A') }}</td>
                <td>
                  <button class="btn btn-info" data-target="#edit{{ $announcement->id }}" data-toggle="modal">
                    Edit
                  </button>
                  <button class="btn btn-danger" data-target="#delete{{ $announcement->id }}" data-toggle="modal">
                    Delete
                  </button>
                </td>
              </tr>
              @include('layout.announcement-crud')
            @empty
              <td colspan="5">No announcement</td>
            @endforelse
          </tbody>
        </table>
        {{ $announcements->links() }}
      </div>
    </div>
  </section>
  <footer></footer>
@endsection
