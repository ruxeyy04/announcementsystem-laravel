<div class="nav d-flex justify-content-center">
  <a class="nav-item nav-link active text-dark" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
  <a class="nav-item nav-link text-dark" href="#" data-target="#login" data-toggle="modal">Login</a>
</div>
<h5 class="container mt-3">@yield('page'):</h5>

<!-- login -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('authenticate') }}" method="get">
        @csrf
        <div class="modal-body">
          <label for="email">Email</label>
          <input type="text" class="form-control" name="email" id="email" />
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" />
          <h6 class="mt-2">
            No account yet?
            <span class="reg" data-target="#reg" data-toggle="modal">Register here.</span>
          </h6>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-info">Login</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="reg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header" id="mheader">
          <h5 class="modal-title">Register</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="image">Image</label>
          <input type="file" class="form-control" name="image" id="image" />
          <label for="first_name">First name</label>
          <input type="text" class="form-control" name="first_name" id="first_name" />
          <label for="last_name">Last name</label>
          <input type="text" class="form-control" name="last_name" id="last_name" />
          <label for="gender">Gender</label>
          <select id="gender" class="form-control" name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
          <label for="email">Email</label>
          <input type="text" class="form-control" id="email" name="email" />
          <label for="contact_number">Contact number</label>
          <input type="text" class="form-control" id="contact_number" name="contact_number" />
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" name="password" />
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </form>
    </div>
  </div>
</div>
