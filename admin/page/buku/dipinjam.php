<?php 
require_once '../functions/functions.php';

@$buku = query("SELECT * FROM detail_peminjam
INNER JOIN buku ON detail_peminjam.id_buku = buku.id_buku
INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang
INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
INNER JOIN kategori ON buku.id_kategori = kategori.id_kategori
INNER JOIN peminjam ON detail_peminjam.id_peminjam = peminjam.id_peminjam
ORDER BY id_detail DESC");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Buku</h1>
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
            <th>Kategori</th>
            <th>Peminjam</th>
            <th>status</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>sampul</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>ISBN</th>
            <th>Kategori</th>
            <th>Peminjam</th>
            <th>status</th>
          </tr>
        </tfoot>
        <tbody>
          <?php 
          if(empty($buku)) {
            echo "<tr><td colspan='7'><h1 style='text-align:center;'>Buku masih kosong</h1></td></tr>";
          } else { foreach($buku as $b) : ?>
          <tr>
            <td><img src="img/<?= $b['sampul']; ?>" alt="" class="img-thumbnail"></td>
            <td><?= $b['judul']; ?></td>
            <td><?= $b['nama_pengarang']; ?></td>
            <td><?= $b['nama_penerbit']; ?></td>
            <td><?= $b['isbn']; ?></td>
            <td><?= $b['nama_kategori']; ?></td>
            <td><?= $b['nama_peminjam']; ?></td>
            <td><?= $b['status']; ?></td>
          </tr>
          <?php endforeach; } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->