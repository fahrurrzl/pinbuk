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
  $email = htmlspecialchars($data['email']);
  $alamat = htmlspecialchars($data['alamat']);
  $username = strtolower(stripslashes($data['username']));
  $password = mysqli_real_escape_string($conn, $data['password']);
  $password_konfirmasi = mysqli_real_escape_string($conn, $data['password_konfirmasi']);
  $level = htmlspecialchars($data['level']);
  $poto = htmlspecialchars($data['poto']);

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
            ('', '$nama_peminjam', '$tempat_lahir', '$tl', '$jk', '$tlp', '$email', '$alamat', '$username', '$password', '$level', '$poto')";
  mysqli_query($conn, $query);
  
  return mysqli_affected_rows($conn);
}

// insert detail peminjaman
function pinjam($data) {
  global $conn;

  $id_peminjam = htmlspecialchars($data['id_peminjam']);
  $id_buku = htmlspecialchars($data['id_buku']);
  $tgl_pinjam = htmlspecialchars($data['tgl_pinjam']);
  $tgl_kembali = htmlspecialchars($data['tgl_kembali']);
  $status = htmlspecialchars($data['status']);

  // ubah format tanggal
  $tgl_pinjam = $data['tgl_pinjam'];
  $tgl_pinjam = date('Y-m-d', strtotime($tgl_pinjam));

  $tgl_kembali = $data['tgl_kembali'];
  $tgl_kembali = date('Y-m-d', strtotime($tgl_kembali));

  // cek apakah buku sudah dipinjam
  $cek_buku = mysqli_query($conn, "SELECT id_buku FROM detail_peminjam WHERE id_buku = '$id_buku' AND id_peminjam = '$id_peminjam' AND status = 'pinjam'");
  if(mysqli_fetch_assoc($cek_buku)) {
    echo "<script>
            alert('Buku sudah dipinjam');
          </script>";
    return false;
  }

  // cek jumlah buku
  $cek_jumlah = mysqli_query($conn, "SELECT jumlah FROM buku WHERE id_buku = '$id_buku'");
  $jumlah_buku = mysqli_fetch_assoc($cek_jumlah);
  if($jumlah_buku['jumlah'] == 0) {
    echo "<script>
            alert('stok buku habis');
          </script>";
    return false;
  }
  
  // tambah data
  $query = "INSERT INTO detail_peminjam
            VALUES
            ('', '$id_peminjam', '$id_buku', '$tgl_pinjam', '$tgl_kembali', '$status')
            ";
  mysqli_query($conn, $query);

  // update jumlah buku
  $jumlah_buku = $jumlah_buku['jumlah'] - 1;
  $sql = "UPDATE buku SET jumlah = '$jumlah_buku' WHERE id_buku = '$id_buku'";
  mysqli_query($conn, $sql);

  return mysqli_affected_rows($conn);

}

// selisih tanggal
function selisih($tgl_sekarang,$tgl_kembali) {
  $tgl_kembali = strtotime($tgl_kembali);
  $tgl_sekarang = strtotime($tgl_sekarang);
  $selisih = $tgl_sekarang - $tgl_kembali;
  $selisih = $selisih / (60 * 60 * 24);
  return $selisih;
}

// kembali buku
function kembali($data){
  global $conn;

  $id_detail = $data['id_detail'];
  $id_buku = $data['id_buku'];
  $status = $data['status'];

  $query = "UPDATE detail_peminjam SET status = '$status' WHERE id_detail = '$id_detail'";
  mysqli_query($conn, $query);

  // update jumlah buku
  $jumlah_buku = mysqli_query($conn, "SELECT jumlah FROM buku WHERE id_buku = '$id_buku'");
  $jumlah_buku = mysqli_fetch_assoc($jumlah_buku);
  $jumlah_buku = $jumlah_buku['jumlah'] + 1;
  $sql = "UPDATE buku SET jumlah = '$jumlah_buku' WHERE id_buku = '$id_buku'";
  mysqli_query($conn, $sql);

  return mysqli_affected_rows($conn);
}

// upload foto
function upload(){
  $nama_file = $_FILES['poto']['name'];
  $tipe_file = $_FILES['poto']['type'];
  $ukuran_file = $_FILES['poto']['size'];
  $tmp_file = $_FILES['poto']['tmp_name'];
  $error = $_FILES['poto']['error'];

  // ketika tidak ada gambara yang dipilih
  if($error == 4) {
    return 'nopoto.jpg';
  }

  // cek ekstensi file
  $daftar_gambar = ['jpg', 'jpeg', 'png'];
  $ekstensi_file = explode('.', $nama_file);
  $ekstensi_file = strtolower(end($ekstensi_file));

  if(!in_array($ekstensi_file, $daftar_gambar)){
    echo "<script>
            alert('yang anda pilih bukan gambar');
          </script>";
    return false;
  }

  // cek tipe file
  if($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
    echo "<script>
            alert('yang anda pilih bukan gambar');
          </script>";
    return false;
  }

  // cek ukuran file lebih dari 3mb
  if($ukuran_file > 3000000) {
    echo "<script>
            alert('ukuran gambar terlalu besar');
          </script>";
    return false;
  }

  // lolos cek
  // generate nama file baru
  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;

  // upload file
  move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);
  return $nama_file_baru;
}

// ubah data peminjam
function ubah($data) {
  global $conn;

  $id_peminjam = $data['id_peminjam'];
  $nama_peminjam = htmlspecialchars($data['nama_peminjam']);
  $tempat_lahir = htmlspecialchars($data['tempat_lahir']);
  $tl = htmlspecialchars($data['tl']);
  $jk = htmlspecialchars($data['jk']);
  $tlp = htmlspecialchars($data['tlp']);
  $email = htmlspecialchars($data['email']);
  $alamat = htmlspecialchars($data['alamat']);
  $potoLama = htmlspecialchars($data['potoLama']);

  $poto = upload();
  if(!$poto) {
    return false;
  }

  if($poto == 'nopoto.jpg') {
    $poto = $potoLama;
  }

  $query = "UPDATE peminjam SET
            nama_peminjam = '$nama_peminjam',
            tempat_lahir = '$tempat_lahir',
            tl = '$tl',
            jk = '$jk',
            tlp = '$tlp',
            email = '$email',
            alamat = '$alamat',
            poto = '$poto'
            WHERE id_peminjam = '$id_peminjam'
            ";

  mysqli_query($conn, $query);
  mysqli_errno($conn);
  return mysqli_affected_rows($conn);
}

// ubah password
function ubahPassword($data) {
  global $conn;

  $id_peminjam = $data['id_peminjam'];
  $password_lama = mysqli_real_escape_string($conn, $data['password_lama']);
  $password_baru = mysqli_real_escape_string($conn, $data['password_baru']);
  $konfirmasi_password = mysqli_real_escape_string($conn, $data['konfirmasi_password']);

  // cek password lama
  $result = mysqli_query($conn, "SELECT password FROM peminjam WHERE id_peminjam = '$id_peminjam'");
  $peminjam = mysqli_fetch_assoc($result);
  if(!password_verify($password_lama, $peminjam['password'])) {
    echo "<script>
            alert('Password lama salah');
          </script>";
    return false;
  }

  // cek konfirmasi password
  if($password_baru !== $konfirmasi_password) {
    echo "<script>
            alert('Konfirmasi password tidak sesuai');
          </script>";
    return false;
  }

  // enkripsi password
  $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);

  // tambah data
  $query = "UPDATE peminjam SET password = '$password_baru' WHERE id_peminjam = '$id_peminjam'";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

// cari buku
function cari($keyword) {
  $query = "SELECT * FROM buku
  INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang
  INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
            WHERE
            judul LIKE '%$keyword%' OR
            tahun_terbit LIKE '%$keyword%' OR
            isbn LIKE '%$keyword%' OR
            nama_penerbit LIKE '%$keyword%' OR
            nama_pengarang LIKE '%$keyword%'
            ";
  return query($query);
}
?>