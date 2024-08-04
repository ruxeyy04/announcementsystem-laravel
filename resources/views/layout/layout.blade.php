<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <title>{{ config('app.name') }}</title>
</head>

<body>
  @include('layout.alert')
  <header>
    <h4 class="text-center font-weight-bold text-warning">
      M<span class="text-light">Announcement</span>
    </h4>
  </header>
  @yield('content')
  <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  @yield('script')
</body>

</html>
