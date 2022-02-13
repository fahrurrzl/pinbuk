<?php 

require_once '../functions/functions.php';

// jika tidak ada variable id
if(!isset($_GET['id'])) {
  echo "<script>
          alert('Data Admin tidak ditemukan');
          document.location.href = '?page=admin';
        </script>";
        exit();
}

$id = $_GET['id'];

if(hapusAdmin($id) > 0) {
  echo "<script>
          alert('Data admin berhasil dihapus');
          document.location.href = '?page=admin';
        </script>";
} else {
  echo "<script>
          alert('Data admin gagal dihapus');
          document.location.href = '?page=admin';
        </script>";
}

?>