<?php 
session_start();

if(isset($_SESSION['login'])) {
  $id_peminjam = $_SESSION['login'];
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

// // menampilkan data detail peminjam
@$detailPinjam = query("SELECT * FROM detail_peminjam
INNER JOIN buku ON detail_peminjam.id_buku = buku.id_buku
INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang
INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
WHERE id_peminjam = $id_peminjam AND status = 'pinjam' ORDER BY tgl_kembali ASC");

// // menampilkan data peminjam
@$peminjam = mysqli_query($conn, "SELECT * FROM peminjam WHERE id_peminjam = '$id_peminjam'");
$row = mysqli_fetch_assoc($peminjam);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      <?php 
        @$p = $_GET['page'];
        @$a = $_GET['aksi'];
        if(!empty($p)) {
          if($p == 'Home') {
            echo "Home";
          } elseif($p == 'detail-profil') {
            echo "Detail Profil";
          } elseif($a == 'detail') {
            echo "Detail Buku";
          }
          else {
            echo "Home";
          }
        } else {
          echo "Home";
        }
      ?>
    </title>
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
      <a href="" class="logo"><i class="uil uil-book-open"></i></a>

      <nav class="navbar">
        <a href="?page=home">home</a>
        <a href="?page=home#books">books</a>
        <a href="?page=home#about">about</a>
        <?php if(isset($_SESSION['login'])) : ?>
        <a href="?page=buku-saya">dipinjam</a>
        <?php endif; ?>
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
            <?php if(isset($_SESSION['login'])) { ?>
            <li><a href="?page=detail-profil&id_peminjam=<?= $id_peminjam; ?>">profil</a></li>
            <li><a href="logout.php">log out</a></li>
            <?php } else {
              echo "<li><a href='login.php'>login</a></li>";
            } ?>
          </ul>
        </li>
      </ul>
    </header>
    <!-- header end -->


      <?php 
        @$page = $_GET['page'];
        @$aksi = $_GET['aksi'];

        if(!empty($page)) {
          if($page == 'home') {
            if ($aksi == 'detail') {
              include 'page/detail-card.php';
            } else {
              include 'page/home.php';
            }
          } elseif($page == 'detail-profil') {
            include 'page/detail-profil.php';
          } elseif($page == 'buku-saya'){
            include 'page/detail_peminjam.php';
          } else {
            include 'page/home.php';
          }
        } else {
          include 'page/home.php';
        }
      
      ?>

    <!-- footer start -->
    <footer>
      <div class="box-container">
        <div class="box">
          <h3>quick link</h3>
          <a href="#home">beranda</a>
          <a href="#books">buku</a>
          <a href="#about">tentang</a>
          <a href="#buku-saya">buku saya</a>
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
