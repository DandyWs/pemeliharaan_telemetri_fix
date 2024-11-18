<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="assets/dist/img/logo.png">
    <title>Bank Sampah Malang</title>

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
        <a href="#" class="logo"><img src="assets/dist/img/logo.png" alt="logo" width="60"></a>
        <ul>
          <li><a href="#beranda">Beranda</a></li>
          <li><a href="#tentang-kami">Tentang Kami</a></li>
          <li><a href="#sampah">Jenis Sampah</a></li>
          <li><a href="#temukan-kami">Temukan Kami</a></li>
          <li><a href="#gabung">Gabung</a></li>
          <li><a href="{{ url('/login') }}" target="_blank">Login</a></li>
        </ul>
      </header>
      <div class="head-content">
        <div class="textBox">
          <h2>Ikut lestarikan lingkungan melalui <br><span>Bank Sampah Malang</span></h2>
          <p>Setor pilahan sampah anda, kami akan mengubahnya menjadi barang yang memiliki nilai jual. 
            Menguntungkan bagi alam juga bagi manusia.
          </p>
          <a href="#gabung">Daftar Menjadi Nasabah Kami</a>
        </div>
        <div class="imgBox">
          <img src="assets/dist/img/login.png" alt="" width="650px">
        </div>
      </div>
    </div>
  </section>

  <!--Tentang Kami-->
  <section id="tentang-kami">
    <div class="tentang-kami-container">
      <h3>Tentang Kami</h3>
      <img src="assets/dist/img/foto1.jpg" alt="">
      <br><span class="judul-isi">Bank Sampah Malang</span><br>
      <p>Sampah Malang (BSM) adalah suatu lembaga yang berbadan hukum koperasi yang pendiriannya difasilitasi oleh Pemerintah Kota Malang melalui Dinas Kebersihan dan Pertamanan untuk membantu dalam hal pemberdayaan masyarakat untuk ikut serta aktif dalam pengolahan sampah dari sumbernya (rumah tangga). 
      <br> <br> Seiring perjalanan waktu BSM menjadi mitra Kota Malang dalam hal membina, melatih, mendampingi dalam pengolahan sampah 3R (reduce, reuse and recycle) masyarakat Kota Malang yang mandiri.</p>
      <div class="clearfix"></div>
    </div>
    <div class="layanan-container" id="layanan">
      <div class="icons">
        <img src="assets/dist/img/edit.svg" alt="">
        <div class="info">
          <h6>Daftar</h6>
          <span>Mari mendaftar menjadi nasabah kami</span>
        </div>
      </div>
      <div class="icons">
        <img src="assets/dist/img/setor.svg" alt="">
        <div class="info">
          <h6>Setor</h6>
          <span>Setor sampah melalui sistem kami</span>
        </div>
      </div>
      <div class="icons">
        <img src="assets/dist/img/ambil.svg" alt="">
        <div class="info">
          <h6>Diambil</h6>
          <span>Pengambilan sampah dilakukan oleh Sopir kami</span>
        </div>
      </div>
      <div class="icons">
        <img src="assets/dist/img/bayar.svg" alt="">
        <div class="info">
          <h6>Kami Bayar</h6>
          <span>Kami bayar sampah sesuai yang disetorkan</span>
        </div>
      </div>
    </div>
  </section>

  <!-- Sampah -->
  <section id="sampah">
    <div class="sampah-container">
      <h3>Jenis Sampah</h3>
      <div class="sampah">
        <div class="box" data-name="s1">
          <img src="assets/dist/img/K1.jpg" alt="">
          <h5>KERTAS - K1</h5>
          <h6>Rp 1250/kg</h6>
        </div>
        <div class="box" data-name="s2">
          <img src="assets/dist/img/K2.jpg" alt="">
          <h5>KERTAS - K2</h5>
          <h6>Rp 2000/kg</h6>
        </div>
        <div class="box" data-name="s3">
          <img src="assets/dist/img/K3.jpg" alt="">
          <h5>KERTAS - K3</h5>
          <h6>Rp 1000/kg</h6>
        </div>
        <div class="box" data-name="s4">
          <img src="assets/dist/img/K4.jpg" alt="">
          <h5>KERTAS - K4</h5>
          <h6>Rp 1250/kg</h6>
        </div>
        <div class="box" data-name="s5">
          <img src="assets/dist/img/K5.jpg" alt="">
          <h5>KERTAS - K5</h5>
          <h6>Rp 2250/kg</h6>
        </div>
        <div class="box" data-name="s6">
          <img src="assets/dist/img/K6.jpg" alt="">
          <h5>KERTAS - K6</h5>
          <h6>Rp 3000/kg</h6>
        </div>
        <div class="box" data-name="s7">
          <img src="assets/dist/img/A1.jpg" alt="">
          <h5>LOGAM - A1</h5>
          <h6>Rp 6000/kg</h6>
        </div>
        <div class="box" data-name="s8">
          <img src="assets/dist/img/A2.jpg" alt="">
          <h5>LOGAM - A2</h5>
          <h6>Rp 5000/kg</h6>
        </div>
        <div class="box" data-name="s9">
          <img src="assets/dist/img/A3.jpg" alt="">
          <h5>LOGAM - A3</h5>
          <h6>Rp 4000/kg</h6>
        </div>
        <div class="box" data-name="s10">
          <img src="assets/dist/img/A6.jpg" alt="">
          <h5>LOGAM - A6</h5>
          <h6>Rp 3500/kg</h6>
        </div>
        <div class="box" data-name="s11">
          <img src="assets/dist/img/BS1.jpg" alt="">
          <h5>LOGAM - BS1</h5>
          <h6>Rp 6000/kg</h6>
        </div>
        <div class="box" data-name="s12">
          <img src="assets/dist/img/BS2.jpg" alt="">
          <h5>LOGAM - BS2</h5>
          <h6>Rp 5000/kg</h6>
        </div>
        <div class="box" data-name="s13">
          <img src="assets/dist/img/P01.jpg" alt="">
          <h5>PLASTIK - P1</h5>
          <h6>Rp 2000/kg</h6>
        </div>
        <div class="box" data-name="s14">
          <img src="assets/dist/img/P09.jpg" alt="">
          <h5>PLASTIK - P9</h5>
          <h6>Rp 2250/kg</h6>
        </div>
        <div class="box" data-name="s15">
          <img src="assets/dist/img/P12.jpg" alt="">
          <h5>PLASTIK - P12</h5>
          <h6>Rp 1500/kg</h6>
        </div>
        <div class="box" data-name="s16">
          <img src="assets/dist/img/P14.jpg" alt="">
          <h5>PLASTIK - P14</h5>
          <h6>Rp 1750/kg</h6>
        </div>
        <div class="box" data-name="s17">
          <img src="assets/dist/img/P19.jpg" alt="">
          <h5>PLASTIK - P19</h5>
          <h6>Rp 2000/kg</h6>
        </div>
        <div class="box" data-name="s18">
          <img src="assets/dist/img/P20.jpg" alt="">
          <h5>PLASTIK - P20</h5>
          <h6>Rp 2500/pcs</h6>
        </div>
        <div class="box" data-name="s19">
          <img src="assets/dist/img/P22.jpg" alt="">
          <h5>PLASTIK - P22</h5>
          <h6>Rp 2000/kg</h6>
        </div>
        <div class="box" data-name="s20">
          <img src="assets/dist/img/P26.jpg" alt="">
          <h5>PLASTIK - P26</h5>
          <h6>Rp 1250/kg</h6>
        </div>
        <div class="box" data-name="s21">
          <img src="assets/dist/img/P30.jpg" alt="">
          <h5>PLASTIK - P30</h5>
          <h6>Rp 2000/kg</h6>
        </div>
        <div class="box" data-name="s22">
          <img src="assets/dist/img/P36.jpg" alt="">
          <h5>PLASTIK - P36</h5>
          <h6>Rp 1750/kg</h6>
        </div>
        <div class="box" data-name="s23">
          <img src="assets/dist/img/P37.jpg" alt="">
          <h5>PLASTIK - P37</h5>
          <h6>Rp 3500/pcs</h6>
        </div>
        <div class="box" data-name="s24">
          <img src="assets/dist/img/B1.jpg" alt="">
          <h5>BOTOL - B1</h5>
          <h6>Rp 4000/kg</h6>
        </div>
        <div class="box" data-name="s25">
          <img src="assets/dist/img/B2.jpg" alt="">
          <h5>BOTOL - B2</h5>
          <h6>Rp 3750/kg</h6>
        </div>
        <div class="box" data-name="s26">
          <img src="assets/dist/img/B4.jpg" alt="">
          <h5>BOTOL - B4</h5>
          <h6>Rp 2500/kg</h6>
        </div>
        <div class="box" data-name="s27">
          <img src="assets/dist/img/B5.jpg" alt="">
          <h5>BOTOL - B5</h5>
          <h6>Rp 5000/kg</h6>
        </div>
        <div class="box" data-name="s28">
          <img src="assets/dist/img/B6.jpg" alt="">
          <h5>BOTOL - B6</h5>
          <h6>Rp 3000/kg</h6>
        </div>
        <div class="box" data-name="s29">
          <img src="assets/dist/img/B7.jpg" alt="">
          <h5>BOTOL - B7</h5>
          <h6>Rp 3250/kg</h6>
        </div>
        <div class="box" data-name="s30">
          <img src="assets/dist/img/B8.jpg" alt="">
          <h5>BOTOL - B8</h5>
          <h6>Rp 3000/kg</h6>
        </div>
      </div>
    </div>
    <!-- Sampah Preview -->
    <div class="sampah-preview">
      <div class="preview" data-target="s1">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/K1.jpg" alt="">
        <h5>KERTAS - K1</h5>
        <h6>Rp 1250/kg</h6>
        <p>Kertas bekas ujian maupun kertas putih dengan satu tinta warna lain</p>
      </div>
      <div class="preview" data-target="s2">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/K2.jpg" alt="">
        <h5>KERTAS - K2</h5>
        <h6>Rp 2000/kg</h6>
        <p>Kertas putih polos tanpa tinta</p>
      </div>
      <div class="preview" data-target="s3">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/K3.jpg" alt="">
        <h5>KERTAS - K3</h5>
        <h6>Rp 1000/kg</h6>
        <p>Kertas koran maupun kertas buram</p>
      </div>
      <div class="preview" data-target="s4">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/K4.jpg" alt="">
        <h5>KERTAS - K4</h5>
        <h6>Rp 1250/kg</h6>
        <p>Kertas karung semen maupun kertas craft</p>
      </div>
      <div class="preview" data-target="s5">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/K5.jpg" alt="">
        <h5>KERTAS - K5</h5>
        <h6>Rp 2250/kg</h6>
        <p>Kertas karton tipis seperti bungkus odol, minuman kemasan, sabun, dll</p>
      </div>
      <div class="preview" data-target="s6">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/K6.jpg" alt="">
        <h5>KERTAS - K6</h5>
        <h6>Rp 3000/kg</h6>
        <p>Kertas kardus maupun kertas karton tebal </p>
      </div>
      <div class="preview" data-target="s7">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/A1.jpg" alt="">
        <h5>LOGAM - A1</h5>
        <h6>Rp 6000/kg</h6>
        <p>Logam besi berat seperti seker motor</p>
      </div>
      <div class="preview" data-target="s8">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/A2.jpg" alt="">
        <h5>LOGAM - A2</h5>
        <h6>Rp 5000/kg</h6>
        <p>Logam jenis plat seperti plat motor, antena, maupun plat tipis lain</p>
      </div>
      <div class="preview" data-target="s9">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/A3.jpg" alt="">
        <h5>LOGAM - A3</h5>
        <h6>Rp 4000/kg</h6>
        <p>Logam besi sisa botol minuman kaleng</p>
      </div>
      <div class="preview" data-target="s10">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/A6.jpg" alt="">
        <h5>LOGAM - A6</h5>
        <h6>Rp 3500/kg</h6>
        <p>Tutup botol yang berbahan logam. Umumnya berasal dari botol minuman yang berbahan kaca</p>
      </div>
      <div class="preview" data-target="s11">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/BS1.jpg" alt="">
        <h5>LOGAM - BS1</h5>
        <h6>Rp 6000/kg</h6>
        <p>Logam besi berat seperti rantai</p>
      </div>
      <div class="preview" data-target="s12">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/BS2.jpg" alt="">
        <h5>LOGAM - BS2</h5>
        <h6>Rp 5000/kg</h6>
        <p>Logam besi plat tipis</p>
      </div>
      <div class="preview" data-target="s13">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P01.jpg" alt="">
        <h5>PLASTIK - P1</h5>
        <h6>Rp 2000/kg</h6>
        <p>Plastik bening polos tanpa gambar</p>
      </div>
      <div class="preview" data-target="s14">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P09.jpg" alt="">
        <h5>PLASTIK - P9</h5>
        <h6>Rp 2250/kg</h6>
        <p>Plastik dengan warna dan print gambar</p>
      </div>
      <div class="preview" data-target="s15">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P12.jpg" alt="">
        <h5>PLASTIK - P12</h5>
        <h6>Rp 1500/kg</h6>
        <p>Plastik gelas minuman kemasan</p>
      </div>
      <div class="preview" data-target="s16">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P14.jpg" alt="">
        <h5>PLASTIK - P14</h5>
        <h6>Rp 1750/kg</h6>
        <p>Plastik botol bening bekas minuman kemasan</p>
      </div>
      <div class="preview" data-target="s17">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P19.jpg" alt="">
        <h5>PLASTIK - P19</h5>
        <h6>Rp 2000/kg</h6>
        <p>Plastik botol tebal seperti botol bekas shampo, sabun, dll</p>
      </div>
      <div class="preview" data-target="s18">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P20.jpg" alt="">
        <h5>PLASTIK - P20</h5>
        <h6>Rp 2500/kg</h6>
        <p>Plastik tebal jerigen</p>
      </div>
      <div class="preview" data-target="s19">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P22.jpg" alt="">
        <h5>PLASTIK - P22</h5>
        <h6>Rp 2000/kg</h6>
        <p>Plastik dengan bahan seperti timba ataupun paralon</p>
      </div>
      <div class="preview" data-target="s20">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P26.jpg" alt="">
        <h5>PLASTIK - P26</h5>
        <h6>Rp 1250/kg</h6>
        <p>Tutup botol plastik</p>
      </div>
      <div class="preview" data-target="s21">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P30.jpg" alt="">
        <h5>PLASTIK - P30</h5>
        <h6>Rp 2000/kg</h6>
        <p>Plastik karung bening maupun berwarna</p>
      </div>
      <div class="preview" data-target="s22">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P36.jpg" alt="">
        <h5>PLASTIK - P36</h5>
        <h6>Rp 1750/kg</h6>
        <p>Plastik kaset bekas</p>
      </div>
      <div class="preview" data-target="s23">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/P37.jpg" alt="">
        <h5>PLASTIK - P37</h5>
        <h6>Rp 3500/kg</h6>
        <p>Galon plastik bening maupun berwarna</p>
      </div>
      <div class="preview" data-target="s24">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/B1.jpg" alt="">
        <h5>BOTOL - B1</h5>
        <h6>Rp 4000/kg</h6>
        <p>Botol kaca bening dengan stiker maupun sablon ukuran kecil sampai sedang</p>
      </div>
      <div class="preview" data-target="s25">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/B2.jpg" alt="">
        <h5>BOTOL - B2</h5>
        <h6>Rp 3750/kg</h6>
        <p>Botol kaca bening bekas sirup</p>
      </div>
      <div class="preview" data-target="s26">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/B4.jpg" alt="">
        <h5>BOTOL - B4</h5>
        <h6>Rp 2500/kg</h6>
        <p>Botol kaca bening dengan stiker bekas kecap</p>
      </div>
      <div class="preview" data-target="s27">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/B5.jpg" alt="">
        <h5>BOTOL - B5</h5>
        <h6>Rp 5000/kg</h6>
        <p>Botol kaca bening polos tanpa stiker maupun sablon dengan ukuran besar seperti botol bensin</p>
      </div>
      <div class="preview" data-target="s28">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/B6.jpg" alt="">
        <h5>BOTOL - B6</h5>
        <h6>Rp 3000/kg</h6>
        <p>Botol kaca bening berwarna dan stiker dengan ukuran besar</p>
      </div>
      <div class="preview" data-target="s29">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/B7.jpg" alt="">
        <h5>BOTOL - B7</h5>
        <h6>Rp 3250/kg</h6>
        <p>Botol kaca bening berwarna maupun tidak dan sablon dengan ukuran sedang</p>
      </div>
      <div class="preview" data-target="s30">
        <i class="fas fa-times"></i>
        <img src="assets/dist/img/B8.jpg" alt="">
        <h5>BOTOL - B8</h5>
        <h6>Rp 3000/kg</h6>
        <p>Botol kaca bening berwarna maupun tidak dan stiker dengan ukuran kecil</p>
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

  <!--Gabung Bersama Kami-->
  <section id="gabung">
    <div class="gabung">
      <div class="container">
        <h3>Gabung Bersama Kami</h3>
        <div class="row">
          <div class="col-12">
            <div class="gabung-content">
              <div class="gabung-content-kiri">
                <h4 class="text-white">Daftar Menjadi Nasabah Kami</h4>
                <p class="text-white">Sayarat dan Ketentuan</p>
                <ul class="text-white">
                  <li>Melakukan registrasi akun pada menu <a href="{{ url('/login') }}">Login</a></li>
                  <li>Beralamat di Kota Malang</li>
                  <li>Menyetorkan sampah yang sudah dipilah</li>
                  <li>Pick up sampah minimal berat 20kg</li>
                  <li>Sampah dengan berat &lt;20kg disetorkan langsung ke kantor Bank Sampah Malang</li>
                </ul>
              </div>
              <img src="assets/dist/img/daftar.svg" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
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
      Copyright ©2023 <strong>Bank Sampah Malang.</strong>
    </div>
  </footer>
  

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>