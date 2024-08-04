@extends('layout.layout')

@section('page')
  Announcement
@endsection

@section('content')
  @include('admin.shared.navigation')
  <div class="cnt container">
    <img src="{{ $announcement->announcementImage() }}" alt="" />
    <h5 class="font-weight-bold mt-3">
      {{ $announcement->title }}
    </h5>
    <div class="d-flex justify-content-between">
      <h6>{{ $announcement->created_at->format('F j, Y, h:i A') }}</h6>
      by {{ $announcement->user->first_name . ' ' . $announcement->user->last_name }}
    </div>

    <div class="row">
      <div class="col-10">
        <p class="text-justify mt-3">
          {{ $announcement->description }}
        </p>
      </div>
      <div class="col-2 font-weight-lighter small">
        views: {{ $announcement->view }}
      </div>
    </div>
    <h5 class="mt-5">Comments:</h5>
    @forelse ($announcement->comments as $comment)
      <div class="cmnt row d-flex align-items-center">
        <div class="col-md-1">
          <img src="{{ $comment->user->userImage() }}" alt="" />
        </div>
        <div class="col-md-10">
          <div class="d-flex justify-content-between">
            <p>{{ $comment->user->first_name . ' ' . $comment->user->last_name }}</p>
            <small>{{ $comment->user->user_type }}</small>
          </div>
          <input type="text" class="form-control" placeholder="Wow!" value="{{ $comment->comment }}" disabled />
        </div>
      </div>
      <hr>
    @empty
      No comments
    @endforelse

    {{-- <div class="cmnt row d-flex align-items-center">
      <div class="col-md-1">
        <img src="img/1st.jpg" alt="" />
      </div>
      <div class="col-md-10">
        <p>Juan Dela Cruz</p>
        <input type="text" class="form-control" placeholder="Wow!" disabled />
      </div>
    </div> --}}


    <form action="{{ route('announcements.comments.store') }}" method="post">
      @csrf
      <input type="hidden" name="announcement_id" value="{{ $announcement->id }}">
      <div class="input-group mt-4">
        <input type="text" name="comment" class="form-control" placeholder="Comment here"
          aria-label="Recipient's username" aria-describedby="basic-addon2" />
        <div class="input-group-append">
          <button type="submit" class="btn btn-outline-secondary">Send</button>
        </div>
      </div>
    </form>
  </div>
  <footer></footer>
@endsection
