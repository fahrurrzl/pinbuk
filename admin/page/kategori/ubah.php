<?php 
require_once '../functions/functions.php';

$id = $_GET['id'];
$kategori = query("SELECT * FROM kategori WHERE id_kategori = $id")[0];

// tombol simpan di klik
if(isset($_POST['ubah'])) {
  if(ubahKategori($_POST) > 0) {
      echo "<script>
      alert('Kategori berhasil diubah');
      document.location.href = '?page=kategori';
      </script>";
  } else {
    echo "<script>
    alert('Kategori gagal diubah');
    document.location.href = '';
    </script>";
  }
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Kategori</h1>
<a href="?page=kategori" class="btn btn-primary mb-3">Kembali</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
  </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form action="" method="post" role="form">
            <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori']; ?>">
            <div class="form-group">
              <label>Nama Kategori</label>
              <input type="text" class="form-control" name="nama_kategori" value="<?= $kategori['nama_kategori']; ?>" />
            </div>

            <div class="form-group">
              <input type="submit" name="ubah" value="Ubah" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>