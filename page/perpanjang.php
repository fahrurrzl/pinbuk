<?php 

$id = $_GET['id'];
$id_buku = $_GET['id_buku'];
$lambat = $_GET['lambat'];
$tgl_kembali = $_GET['tgl_kembali'];

if($lambat > 7) {
  echo "<script>
          alert('Maaf, buku tidak dapat diperpanjang, karena lebih dari 7 hari, kembalikan buku terlebih dahulu dan pinjam kembali');
          window.location.href = '?page=buku-saya';
        </script>";
} else {
  // tambah 7 hari
  $tgl_kembali = date('Y-m-d', strtotime($tgl_kembali . ' + 7 days'));
  $query = "UPDATE detail_peminjam SET tgl_kembali = '$tgl_kembali' WHERE id_detail = $id";
  $result = mysqli_query($conn, $query);
  if($result) {
    echo "<script>
          alert('Berhasil menambahkan 7 hari');
          window.location.href = '?page=buku-saya';
        </script>";
  } else {
    echo "<script>
          alert('Gagal menambahkan 7 hari');
          window.location.href = '?page=buku-saya';
        </script>";
  }
}

?>