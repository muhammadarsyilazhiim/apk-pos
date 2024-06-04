<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/login/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/login/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/login/css/bootstrap.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('icons/favicon1.jpg') }}"/>
    <!-- End-CSS -->

  </head>
  <body>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
          <h2 class="mb-4 text-center">Selamat Datang Di{{ $market->nama_toko }}.</h2>
            <img src="assets/login/images/1.JPG" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6 contents">
            <div class="row justify-content-center">
              @if($users != 0)
                <div class="col-md-8">
                    <div class="mb-4">
                    <h3>Login</h3>
                </div>
                      <form action="{{ url('/verify_login') }}" method="post" name="login_form">
                        @csrf
                          <div class="form-group first">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" name="username">
                              <div class="input-group-append">
                                <span class="input-group-text check-value" id="username_error"></span>
                              </div>
                          </div>
                          <div class="form-group last mb-4">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" name="password" >
                              <div class="input-group-append">
                                <span class="input-group-text check-value" id="password_error"></span>
                              </div>
                          </div>
                          <input type="submit" value="Masuk" class="btn btn-block btn-primary submit-btn">
                      </form>
                      @else
                      <div class="col-md-8">
                        <div class="mb-4">
                        <h3>Create Account</h3>
                      </div>
                      <form action="{{ url('/first_account') }}" method="post" name="create_form">
                        @csrf
                          <div class="form-group first">
                              <label for="Nama">Nama</label>
                              <input type="text" class="form-control" name="nama">
                              <div class="input-group-append">
                                <span class="input-group-text check-value" id="nama_error"></span>
                              </div>
                          </div>
                          <div class="form-group first">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" name="email" >
                              <div class="input-group-append">
                                <span class="input-group-text check-value" id="email_error"></span>
                              </div>
                          </div>
                          <div class="form-group first">
                              <label for="username">Username</label>
                              <input type="text" class="form-control" name="username_2">
                              <div class="input-group-append">
                                <span class="input-group-text check-value" id="username_2_error"></span>
                              </div>
                          </div>
                          <div class="form-group last mb-4">
                              <label for="password">Password</label>
                              <input type="password" class="form-control" name="password_2" >
                              <div class="input-group-append">
                                <span class="input-group-text check-value" id="password_2_error"></span>
                              </div>
                          </div>
                          <div class="form-group">
                        <button class="btn btn-primary submit-btn btn-block">Buat Akun</button>
                      </div>
                          {{-- <input type="submit" value="Buat Akun" class="btn btn-block submit-btn btn-primary"> --}}
                      </form>
                    @endif
              </div>
            </div>
            
          </div>
          
        </div>
      </div>
    </div>

    <!-- Javascript -->
    <script src="{{ asset('assets/login/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/login/js/main.js') }}"></script>
    <script src="{{ asset('plugins/js/jquery.form-validator.min.js') }}"></script>
    <script src="{{ asset('plugins/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/login/script.js') }}"></script>
    <script type="text/javascript">
      @if ($message = Session::get('create_success'))
        swal(
            "Berhasil!",
            "{{ $message }}",
            "success"
        );
      @endif

      @if ($message = Session::get('login_failed'))
        swal(
            "Gagal!",
            "{{ $message }}",
            "error"
        );
      @endif
    </script>
    <!-- End-Javascript -->

  </body>
</html>
