<?php 
require_once '../functions/functions.php';

$pengarang = query("SELECT * FROM pengarang");
$penerbit = query("SELECT * FROM penerbit");

// tombol simpan di klik
if(isset($_POST['simpan'])) {
  if(tambahBuku($_POST) > 0) {
      echo "<script>
      alert('Buku berhasil ditambahkan');
      document.location.href = '?page=buku';
      </script>";
  } else {
    echo "<script>
    alert('Buku gagal ditambahkan');
    document.location.href = '';
    </script>";
  }
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Buku</h1>
<a href="?page=buku" class="btn btn-primary mb-3">Kembali</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
  </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form method="post" role="form" enctype="multipart/form-data">
            <div class="form-group">
              <label>Foto</label>
              <img src="img/nosampul.jpg" class="img-preview img-thumbnail" alt="Sampul">
              <input type="file" class="poto form-control" name="poto" onchange="previewPoto()" />
            </div>

            <div class="form-group">
              <label>Judul</label>
              <input type="text" class="form-control" name="judul" />
            </div>

            <div class="form-group">
              <label>Pengarang</label>
              <select class="form-control" name="id_pengarang">
                  <option>-- Pilih Nama Pengarang --</option>
                  <?php foreach($pengarang as $p) : ?>
                  <option value="<?= $p['id_pengarang'] ?>"><?= $p['nama_pengarang'] ?></option>
                  <?php endforeach; ?>
              </select>
            </div>

            <div class="form-group">
              <label>Penerbit</label>
              <select class="form-control" name="id_penerbit">
                  <option>-- Pilih Nama Penerbit --</option>
                  <?php foreach($penerbit as $p) : ?>
                  <option value="<?= $p['id_penerbit'] ?>"><?= $p['nama_penerbit'] ?></option>
                  <?php endforeach; ?>
              </select>
            </div>
            
            <div class="form-group">
              <label>isbn</label>
              <input type="text" class="form-control" name="isbn" />
            </div>

            <div class="form-group">
              <label>Tahun Terbit</label>
              <input type="number" class="form-control" name="tahun_terbit" />
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Sinopsis</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="sinopsis"></textarea>
            </div>

            <div class="form-group">
              <label>Jumlah</label>
              <input class="form-control" name="jumlah" min="0" oninput="validity.valid||(value='');" type="number" />
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