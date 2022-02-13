<?php 

$id = $_GET['id'];
// hapus detail peminjam
if(isset($_GET['aksi'])){
  if($_GET['aksi'] == 'hapus'){
    $query = "DELETE FROM detail_peminjam WHERE id_detail = '$id'";
    $result = mysqli_query($conn, $query);
    if($result){
      echo "<script>alert('Berhasil dihapus');</script>";
      echo "<script>location='?page=riwayat';</script>";
    } else {
      echo "<script>alert('Gagal dihapus');</script>";
      echo "<script>location='?page=riwayat';</script>";
    }
  }
}

?>