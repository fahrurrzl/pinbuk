<?php 
require_once '../functions/functions.php';

@$peminjam = query("SELECT * FROM peminjam ORDER BY id_peminjam DESC");
?>

<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Peminjam</h1>
<a href="?page=peminjam&aksi=tambah" class="btn btn-primary mb-3">Tambah Data Peminjam</a>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Peminjam</h6>
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
          if(empty($peminjam)) {
            echo "<tr><td colspan='7'><h1 style='text-align:center;'>Data peminjam masih kosong</h1></td></tr>";
          } else { foreach($peminjam as $p) : ?>
          <tr>
            <td><img src="../img/<?= $p['poto']; ?>" alt="Foto" class="img-thumbnail"></td>
            <td><?= $p['nama_peminjam']; ?></td>
            <td><?= $p['username']; ?></td>
            <td><?= $p['tempat_lahir']; ?></td>
            <?php
            // merubah format tanggal
            $tgl = $p['tl'];
            $tgl = date('d - m - Y', strtotime($tgl));
            ?>
            <td><?= $tgl; ?></td>
            <td><?= $p['jk']; ?></td>
            <td><?= $p['tlp']; ?></td>
            <td><?= $p['email']; ?></td>
            <td><?= $p['alamat']; ?></td>
            <td>
              <a href="?page=peminjam&aksi=ubah&id=<?= $p['id_peminjam']; ?>" class="btn btn-success btn-sm">edit</a>
              <a href="?page=peminjam&aksi=hapus&id=<?= $p['id_peminjam']; ?>" onclick="return confirm('Yakin ingin menghapus <?= $p['nama_peminjam']; ?>')" class="btn btn-danger btn-sm">hapus</a>
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