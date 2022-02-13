<?php 
require_once '../functions/functions.php';

// jika tidak ada id di url
if (!isset($_GET['id'])) {
  // redirect
  echo "<script>
  alert('Data pengarang tidak ditemukan');
  document.location.href = '?page=pengarang';
  </script>";
  exit();
}

// ambil id dari url
$id = $_GET['id'];
$pengarang = query("SELECT * FROM pengarang WHERE id_pengarang = $id")[0];

// tombol simpan di klik
if(isset($_POST['ubah'])) {
  if(ubahPengarang($_POST) > 0) {
      echo "<script>
      alert('Data pengarang berhasil ditambahkan');
      document.location.href = '?page=pengarang';
      </script>";
  } else {
    echo "<script>
    alert('Data pengarang gagal ditambahkan');
    document.location.href = '';
    </script>";
  }
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Pengarang</h1>
<a href="?page=pengarang" class="btn btn-primary mb-3">Kembali</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Pengarang</h6>
  </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" name="potoLama" value="<?= $pengarang['poto']; ?>">
          <input type="hidden" name="id_pengarang" value="<?= $pengarang['id_pengarang']; ?>">
            <div class="form-group">
              <label>Foto</label>
              <img src="img/<?= $pengarang['poto']; ?>" class="img-preview img-thumbnail" alt="Sampul">
              <input type="file" class="poto form-control" name="poto" onchange="previewPoto()" />
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama_pengarang" value="<?= $pengarang['nama_pengarang']; ?>" />
            </div>

            <div class="form-group">
              <label>Tempat Lahir</label>
              <input type="text" class="form-control" name="tempat_lahir" value=<?= $pengarang['tempat_lahir']; ?> />
            </div>

            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date" class="form-control" name="tl" value=<?= $pengarang['tl']; ?> />
            </div>

            <div class="form-group">
              <label>Jenis Kelamin</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" value="laki-laki" id="flexRadioDefault1" <?php if($pengarang['jk'] == 'laki-laki') echo "checked" ?> >
                <label class="form-check-label" for="flexRadioDefault1">
                  Laki-laki
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" value="perempuan" id="flexRadioDefault2" <?php if($pengarang['jk'] == 'perempuan') echo "checked" ?> >
                <label class="form-check-label" for="flexRadioDefault2">
                  Perempuan
                </label>
              </div>
            </div>
            
            <div class="form-group">
              <label>No Hp / Telp</label>
              <input type="text" class="form-control" name="tlp" value="<?= $pengarang['tlp']; ?>" />
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Alamat</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"><?= $pengarang['alamat']; ?></textarea>
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