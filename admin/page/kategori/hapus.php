<?php 

require_once '../functions/functions.php';

// jika tidak ada variable id
if(!isset($_GET['id'])) {
  echo "<script>
          alert('Kategori tidak ditemukan');
          document.location.href = '?page=buku';
        </script>";
        exit();
}

$id = $_GET['id'];

if(hapusKategori($id) > 0) {
  echo "<script>
          alert('Kategori berhasil dihapus');
          document.location.href = '?page=kategori';
        </script>";
} else {
  echo "<script>
          alert('Kategori gagal dihapus');
          document.location.href = '?page=kategori';
        </script>";
}

?>