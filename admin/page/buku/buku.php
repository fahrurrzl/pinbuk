<?php 
require_once '../functions/functions.php';

$buku = query("SELECT * FROM buku
INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang
INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Buku</h1>
<a href="?page=buku&aksi=tambah" class="btn btn-primary mb-3">Tambah Buku</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Buku</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>sampul</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>ISBN</th>
            <th>Tahun Terbit</th>
            <th>Jumlah</th>
            <th>aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>sampul</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>ISBN</th>
            <th>Tahun Terbit</th>
            <th>Jumlah</th>
            <th>aksi</th>
          </tr>
        </tfoot>
        <tbody>
          <?php foreach($buku as $b) : ?>
          <tr>
            <td><img src="img/<?= $b['sampul']; ?>" alt="" class="img-thumbnail"></td>
            <td><?= $b['judul']; ?></td>
            <td><?= $b['nama_pengarang']; ?></td>
            <td><?= $b['nama_penerbit']; ?></td>
            <td><?= $b['isbn']; ?></td>
            <td><?= $b['tahun_terbit']; ?></td>
            <td><?= $b['jumlah']; ?></td>
            <td>
              <a href="" class="btn btn-success btn-sm">edit</a>
              <a href="" class="btn btn-danger btn-sm">hapus</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->