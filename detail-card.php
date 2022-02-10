<?php 
session_start();
require 'functions/functions.php';

if( !isset($_SESSION['login']) ) {
  header("Location: login.php");
  exit;
}

$id_buku = $_GET['id_buku'];
$detailBuku = query("SELECT * FROM buku
INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang
INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
WHERE id_buku = $id_buku")[0];

// menampilkan semua buku
$buku = query("SELECT * FROM buku
INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang
INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit");


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perpus</title>
    <link rel="stylesheet" type=”text/css” href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- my css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- ICONS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!-- slick css -->
    <link rel="stylesheet" href="css/slick.css" />
    <link rel="stylesheet" href="css/slick-theme.css" />
  </head>
  <body>
    <!-- header start -->
    <header class="header">
      <a href="index.html" class="logo"><i class="uil uil-book-open"></i></a>

      <nav class="navbar">
        <a href="index.php">home</a>
      </nav>

      <div class="btn-menu">
        <span class="topSpan"></span>
        <span class="centerSpan"></span>
        <span class="bottomSpan"></span>
      </div>

      <ul class="profil-container">
        <li class="profil-wrapper">
          <a href="#" class="profil"><i class="uil uil-user-circle"></i> </a>
          <ul class="profil-box">
            <li><a href="login.html">login</a></li>
            <li><a href="logout.php">log out</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- header end -->

    <!-- detail start -->
    <section class="detailBuku" id="detailBuku">
      <div class="detail-container">
        <div class="detail-wrapper">
          <div class="detail-img">
            <img src="img/sikolog.jpg" alt="sampul" />
          </div>
          <div class="detail-info">
            <h1><?= $detailBuku['judul']; ?></h1>
            <p>pengarang : <?= $detailBuku['nama_pengarang']; ?></p>
            <p>penerbit : <?= $detailBuku['nama_penerbit']; ?></p>
            <p>tahun terbit : <?= $detailBuku['tahun_terbit']; ?></p>
            <p>ISBN : <?= $detailBuku['isbn']; ?></p>
            <p>sinopsis : <br>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vitae, aperiam at nisi enim et nemo asperiores beatae, ipsa id nam mollitia, eos officiis error consequatur. Esse quisquam placeat rerum ea!
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eum, molestias vero, quod ab magnam repellendus accusamus tenetur architecto, iste ut temporibus accusantium adipisci sunt provident distinctio non pariatur quibusdam itaque?
            </p>
          </div>
          <div class="detail-pinjam">
            <div class="tgl">
              <div class="tgl-pinjam">
                <p>tanggal pinjam</p>
                <p><span>5-7-2020</span></p>
              </div>
              <div class="tgl-kembali">
                <p>tanggal kembali</p>
                <p><span>12-7-2020</span></p>
              </div>
            </div>
            <button class="btn">pinjam</button>
          </div>
        </div>
      </div>
    </section>
    <!-- detail end -->

    <!-- books start -->
    <section class="books" id="books">
      <div class="heading">
        <span>Books</span>
      </div>
      <!-- slider -->
      <div class="slider">
        <?php foreach($buku as $sb) : ?>
        <div>
          <!-- box slider -->
          <div class="box">
            <div class="slide-img">
              <img src="img/dasar.jpg" alt="Books" />
            </div>
            <!-- detail box -->
            <div class="detail-box">
              <!-- type -->
              <div class="type">
                <h3><?= $sb['judul']; ?></h3>
                <p>pengarang : <?= $sb['nama_pengarang']; ?></p>
                <p>pengarang : <?= $sb['nama_penerbit']; ?></p>
              </div>
              <!-- pinjam -->
              <div class="btnCard">
              <a class="btn-card" href='detail-card.php?id_buku=<?= $sb['id_buku']; ?>'><i class="uil uil-message"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>
    <!-- books end -->

    <!-- footer start -->
    <footer>
      <div class="box-container">
        <div class="box">
          <h3>quick link</h3>
          <a href="#home">home</a>
          <a href="#books">books</a>
          <a href="#about">about</a>
        </div>

        <div class="box">
          <h3>follow us</h3>
          <a href="#"><i class="uil uil-instagram-alt"></i> instagram</a>
          <a href="#"><i class="uil uil-facebook"></i> facebook</a>
          <a href="#"><i class="uil uil-linkedin"></i> linkedin</a>
          <a href="#"><i class="uil uil-github"></i> github</a>
        </div>

        <div class="box">
          <h3>contact us</h3>
          <a href="#">+6285784693875</a>
          <a href="#">+6281936161560</a>
          <a href="#">fahrurrzl5798@gmail.com</a>
          <a href="#">kediri, jawa timur, indonesia</a>
        </div>
      </div>

      <div class="copyright">created by <a href="#">M. fahrur rizal</a> | built with love.</div>
    </footer>
    <!-- footer end -->

    <!-- jquery -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <!-- script jquery -->
    <script src="js/script-jquery.js"></script>
    <!-- slick js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <!-- Swiper JS -->
    <!-- <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->
    <script src="js/swiper-bundle.min.js"></script>
    <!-- my js -->
    <script src="js/script.js"></script>
  </body>
</html>
