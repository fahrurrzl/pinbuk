<?php 
require_once '../functions/functions.php';

// tombol simpan di klik
if(isset($_POST['simpan'])) {
  if(tambahKategori($_POST) > 0) {
      echo "<script>
      alert('Kategori berhasil ditambahkan');
      document.location.href = '?page=kategori';
      </script>";
  } else {
    echo "<script>
    alert('Kategori gagal ditambahkan');
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
          <form method="post" role="form">

            <div class="form-group">
              <label>Nama Kategori</label>
              <input type="text" class="form-control" name="nama_kategori" />
            </div>

            <div class="form-group">
              <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>