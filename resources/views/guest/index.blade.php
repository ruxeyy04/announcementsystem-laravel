@extends('layout.layout')

@section('page')
  Announcement
@endsection

@section('content')
  @include('guest.shared.navigation')
  <section>
    <div class="content container mt-3">
      <div class="row">
        @forelse ($announcements as $announcement)
          <div class="col-md-12 d-flex justify-content-center mt-5">
            <div class="newws mt-3"
              onclick="window.location='{{ route('guests.announcements.show', $announcement->id) }}';">
              <img src="{{ $announcement->announcementImage() }}" alt="" />
              <div class="ttle">
                <h5>
                  {{ $announcement->title }}
                </h5>
                <p>{{ $announcement->created_at->format('F j, Y, h:i A') }}</p>
              </div>
            </div>
          </div>
        @empty
          No announcements
        @endforelse
        {{ $announcements->links() }}
        {{-- <div class="col-md-12 d-flex justify-content-center mt-5">
        <div class="newws mt-3" onclick="window.location='content.html';">
          <img src="img/1st.jpg" alt="" />
          <div class="ttle">
            <h5>
              Triumphant Celebrations: Recognizing the Victors of Misamis
              University's 94th Foundation Anniversary Festivities
            </h5>
            <p>November 23,2023 9:00 A.M.</p>
          </div>
        </div>
      </div>
      <div class="col-md-12 d-flex justify-content-center mt-5">
        <div class="newws mt-3" onclick="window.location='content.html';">
          <img src="img/2nd.jpg" alt="" />
          <div class="ttle">
            <h5>
              MU College of Law Triumphs in International Environmental Law
              Moot Court Competition (IELMCC)
            </h5>
            <p>November 23,2023 9:00 A.M.</p>
          </div>
        </div>
      </div> --}}
        <div class="col-md-12"></div>
      </div>
    </div>
  </section>
@endsection
