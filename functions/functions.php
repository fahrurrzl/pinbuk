<?php 

// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "pinbuk");

// query menampilkan data
function query($query) {
  global $conn;
  $result = mysqli_query($conn, $query);
  $row = [];
  while( $row = mysqli_fetch_assoc($result) ) {
    $rows[] = $row;
  }
  return $rows;
}

// registrasi
function registrasi($data){
  global $conn;

  $nama_peminjam = htmlspecialchars($data['nama_peminjam']);
  $tempat_lahir = htmlspecialchars($data['tempat_lahir']);
  $tl = htmlspecialchars($data['tl']);
  $jk = htmlspecialchars($data['jk']);
  $tlp = htmlspecialchars($data['tlp']);
  $alamat = htmlspecialchars($data['alamat']);
  $username = strtolower(stripslashes($data['username']));
  $password = mysqli_real_escape_string($conn, $data['password']);
  $password_konfirmasi = mysqli_real_escape_string($conn, $data['password_konfirmasi']);
  $level = htmlspecialchars($data['level']);

  // ubah format tanggal
  $tl = $data['tl'];
  $tl = date('Y-m-d', strtotime($tl));

  // cel username
  $cek_username = mysqli_query($conn, "SELECT username FROM peminjam WHERE username = '$username'");
  if(mysqli_fetch_assoc($cek_username)) {
    echo "<script>
            alert('Username sudah terdaftar');
          </script>";
    return false;
  }
  // cek konfirmasi password
  if($password != $password_konfirmasi) {
    echo "<script>
            alert('Konfirmasi password tidak sesuai');
          </script>";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambahkan user baru
  $query = "INSERT INTO peminjam
            VALUES
            ('', '$nama_peminjam', '$tempat_lahir', '$tl', '$jk', '$tlp', '$alamat', '$username', '$password', '$level')
            ";
  mysqli_query($conn, $query);
  
  return mysqli_affected_rows($conn);
}
?>