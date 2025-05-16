<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Sakoola</title>

 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 <!-- Font Awesome -->
 <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
 <!-- icheck bootstrap -->
 <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
 <!-- Theme style -->
 <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
 <!-- /.login-logo -->
 <div class="card card-outline card-primary">
  <div class="card-header text-center">
   <a href="{{ route('sys.dashboard') }}" class="h1"><b>Sak</b>oola</a>
  </div>
  <div class="card-body">
   <p class="login-box-msg">Sign in to start your session</p>

   <form action="{{ route('login.store') }}" method="post">
    @csrf
    @error('umail')
     <span class="badge bg-danger">{{ $message }}</span>
    @enderror
    <div class="input-group mb-3">
     <input type="text" class="form-control" name="umail" autocomplete="off" placeholder="Username or Email" value="{{ old('umail') }}">
     <div class="input-group-append">
      <div class="input-group-text">
       <span class="fas fa-user"></span>
      </div>
     </div>
    </div>

    @error('password')
    <span class="badge bg-danger">{{ $message }}</span>
    @enderror
    <div class="input-group mb-3">
     <input type="password" class="form-control" name="password" autocomplete="off" placeholder="Password">
     <div class="input-group-append">
      <div class="input-group-text">
       <span class="fas fa-lock"></span>
      </div>
     </div>
    </div>

    <div class="row">
     <div class="col-8">
      <div class="icheck-primary">
       <input type="checkbox" name="remember" id="remember">
       <label for="remember">
        Remember Me
       </label>
      </div>
     </div>
     <!-- /.col -->
     <div class="col-4">
      <button type="submit" class="btn btn-primary btn-block">Login</button>
     </div>
     <!-- /.col -->
    </div>
   </form>
  </div>
  <!-- /.card-body -->
 </div>
 <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
