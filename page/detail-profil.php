<?php 

$id_peminjam = $_GET['id_peminjam'];

// menampilkan data peminjam
$query = "SELECT * FROM peminjam WHERE id_peminjam = $id_peminjam";
$peminjam = mysqli_query($conn, $query);
$peminjam = mysqli_fetch_assoc($peminjam);

// ubah data
if(isset($_POST['ubah'])){
  if(ubah($_POST) > 0) {
    echo "<script>
            alert('data berhasil diubah');
            document.location.href = 'index.php?page=detail-profil&id_peminjam=$id_peminjam';
          </script>";
  } else {
    echo "<script>
            alert('data gagal diubah');
            document.location.href = 'index.php';
          </script>";
  }
}

// ubah password
if(isset($_POST['ubah_password'])){
  if(ubahPassword($_POST) > 0){
    echo "<script>
            alert('Password berhasil diubah');
            document.location.href = 'index.php?page=detail-profil&id_peminjam=$id_peminjam';
          </script>";
  } else {
    echo "<script>
            alert('Password gagal diubah');
            document.location.href = 'index.php?page=detail-profil&id_peminjam=$id_peminjam';
          </script>";
  }
}

?>
<!-- detail profil start -->
<section class="detail-profil" id="detail-profil">
  <div class="detail-profil-container">
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="detail-profil-wrapper">
      <!-- lelft -->
      <div class="detail-profil-left">
        <div class="detail-profil-img">
          <img src="img/<?= $peminjam['poto']; ?>" alt="" class="img-preview" />
          <input type="hidden" name="potoLama" value="<?= $peminjam['poto']; ?>">
          <input type="file" name="poto" class="poto" onchange="previewPoto()" />
          <p style="margin-top: 2rem;">maksimal ukuran poto 3mb, dan ekstensi jpg, jpeg, png</p>

          <input type="hidden" name="id_peminjam" value="<?= $id_peminjam; ?>">
          <input type="hidden" name="gambar_lama" value="<?= $peminjam['poto']; ?>">

          <div class="form-control" style="margin-top: 5rem; width: 90%;">
            <input class="password-input-one" style="text-transform: none;" type="password" name="password_lama" placeholder="password lama" >
            <div class="btn-eye-one"><i class="uil uil-eye-slash"></i></div>
          </div>

          <div class="form-control" style="margin-top: 1rem; width: 90%;">
            <input class="password-input-two" style="text-transform: none;" type="password" name="password_baru" placeholder="password baru" >
            <div class="btn-eye-two"><i class="uil uil-eye-slash"></i></div>
          </div>

          <div class="form-control" style="margin-top: 1rem; width: 90%;">
            <input class="password-input-three" style="text-transform: none;" type="password" name="konfirmasi_password" placeholder="konfirmasi password">
            <div class="btn-eye-three"><i class="uil uil-eye-slash"></i></div>
          </div>

          <button style="margin-top: 2rem;" class="btn" name="ubah_password">ubah password</button>
        </div>
        <div class="detail-profil-text"></div>
      </div>
      <!-- right -->
      <div class="detail-profil-right">
        <div class="content">
          <input type="hidden" name="id_peminjam" value="<?= $id_peminjam ?>">
          <table border="none">
            <h2>data diri</h2>
            <tr>
              <td>username</td>
              <td>&nbsp;</td>
              <td>
                <div class="form-control">
                  <input class="disable" style="text-transform: none;" type="text" name="username" value="<?= $peminjam['username']; ?>" disabled>
                </div>
              </td>
            </tr>
            <tr>
              <td>nama</td>
              <td>&nbsp;</td>
              <td>
                <div class="form-control">
                  <input type="text" name="nama_peminjam" value="<?= $peminjam['nama_peminjam']; ?>">
                </div>
              </td>
            </tr>
            <tr>
              <td>tempat lahir</td>
              <td>&nbsp;</td>
              <td>
                <div class="form-control">
                  <input type="text" name="tempat_lahir" value="<?= $peminjam['tempat_lahir']; ?>">
                </div>
              </td>
            </tr>
            <tr>
              <td>tanggal lahir</td>
              <td>&nbsp;</td>
              <td>
                <div class="form-control">
                  <input type="date" name="tl" value="<?= $peminjam['tl']; ?>">
                </div>
              </td>
            </tr>
            <tr>
              <td>jenis kelamin</td>
              <td>&nbsp;</td>
              <td>
              <div class="field">
                <label class="form-control">
                  <input type="radio" name="jk" value="laki-laki" <?php if($peminjam['jk'] == 'laki-laki') echo "checked" ?> />
                  laki - laki
                </label>
                <label class="form-control">
                  <input type="radio" name="jk" value="perempuan" <?php if($peminjam['jk'] == 'perempuan') echo "checked" ?> />
                  perempuan
                </label>
            </div>
              </td>
            </tr>
          </table>

          <h2>data kontak</h2>
          <table>
            <tr>
              <td class="kontak">email</td>
              <td class="kontak">&nbsp;</td>
              <td class="kontak" style="text-transform: none;">
                <div class="form-control">
                  <input style="text-transform: none;" type="email" name="email" value="<?= $peminjam['email']; ?>">
                </div>
              </td>
            </tr>
            <tr>
              <td class="kontak">no hp</td>
              <td class="kontak">&nbsp;</td>
              <td class="kontak">
                <div class="form-control">
                  <input type="text" name="tlp" value="<?= $peminjam['tlp']; ?>">
                </div>
              </td>
            </tr>
          </table>
          <h2>alamat</h2>
          <table>
          <tr>
              <td class="kontak">alamat</td>
              <td class="kontak"></td>
              <td class="kontak">
                <div class="form-control">
                  <textarea name="alamat" id="alamat" cols="30" rows="10"><?= $peminjam['alamat']; ?>
                  </textarea>
                </div>
              </td>
            </tr>
          </table>
        </div>
        <button name="ubah" class="btn">ubah</button>
      </form>
      </div>
    </div>
  </div>
</section>
<!-- detail profil end -->

<script src="../js/script.js"></script>