<?php 

require_once '../functions/functions.php';

// jika tidak ada variable id
if(!isset($_GET['id'])) {
  echo "<script>
          alert('Data Peminjam tidak ditemukan');
          document.location.href = '?page=pengarang';
        </script>";
        exit();
}

$id = $_GET['id'];

if(hapusPeminjam($id) > 0) {
  echo "<script>
          alert('Data peminjam berhasil dihapus');
          document.location.href = '?page=peminjam';
        </script>";
} else {
  echo "<script>
          alert('Data peminjam gagal dihapus');
          document.location.href = '?page=peminjam';
        </script>";
}

?>