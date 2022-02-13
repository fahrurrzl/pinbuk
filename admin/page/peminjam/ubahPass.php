<?php 
require_once '../functions/functions.php';

// jika tidak ada id di url
if (!isset($_GET['id'])) {
  // redirect
  echo "<script>
  alert('Data peminjam tidak ditemukan');
  document.location.href = '?page=pengarang';
  </script>";
  exit();
}

// ambil id dari url
$id = $_GET['id'];
$peminjam = query("SELECT * FROM peminjam WHERE id_peminjam = $id")[0];

// tombol simpan di klik
if(isset($_POST['ubah'])) {
  if(ubahPassword($_POST) > 0) {
      echo "<script>
      alert('Password berhasil diubah');
      document.location.href = '?page=peminjam';
      </script>";
  } else {
    echo "<script>
    alert('Password gagal diubah');
    document.location.href = '';
    </script>";
  }
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Peminjam</h1>
<a href="?page=peminjam&aksi=ubah&id=<?= $id; ?>" class="btn btn-primary mb-3">Kembali</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Peminjam</h6>
  </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form method="post" role="form" enctype="multipart/form-data">
            <input type="hidden" name="id_peminjam" value="<?= $peminjam['id_peminjam']; ?>">
              
            <div class="form-group">
              <label>Password Lama</label>
              <input type="password" class="form-control" name="password_lama" />
            </div>

            <div class="form-group">
              <label>Password Baru</label>
              <input type="password" class="form-control" name="password_baru" />
            </div>

            <div class="form-group">
              <label>Konfirmasi Password</label>
              <input type="password" class="form-control" name="konfirmasi_password" />
            </div>

            <div class="form-group">
              <input type="submit" name="ubah" value="Ubah Password" class="btn btn-success">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>