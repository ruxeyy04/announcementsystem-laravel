<!-- Add -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="mheader">
        <h5 class="modal-title">Add New Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('announcements.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <label for="image">Image</label>
          <input type="file" class="form-control" name="image" id="image" />
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" id="title" />
          <label for="description">Description</label>
          <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
          <div class="scrollable-container" style="max-height: 200px; overflow-y: auto;">

            Allowed to see users:
            <div class="form-check pl-0 mb-2">
              <input type="checkbox" id="select-all-checkbox">
              <label class="form-check-label" for="select-all-checkbox">Select All</label>
            </div>
            @forelse ($users as $user)
              @if ($user->user_type != 'user')
                @if ($loop->first)
                  Allowed to see users:
                @endif
                <span style="display: none;">
                  <input type="checkbox" name="users_id[]" value="{{ $user->id }}" checked>
                </span>
              @else
                <div class="form-check">
                  <label class="form-check-label" for="{{ $user->id }}">
                    <input type="checkbox" class="form-check-input user-checkbox" id="{{ $user->id }}"
                      name="users_id[]" value="{{ $user->id }}">
                    {{ $user->first_name . ' ' . $user->last_name }}
                  </label>
                </div>
              @endif
            @empty
              No users
            @endforelse
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- update -->
<div class="modal fade" id="edit{{ $announcement->id }}" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="mheader">
        <h5 class="modal-title">Update Announcement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('announcements.update', $announcement->id) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="modal-body">
          <label for="image">Image</label>
          <input type="file" class="form-control" name="image" id="image" />
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" id="title" value="{{ $announcement->title }}" />
          <label for="description">Description</label>
          <textarea name="description" id="description" class="form-control" cols="30" rows="5">{{ $announcement->description }}</textarea>
          <div class="scrollable-container" style="max-height: 200px; overflow-y: auto;">

            Allowed to see users:
            <div class="form-check pl-0 mb-2">
              <label class="form-check-label">
                <input type="checkbox" class="select_all"> Select All
              </label>
            </div>
            @forelse ($users as $user)
              @if ($user->user_type != 'user')
                @if ($loop->first)
                  Allowed to see users:
                @endif
                <span style="display: none;">
                  <input type="checkbox" name="users_id[]" value="{{ $user->id }}" checked>
                </span>
              @else
                <div class="form-check">
                  <label class="form-check-label" for="{{ $user->id }}">
                    <input type="checkbox" class="form-check-input update-user-checkbox" id="{{ $user->id }}"
                      name="users_id[]" value="{{ $user->id }}"
                      {{ $announcement->alloweds->contains('user_id', $user->id) ? 'checked' : '' }}>
                    {{ $user->first_name . ' ' . $user->last_name }}
                  </label>
                </div>
              @endif
            @empty
              No users
            @endforelse
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-info">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Delete -->
<div class="modal fade" id="delete{{ $announcement->id }}" tabindex="-1" role="dialog"
  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" id="mheader">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this announcement?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          No
        </button>
        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="post">
          @csrf
          @method('delete');
          <button type="submit" class="btn btn-danger">Yes</button>
        </form>
      </div>
    </div>
  </div>
</div>

@section('script')
  <script>
    $(document).ready(function() {
      $('#select-all-checkbox').change(function() {
        $('.user-checkbox').prop('checked', this.checked);
      });

      $('.select_all').change(function() {
        $('.update-user-checkbox').prop('checked', this.checked);
      });
    });
  </script>
@endsection
