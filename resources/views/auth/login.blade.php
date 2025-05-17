<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Sakoola | Login</title>
 <link rel="icon" type="image/x-icon" href="{{ asset('/admin/dist/img/AdminLTELogo.png') }}">
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
 <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="hold-transition login-page">

<div class="login-box">
 <!-- /.login-logo -->
 <div class="card card-outline card-primary">
  <div class="card-header text-center">
   <a href="{{ route('home') }}" class="h1"><b>Sak</b>oola</a>
  </div>
  <div class="card-body">
   <p class="login-box-msg">Selamat Datang Kembali</p>

   <form action="{{ route('login.store') }}" method="post" onsubmit="disableSubmitButton()">
    @csrf
    @error('umail')
     <span class="badge bg-danger">{{ $message }}</span>
    @enderror
    <div class="input-group mb-3">
     <input type="text" class="form-control" name="umail" autocomplete="off" placeholder="Username or Email" value="{{ old('umail') }}">
     <div class="input-group-append">
      <div class="input-group-text">
       <i class="bi bi-person-bounding-box"></i>
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
       <i class="bi bi-shield-lock"></i>
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
      <button type="submit" class="btn btn-outline-secondary btn-block" id="submit-btn">
       <span id="button-text">Login</span>
       <i class="bi bi-box-arrow-in-right" id="login-icon"></i>
       <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none;"></span>
      </button>
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

<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
 @if (session('success'))
  Swal.fire({
   icon: 'success',
   title: 'Berhasil!',
   text: '{{ session("success") }}',
   showConfirmButton: false,
   timer: 2000,
   scrollbarPadding: false,
   heightAuto: false
 });
 @endif

 function disableSubmitButton() {
  const submitButton = document.getElementById('submit-btn');
  const spinner = document.getElementById('loading-spinner');
  const buttonText = document.getElementById('button-text');
  const loginIcon = document.getElementById('login-icon');

  submitButton.disabled = true;
  spinner.style.display = 'inline-block';

  if (buttonText) {
   buttonText.textContent = 'Login...';
  }

  if (loginIcon) {
   loginIcon.style.display = 'none';
  }
 }

</script>
</body>
</html>
