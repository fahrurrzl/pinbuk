<?php 

require_once '../functions/functions.php';

// jika tidak ada variable id
if(!isset($_GET['id'])) {
  echo "<script>
          alert('Penerbit tidak ditemukan');
          document.location.href = '?page=penerbit';
        </script>";
        exit();
}

$id = $_GET['id'];

if(hapusPenerbit($id) > 0) {
  echo "<script>
          alert('Penerbit berhasil dihapus');
          document.location.href = '?page=penerbit';
        </script>";
} else {
  echo "<script>
          alert('Penerbit gagal dihapus');
          document.location.href = '?page=penerbit';
        </script>";
}

?>