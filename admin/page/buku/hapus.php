<?php 

require_once '../functions/functions.php';

// jika tidak ada variable id
if(!isset($_GET['id'])) {
  echo "<script>
          alert('Buku tidak ditemukan');
          document.location.href = '?page=buku';
        </script>";
        exit();
}

$id = $_GET['id'];

if(hapusBuku($id) > 0) {
  echo "<script>
          alert('Buku berhasil dihapus');
          document.location.href = '?page=buku';
        </script>";
} else {
  echo "<script>
          alert('Buku gagal dihapus');
          document.location.href = '?page=buku';
        </script>";
}

?>