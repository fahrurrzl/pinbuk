<?php 
session_start();

if( !isset($_SESSION['login']) ) {
  header("Location: login.php");
  exit;
}

require 'functions/functions.php';

// buku teratas
$buku_terbatu = query("SELECT * FROM buku
INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang
INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
ORDER BY id_buku DESC LIMIT 4");

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
    <title>Pinbuk</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- my css -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- ICONS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <!-- slick css -->
    <link rel="stylesheet" href="css/slick.css" />
    <link rel="stylesheet" href="css/slick-theme.css" />
  </head>
  <body>
    <!-- header start -->
    <header class="header">
      <a href="#home" class="logo"><i class="uil uil-book-open"></i></a>

      <nav class="navbar">
        <a href="#home">home</a>
        <a href="#books">books</a>
        <a href="#about">about</a>
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
            <li><a href="login.php">login</a></li>
            <li><a href="logout.php">log out</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- header end -->

    <!-- home start -->
    <section class="home" id="home">
      <div class="content">
        <h3>find your favorite <span class="line-down">books</span></h3>
        <p class="p-home">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim accusamus iure saepe non eos maiores hic illo est sed nesciunt!</p>
        <a href="" class="btn">get started</a>
      </div>

      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
        <?php foreach($buku_terbatu as $b) : ?>
          <div class="swiper-slide">
            <div class="card-home">
              <div class="img">
                <img src="img/dasar.jpg" alt="Buku" />
              </div>
              <div class="content">
                <h3 class="title"><?= $b['judul']; ?></h3>
                <p>pengarang : <?= $b['nama_pengarang']; ?></p>
                <p>penerbit : <?= $b['nama_penerbit']; ?></p>
                <div class="btnContainer">
                  <a class="btn-card" href='detail-card.php?id_buku=<?= $b['id_buku']; ?>'><i class="uil uil-message"></i></a>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <!-- home end -->

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

    <!-- about start -->
    <section class="about" id="about">
      <div class="heading">
        <span>about</span>
      </div>
      <div class="content-container">
        <div class="img">
          <img src="img/about.png" alt="" />
        </div>
        <div class="content">
          <h3>Why Should You Read <span class="lower-font">a</span> <span class="line-down">Books?</span></h3>
          <p class="p-home">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim accusamus iure saepe non eos maiores hic illo est sed nesciunt!</p>
          <a href="" class="btn">get started</a>
        </div>
      </div>
    </section>
    <!-- about end -->

    <!-- cta start -->
    <section class="cta" id="cta">
      <div class="content">
        <h3><span class="line-down">sign up</span> <span class="lower-font">and</span> get started to reading</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium, enim?</p>
        <a href="" class="btn">registrasi</a>
        <p class="alredy">alredy have an account? <a href="login.html">login</a></p>
      </div>
      <div class="img">
        <img src="img/cta.png" alt="cta" />
      </div>
    </section>
    <!-- cta end -->

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
