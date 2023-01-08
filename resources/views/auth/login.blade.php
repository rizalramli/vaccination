<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/img/favicon.png') }}">

    <title>myITS Vaksin</title>

    <link href="{{ asset('template/lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/lib/typicons.font/typicons.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('template/css/azia.css') }}">

  </head>
  <body class="az-body">

    <div class="az-signin-wrapper">
      <div class="az-card-signin">
        
        <div class="az-signin-header">
          <div class="text-center mb-3">
            <img width="100" height="100" src="{{ asset('template/img/favicon.png') }}" alt="">
          </div>
          <!-- alert -->
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <!-- account admin -->
              <div><strong>Admin</strong></div>
              <div>Username: admin</div>
              <div>Password: admin123</div>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
              <label>Username</label>
              <input name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="Masukan username">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group">
              <label>Password</label>
              <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Masukan password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <button type="submit" class="btn btn-az-primary btn-block">Login</button>
          </form>
        </div>
      </div>
    </div>

    <script src="{{ asset('template/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/lib/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('template/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('template/js/jquery.cookie.js') }}" type="text/javascript"></script>

    <script src="{{ asset('template/js/azia.js') }}"></script>
    <script>
      $(function(){
        'use strict'

      });
    </script>
  </body>
</html>

