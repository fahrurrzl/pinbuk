<?php 
require_once '../functions/functions.php';

@$admin = query("SELECT * FROM admin ORDER BY id_admin DESC");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Admin</h1>
<a href="?page=admin&aksi=tambah" class="btn btn-primary mb-3">Tambah Data Admin</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Admin</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>username</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>No Hp / Telp</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>aksi</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>Foto</th>
            <th>Nama</th>
            <th>username</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>No Hp / Telp</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>aksi</th>
          </tr>
        </tfoot>
        <tbody>
          <?php 
          if(empty($admin)) {
            echo "<tr><td colspan='7'><h1 style='text-align:center;'>Data admin masih kosong</h1></td></tr>";
          } else { foreach($admin as $a) : ?>
          <tr>
            <td><img src="img/<?= $a['poto']; ?>" alt="Foto" class="img-thumbnail"></td>
            <td><?= $a['nama_admin']; ?></td>
            <td><?= $a['username']; ?></td>
            <td><?= $a['tempat_lahir']; ?></td>
            <?php
            // merubah format tanggal
            $tgl = $a['tl'];
            $tgl = date('d - m - Y', strtotime($tgl));
            ?>
            <td><?= $tgl; ?></td>
            <td><?= $a['jk']; ?></td>
            <td><?= $a['tlp']; ?></td>
            <td><?= $a['email']; ?></td>
            <td><?= $a['alamat']; ?></td>
            <td>
              <a href="?page=admin&aksi=ubah&id=<?= $a['id_admin']; ?>" class="btn btn-success btn-sm">edit</a>
              <a href="?page=admin&aksi=hapus&id=<?= $a['id_admin']; ?>" onclick="return confirm('Yakin ingin menghapus <?= $a['nama_admin']; ?>')" class="btn btn-danger btn-sm">hapus</a>
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