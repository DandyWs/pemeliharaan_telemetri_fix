<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="assets/dist/img/logo.png">
	<title>Login Bank Sampah</title>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/95c066a903.js" crossorigin="anonymous"></script>

</head>
<body>
  <div class="login">
    <section class="login d-flex">
      <div class="login-left w-50">
        <div class="row justify-content-center align-items-center h-100">
          <div class="col-7">
            <div class="header">
              <h1>Sign In <br><span> Bank Sampah </span></h1>
            </div>
              <div class="login-form">
                <form action="{{url('/login')}}" method="post">
                  @csrf
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                  placeholder="Masukkan email anda" value="{{ old('email') ?? '' }}" name="email">
                  @error('email')
                    <small class="text-danger">{{ $message }} </small>
                  @enderror
                  <br>

                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="floatingPassword" placeholder="Masukkan password anda" name="password">
                  @error('password')
                    <small class="text-danger">{{ $message }} </small>
                  @enderror

                  <div class="button-center">
                    <button type="submit" class="signin">Sign In</button>
                  </div>
                  <div class="text-center">
                    <span class="d-inline">Don't have an account? <a href="" data-bs-toggle="modal" data-bs-target="#daftar" class="d-inline text-decoration-none">Register</a></span>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
      <div class="login-right">
        <div class="row justify-content-center align-items-center h-100">
          <img src="assets/dist/img/login5.png" alt="">
        </div>
      </div>
    </section> 
  </div>
  
  <div class="modal fade" id="daftar" data-bs-backdrop="static" tabindex="-1" aria-labelledby="daftar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fw-bold mb-0 fs-2" id="exampleModalLabel">Register Bank Sampah</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('register') }}" method="post">
                @csrf
                <div class="modal-body">
                   <input type="hidden" value="{{ "N".$id_nasabah }}" name="id_nasabah">
                    <div class="mt-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                               placeholder="Masukkan nama lengkap anda" required>
                        @error('name')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control @error('email_register') is-invalid @enderror" name="email_register"
                               id="email"
                               placeholder="Masukkan email anda" required>
                        @error('email_register')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password_register') is-invalid @enderror"
                               name="password_register" id="password" placeholder="Masukkan password anda" required>
                        @error('password_register')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password"
                               class="form-control @error('password_register_confirmation') is-invalid @enderror"
                               name="password_register_confirmation" id="password_confirmation"
                               placeholder="Konfirmasi password anda" required>
                        @error('password_register_confirmation')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                               id="alamat"
                               placeholder="Masukkan alamat lengkap anda" required>
                        @error('alamat')
                        <small class="text-danger">{{ $message }} </small>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="phone" class="form-label">Nomor Handphone</label>
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                               id="phone"
                               placeholder="Masukkan nomor handphone anda" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="signup">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>

</body>
</html>