<?php 
require_once '../functions/functions.php';

@$buku = query("SELECT * FROM buku
INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang
INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
INNER JOIN kategori ON buku.id_kategori = kategori.id_kategori
ORDER BY id_buku DESC");
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
            <th>Kategori</th>
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
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>aksi</th>
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
            <td><?= $b['tahun_terbit']; ?></td>
            <td><?= $b['nama_kategori']; ?></td>
            <td><?= $b['jumlah']; ?></td>
            <td>
              <a href="?page=buku&aksi=ubah&id=<?= $b['id_buku']; ?>" class="btn btn-success btn-sm">edit</a>
              <a href="?page=buku&aksi=hapus&id=<?= $b['id_buku']; ?>" onclick="return confirm('Yakin ingin menghapus <?= $b['judul']; ?>')" class="btn btn-danger btn-sm">hapus</a>
            </td>
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