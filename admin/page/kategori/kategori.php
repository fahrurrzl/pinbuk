<?php 
require_once '../functions/functions.php';

@$kategori = query("SELECT * FROM kategori");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Kategori</h1>
<a href="?page=kategori&aksi=tambah" class="btn btn-primary mb-3">Tambah Kategori</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Kategori</th>
            <th>aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>Nama Kategori</th>
            <th>aksi</th>
          </tr>
        </tfoot>
        <tbody>
          <?php 
          if(empty($kategori)) {
            echo "<tr><td colspan='7'><h1 style='text-align:center;'>Buku masih kosong</h1></td></tr>";
          } else { foreach($kategori as $k) : ?>
          <tr>
            <td><?= $k['nama_kategori']; ?></td>
            <td>
              <a href="?page=kategori&aksi=ubah&id=<?= $k['id_kategori']; ?>" class="btn btn-success btn-sm">edit</a>
              <a href="?page=kategori&aksi=hapus&id=<?= $k['id_kategori']; ?>" onclick="return confirm('Yakin ingin menghapus <?= $k['nama_kategori']; ?>')" class="btn btn-danger btn-sm">hapus</a>
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