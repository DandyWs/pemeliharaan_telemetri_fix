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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/95c066a903.js" crossorigin="anonymous"></script>
  <!-- JS -->
  <script src="assets/js/script.js" defer></script>
=======
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
          <li><a href="#tentang-kami">Pemeliharaan Telemetri</a></li>
          <li><a href="#temukan-kami">Temukan Kami</a></li>
            @if(Auth::check())
            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            @else
            <li><a href="{{ url('/login') }}">Login</a></li>
            @endif

        </ul>
      </header>
      <div class="head-content">
        <div class="textBox">
          <h2>Selamat datang di website <br><span>Pemeliharaan Telemetri</span></h2>
          <p>Memantau perkembangan dan keadaan alat-alat telemetri yang ada di Setiap Stasiun, Anda dapat melakukan
            pengecekan berkala dan melakukan Pemeriksaan disini.
            Setelahnya Form akan langsung di tinjau oleh Kami.
          </p>
        </div>
        <div class="imgBox">
          <img src="assets\dist\img\login5 copy.png" alt="" width="650px">
        </div>
      </div>
    </div>
  </section>
  <br>
  <br>
  <br>
  <br>
  <!--Tentang Kami-->
  <section id="tentang-kami">
    <div class="layanan-container" id="layanan">
      <div class="icons">
        <div class="info">
          <h7><strong>
              <center>Tujuan Website Pemeliharaan Telemetri</center>
            </strong></h7>
          <ol>
            <li>Meningkatkan efisiensi pemeliharaan peralatan telemetri.</li>
            <li>Mempermudah akses dan pelaporan terkait pemeliharaan peralatan.</li>
            <li>Memastikan semua tahapan pemeliharaan tercatat dengan baik dan dapat dipantau secara real-time.</li>
          </ol>
        </div>
      </div>
      <div class="icons">
        <div class="info">
          <h7><strong>
              <center>Manfaat Website Pemeliharaan Telemetri</center>
            </strong></h7>
          <ol>
            <li>Mengurangi penggunaan kertas untuk mencatat pelapooran pemeliharaan telemetri</li>
            <li>Mengumpulkan data dari berbagai sumber dalam satu platform, memudahkan analisis dan pelaporan.</li>
            <li>Mengurangi waktu dan biaya yang diperlukan untuk pengumpulan dan pemrosesan data secara manual.</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Temukan Kami -->
  <section id="temukan-kami">
    <div class="temukan-kami-container">
      <h3>Temukan Kami</h3>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3951.3217728401746!2d112.61715557406616!3d-7.96566024309752!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788281b93990df%3A0xd788d8a4e1d290d8!2sPerum%20Jasa%20Tirta%20I!5e0!3m2!1sid!2sid!4v1733106093657!5m2!1sid!2sid"
        width="1100" height="600" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="clearfix"></div>
  </section>



  <!-- Footer -->

  <footer style="background: linear-gradient(to bottom, #48c6ef, #6f86d6); color: white; text-align: center; padding: 20px 10px;">
    <p>Jl. Surabaya 2A, Malang 65145, PO BOX 39</p>
    <p>Telp. (0341) 551971 | Faks. (0341) 551976</p>
    <p><a href="http://www.jasatirta1.co.id" target="_blank" style="color: white; text-decoration: none;">www.jasatirta1.co.id</a></p>
    <p><a href="mailto:mlg@jasatirta1.co.id" style="color: white; text-decoration: none;">mlg@jasatirta1.co.id</a></p>
    <div style="text-align: center; margin-top: 15px;">
    <a href="https://www.facebook.com/people/Perum-Jasa-Tirta-I/100063762302564/" style="font-size: 30px; color: black;"><i class="fab fa-facebook"></i></a>
    <a href="https://x.com/perumjasatirta1" style="font-size: 30px; color: black;"><i class="fab fa-twitter"></i></a>
    <a href="https://www.youtube.com/channel/UCFl_VO82S8oLmiEnlOHJTsA" style="font-size: 30px; color: black;"><i class="fab fa-youtube"></i></a>
    <a href="https://www.instagram.com/perumjasatirta1/?hl=en" style="font-size: 30px; color: black;"><i class="fab fa-instagram"></i></a>
    </div>
  </footer>
  <div class="copyright text-center p-3" style="background: linear-gradient(to bottom, #48c6ef, #6f86d6); color: white;">
  Copyright All Rights Reserve © 2024 <strong>Perum Jasa Tirta 1.</strong>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

</body>

</html>