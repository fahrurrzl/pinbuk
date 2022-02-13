<?php 

require_once '../functions/functions.php';

// jika tidak ada variable id
if(!isset($_GET['id'])) {
  echo "<script>
          alert('Data Pengarang tidak ditemukan');
          document.location.href = '?page=pengarang';
        </script>";
        exit();
}

$id = $_GET['id'];

if(hapusPengarang($id) > 0) {
  echo "<script>
          alert('Data pengarang berhasil dihapus');
          document.location.href = '?page=pengarang';
        </script>";
} else {
  echo "<script>
          alert('Data pengarang gagal dihapus');
          document.location.href = '?page=pengarang';
        </script>";
}

?>