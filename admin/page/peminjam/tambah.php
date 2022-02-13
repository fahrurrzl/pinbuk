<?php 
require_once '../functions/functions.php';

// tombol simpan di klik
if(isset($_POST['simpan'])) {
  if(registrasi($_POST) > 0) {
      echo "<script>
      alert('Peminjam berhasil ditambahkan');
      document.location.href = '?page=peminjam';
      </script>";
  } else {
    echo "<script>
    alert('Peminjam gagal ditambahkan');
    document.location.href = '';
    </script>";
  }
}

?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Peminjam</h1>
<a href="?page=peminjam" class="btn btn-primary mb-3">Kembali</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Peminjam</h6>
  </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <form method="post" role="form" enctype="multipart/form-data">
          <input type="hidden" name="poto" value="nopoto.jpg">
            <div class="form-group">
              <label>Foto</label>
              <input type="file" class="form-control" name="poto" />
            </div>

            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" name="nama_peminjam" />
            </div>

            <div class="form-group">
              <label>Username</label>
              <input type="text" class="form-control" name="username" />
            </div>

            <div class="form-group">
              <label>Tempat Lahir</label>
              <input type="text" class="form-control" name="tempat_lahir" />
            </div>

            <div class="form-group">
              <label>Tanggal Lahir</label>
              <input type="date" class="form-control" name="tl" />
            </div>

            <div class="form-group">
              <label>Jenis Kelamin</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" value="laki-laki" id="flexRadioDefault1">
                <label class="form-check-label" for="flexRadioDefault1">
                  Laki-laki
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jk" value="perempuan" id="flexRadioDefault2">
                <label class="form-check-label" for="flexRadioDefault2">
                  Perempuan
                </label>
              </div>
            </div>
            
            <div class="form-group">
              <label>No Hp / Telp</label>
              <input type="text" class="form-control" name="tlp" />
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email" />
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Alamat</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
            </div>

            <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" />
            </div>

            <div class="form-group">
              <label>Konfirmasi Password</label>
              <input type="password" class="form-control" name="password_konfirmasi" />
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