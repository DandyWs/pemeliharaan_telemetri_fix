<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="assets/dist/img/logo_jastir1.jpg">
    <title>Perum Jasa Tirta 1</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/95c066a903.js" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="assets/js/script.js" defer></script>

</head>
<body>
  <!-- Navbar -->
  <section id="beranda">
    <div class="beranda">
      <header>
        <a href="#" class="logo"><img src="assets/dist/img/logo_jastir1.jpg" alt="logo" width="60"></a>
        <ul>
          <li><a href="#beranda">Beranda</a></li>
          <li><a href="#tentang-kami">Tentang Kami</a></li>
          <li><a href="#sampah">Pemeliharaan Telemetri</a></li>
          <li><a href="#temukan-kami">Temukan Kami</a></li>
          <li><a href="#gabung">Gabung</a></li>
          <li><a href="{{ url('/login') }}" target="_blank">Login</a></li>
        </ul>
      </header>
      <div class="head-content">
        <div class="textBox">
          <h2>Selamat datang di website <br><span>Pemeliharaan Telemetri</span></h2>
          <p>Memantau perkembangan dan keadaan alat-alat telemetri yang ada di Setiap Stasiun, Anda dapat melakukan pengecekan berkala dan melakukan Pemeriksaan disini.
            Setelahnya Form akan langsung di tinjau oleh Kami.
          </p>
          <a href="#gabung">Daftar Menjadi Mekanik</a>
        </div>
        <div class="imgBox">
          <img src="assets\dist\img\login5 copy.png" alt="" width="650px">
        </div>
      </div>
    </div>
  </section>
  <br>
<br>
  <!--Tentang Kami-->
  <section id="tentang-kami">
    <div class="layanan-container" id="layanan">
      <div class="icons">
        <img src="assets/dist/img/edit.svg" alt="">
        <div class="info">
          <h6>Daftar</h6>
          <span>Daftar Menjadi Mekanik</span>
        </div>
      </div>
      <div class="icons">
        <img src="assets/dist/img/setor.svg" alt="">
        <div class="info">
          <h6>Pemeliharaan</h6>
          <span>Mekanik melakukan Pemeliharaan Peralatan Telemetri</span>
        </div>
      </div>
      <div class="icons">
        <img src="assets/dist/img/ambil.svg" alt="">
        <div class="info">
          <h6>Pemeriksaan</h6>
          <span>Pemeriksaan akan dilakukan oleh K.A Kalibrasi</span>
        </div>
      </div>
      <div class="icons">
        <img src="assets/dist/img/edit.svg" alt="">
        <div class="info">
          <h6>Konfirmasi</h6>
          <span>K.A mengkonfirmasi form dan bisa menandatangani Form Report</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Temukan Kami -->
  <section id="temukan-kami">
    <div class="temukan-kami-container">
      <h3>Temukan Kami</h3>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.0337594699236!2d112.61688607530391!3d-7.9954506797507525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7882a9d385ba91%3A0x667db69be1ab50c9!2sBank%20Sampah%20Malang!5e0!3m2!1sen!2sid!4v1684058288621!5m2!1sen!2sid"
      width="1100" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="clearfix"></div>
  </section>

  <!-- Footer -->
  <footer class="bg text-center text-white">
    <div class="container p-4 pb-0">
      <section class="mb-4">
        <a class="btn btn-outline-success btn-floating m-1" href="https://wa.me/6285755252327" role="button">
          <i class="fab fa-whatsapp"></i>
        </a>
        <a class="btn btn-outline-success btn-floating m-1" href="mailto:nadacika17@gmail.com" role="button">
          <i class="far fa-envelope"></i>
        </a>
        <a class="btn btn-outline-success btn-floating m-1" href="tel:+6285755252327" role="button">
          <i class="fas fa-phone"></i>
        </a>
      </section>
    </div>
    <div class="copyright text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      Copyright ©202 <strong>Perum Jasa Tirta 1.</strong>
    </div>
  </footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>
