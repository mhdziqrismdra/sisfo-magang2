<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="{{asset('assets/css/login/style.css')}}" />
    <link rel="icon" href="{{asset('assets/img/logo_bkn.png')}}" type="image/x-icon"/>
    <title>Badan Kepegawaian Negara Kanreg XII Pekanbaru</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="{{url('postlogin')}}" method="POST" class="sign-in-form">
            @csrf
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" value="admin@gmail.com"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" value="admin" />
            </div>
            <input type="submit" value="Login" class="btn solid" />
          </form>

          <form action="{{url('simpanregistrasi')}}" class="sign-up-form" method="POST">
            @csrf
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="name" placeholder="Nama Lengkap" />

            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="number" name="nip" placeholder="NIP" />

            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" placeholder="Email" />

            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" />

            </div>
            <input type="submit" class="btn" value="Sign up" />

          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Sistem Informasi Penilaian Prestasi Kerja</h3>
            <p>
              Badan Kepegawaian Negara Kanreg XII Pekanbaru
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="{{asset('assets/img/log.svg')}}" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Sistem Informasi Penilaian Prestasi Kerja</h3>
            <p>
              Badan Kepegawaian Negara Kanreg XII Pekanbaru
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="{{asset('assets/img/register.svg')}}" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="{{asset('assets/css/login/app.js')}}"></script>
  </body>
</html>
@include('sweetalert::alert')