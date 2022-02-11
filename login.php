<?php 
session_start();
require 'functions/functions.php';
if(isset($_SESSION['login'])) {
  header("Location: index.php");
}

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $result = mysqli_query($conn, "SELECT * FROM peminjam WHERE username = '$username'");
  // cek username
  if(mysqli_num_rows($result) === 1){
    // cek password
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row['password'])){
      // set session
      $_SESSION['login'] = $row['id_peminjam'];
      header("Location: index.php");
      exit;
    }
  }
  $error = true;
}

// registrasi
if(isset($_POST['registrasi'])) {
  if(registrasi($_POST) > 0){
    echo "<script>
            alert('Anda berhasil registrasi');
          </script>";
  } else {
    echo mysqli_error($conn);
  }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perpus</title>
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
            <li><a href="">log out</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- header end -->

    <!-- login start -->
    <section class="login" id="login">
      <div class="form-container signin-form">
        <div class="box signin-box">
          <h3>login</h3>
          <form action="" method="post">
            <?php if(isset($error)) : ?>
              <p style="color: red; font-style: italic; margin-bottom: 1rem; background: #dbd8e3; padding: .5rem; border-radius: .5rem; font-weight: bold; text-align: center;">username / password salah</p>
            <?php endif; ?>
            <div class="field">
              <i class="uil uil-at"></i>
              <input type="text" name="username" placeholder="username" required autocomplete="off" autofocus />
            </div>
            <div class="field">
              <i class="uil uil-lock"></i>
              <input class="password-input" type="password" name="password" placeholder="password" required />
              <div class="btn-eye"><i class="uil uil-eye-slash"></i></div>
            </div>

            <button name="login" class="btn">login</button>
          </form>
        </div>
        <div class="box-img signin-boxImg">
          <div class="link-slide">
            <p>don't have an acount?</p>
            <span class="btn-signup">sign up</span>
          </div>
          <img src="img/signin.png" alt="signinImg" />
        </div>
      </div>

      <!-- registrasi start -->
      <div class="form-container signup-form">
        <div class="box-img signup-boxImg">
          <div class="link-slide">
            <p>have an account?</p>
            <span class="btn-signin">sign in</span>
          </div>
          <img src="img/signup.png" alt="signinImg" />
        </div>
        <div class="box signup-box">
          <h3>sign up</h3>
          <form action="" method="post">
            <div class="field">
              <i class="uil uil-user"></i>
              <input type="text" name="nama_peminjam" placeholder="nama" required autocomplete="off" autofocus />
            </div>

            <div class="field">
              <i class="uil uil-user-circle"></i>
              <input type="text" name="username" placeholder="username" required autocomplete="off" />
            </div>

            <div class="field">
              <i class="uil uil-at"></i>
              <input type="text" name="tempat_lahir" placeholder="tempat lahir" required />
            </div>

            <div class="field">
              <i class="uil uil-user-circle"></i>
              <input type="date" name="tl" placeholder="tanggal lahir" required />
            </div>

            <div class="field">
              <i class="uil uil-user-circle"></i>
              <label class="form-control">
                <input type="radio" name="jk" value="laki-laki" />
                lali - laki
              </label>
              <label class="form-control">
                <input type="radio" name="jk" value="perempuan" />
                perempuan
              </label>
            </div>

            <div class="field">
              <i class="uil uil-user-circle"></i>
              <input type="tel" name="tlp" placeholder="no telp / HP" required />
            </div>

            <div class="field">
              <i class="uil uil-user-circle"></i>
              <input type="text" name="alamat" placeholder="alamat" required />
            </div>

            <div class="field">
              <i class="uil uil-lock"></i>
              <input class="password-input-signup" type="password" name="password" placeholder="password" required />
              <div class="btn-eye-signup"><i class="uil uil-eye-slash"></i></div>
            </div>

            <div class="field">
              <i class="uil uil-lock"></i>
              <input class="password-input-conf" type="password" name="password_konfirmasi" placeholder="konfirmasi password" required />
              <div class="btn-eye-conf"><i class="uil uil-eye-slash"></i></div>
            </div>

            <input type="hidden" name="level" value="peminjam">

            <input name="registrasi" class="btn" type="submit" value="sign up" />
          </form>
        </div>
      </div>
      <!-- registrasi end -->
    </section>
    <!-- login end -->

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
