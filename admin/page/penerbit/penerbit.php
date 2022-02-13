<?php 
require_once '../functions/functions.php';

@$penerbit = query("SELECT * FROM penerbit ORDER BY id_penerbit DESC");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Penerbit</h1>
<a href="?page=penerbit&aksi=tambah" class="btn btn-primary mb-3">Tambah Data Penerbit</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Penerbit</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Penerbit</th>
            <th>Alamat</th>
            <th>No Hp / Telp</th>
            <th>aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>Nama Penerbit</th>
            <th>Alamat</th>
            <th>No Hp / Telp</th>
            <th>aksi</th>
          </tr>
        </tfoot>
        <tbody>
          <?php 
          if(empty($penerbit)) {
            echo "<tr><td colspan='7'><h1 style='text-align:center;'>Data penerbit masih kosong</h1></td></tr>";
          } else { foreach($penerbit as $p) : ?>
          <tr>
            <td><?= $p['nama_penerbit']; ?></td>
            <td><?= $p['alamat']; ?></td>
            <td><?= $p['tlp']; ?></td>
            <td>
              <a href="?page=penerbit&aksi=ubah&id=<?= $p['id_penerbit']; ?>" class="btn btn-success btn-sm">edit</a>
              <a href="?page=penerbit&aksi=hapus&id=<?= $p['id_penerbit']; ?>" onclick="return confirm('Yakin ingin menghapus <?= $p['nama_penerbit']; ?>')" class="btn btn-danger btn-sm">hapus</a>
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