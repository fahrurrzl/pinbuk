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
            ('', '$nama_peminjam', '$tempat_lahir', '$tl', '$jk', '$tlp', '$email', '$alamat', '$username', '$password', '$poto')";
  mysqli_query($conn, $query);
  
  return mysqli_affected_rows($conn);
}

function registrasiAdmin($data){
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
  $poto = htmlspecialchars($data['poto']);

  // ubah format tanggal
  $tl = $data['tl'];
  $tl = date('Y-m-d', strtotime($tl));

  // cel username
  $cek_username = mysqli_query($conn, "SELECT username FROM admin WHERE username = '$username'");
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
  $query = "INSERT INTO admin
            VALUES
            ('', '$nama_peminjam', '$tempat_lahir', '$tl', '$jk', '$tlp', '$email', '$alamat', '$username', '$password', '$poto')";
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
            ('', '$id_peminjam', '$id_buku', '$tgl_pinjam', '$tgl_kembali', '$status', '')";
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
  $tgl_dikembalikan = $data['tgl_dikembalikan'];

  $query = "UPDATE detail_peminjam SET status = '$status', tgl_dikembalikan = '$tgl_dikembalikan' WHERE id_detail = '$id_detail'";
  mysqli_query($conn, $query);

  // update jumlah buku
  $jumlah_buku = mysqli_query($conn, "SELECT jumlah FROM buku WHERE id_buku = '$id_buku'");
  $jumlah_buku = mysqli_fetch_assoc($jumlah_buku);
  $jumlah_buku = $jumlah_buku['jumlah'] + 1;
  $sql = "UPDATE buku SET jumlah = '$jumlah_buku' WHERE id_buku = '$id_buku'";
  mysqli_query($conn, $sql);

  return mysqli_affected_rows($conn);
}

// pinjam kembali
function pinjamKembali($data){
  global $conn;

  $id_detail = $data['id_detail'];
  $id_peminjam = $data['id_peminjam'];
  $id_buku = $data['id_buku'];
  $tgl_sekarang = $data['tgl_sekarang'];

  // tambah 7 hari tanggal sekarang
  $tgl_kembali = date('Y-m-d', strtotime($tgl_sekarang. ' + 7 days'));

  // cek jumlah buku
  $cek_jumlah = mysqli_query($conn, "SELECT jumlah FROM buku WHERE id_buku = '$id_buku'");
  $jumlah_buku = mysqli_fetch_assoc($cek_jumlah);
  if($jumlah_buku['jumlah'] == 0) {
    echo "<script>
            alert('stok buku habis');
          </script>";
    return false;
  }

  // update detail peminjam
  $query = "UPDATE detail_peminjam SET tgl_pinjam = '$tgl_sekarang', tgl_kembali = '$tgl_kembali', status = 'pinjam' WHERE id_detail = '$id_detail' AND id_peminjam = '$id_peminjam'";
  mysqli_query($conn, $query);

  // update jumlah buku
  $jumlah_buku = mysqli_query($conn, "SELECT jumlah FROM buku WHERE id_buku = '$id_buku'");
  $jumlah_buku = mysqli_fetch_assoc($jumlah_buku);
  $jumlah_buku = $jumlah_buku['jumlah'] - 1;
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

// upload untuk admin
function uploadAdmin(){
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
  move_uploaded_file($tmp_file, '../img/' . $nama_file_baru);
  return $nama_file_baru;
}

function ubahForAdmin($data) {
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

  $poto = uploadAdmin();
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
  mysqli_error($conn);
  return mysqli_affected_rows($conn);
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
  mysqli_error($conn);
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
  INNER JOIN kategori ON buku.id_kategori = kategori.id_kategori
            WHERE
            judul LIKE '%$keyword%' OR
            tahun_terbit LIKE '%$keyword%' OR
            isbn LIKE '%$keyword%' OR
            nama_penerbit LIKE '%$keyword%' OR
            nama_pengarang LIKE '%$keyword%' OR
            nama_kategori LIKE '%$keyword%'
            ";
  return query($query);
}

// halaman admin
// upload sampul
function uploadSampul(){
  $nama_file = $_FILES['poto']['name'];
  $tipe_file = $_FILES['poto']['type'];
  $ukuran_file = $_FILES['poto']['size'];
  $tmp_file = $_FILES['poto']['tmp_name'];
  $error = $_FILES['poto']['error'];

  // ketika tidak ada gambara yang dipilih
  if($error == 4) {
    return 'nosampul.jpg';
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
// tambah buku
function tambahBuku($data) {
  global $conn;

  $judul = htmlspecialchars($data['judul']);
  $tahun_terbit = htmlspecialchars($data['tahun_terbit']);
  $isbn = htmlspecialchars($data['isbn']);
  $sinopsis = htmlspecialchars($data['sinopsis']);
  $id_penerbit = htmlspecialchars($data['id_penerbit']);
  $id_pengarang = htmlspecialchars($data['id_pengarang']);
  $id_kategori = htmlspecialchars($data['id_kategori']);
  $jumlah = htmlspecialchars($data['jumlah']);

  $poto = uploadSampul();
  if(!$poto) {
    return false;
  }

  // cek jika input ada yang kosong
  if($judul == '' || $tahun_terbit == '' || $poto == '' || $isbn == '' || $sinopsis == '' || $id_penerbit == '' || $id_pengarang == '' || $id_kategori == '' || $jumlah == '') {
    echo "<script>
            alert('tidak boleh ada yang kosong');
          </script>";
    return false;
  }

  // cek jika isbn sama
  $result = mysqli_query($conn, "SELECT isbn FROM buku WHERE isbn = '$isbn'");
  if(mysqli_fetch_assoc($result)) {
    echo "<script>
            alert('isbn sudah ada');
          </script>";
    return false;
  }

  // tambah data
  $query = "INSERT INTO buku
            VALUES
            ('', '$judul', '$tahun_terbit', '$poto', '$isbn', '$sinopsis', '$id_penerbit', '$id_pengarang', '$id_kategori', '$jumlah')
            ";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

// hapus buku
function hapusBuku($id){
  global $conn;

  $buku = query("SELECT * FROM buku WHERE id_buku = $id")[0];
  if($buku['sampul'] != 'nosampul.jpg') {
    unlink('img/' . $buku['sampul']);
  }
  
  // hapus data
  $query = "DELETE FROM buku WHERE id_buku = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

// ubah buku
function ubahBuku($data) {
  global $conn;

  $id_buku = $data['id_buku'];
  $judul = htmlspecialchars($data['judul']);
  $tahun_terbit = htmlspecialchars($data['tahun_terbit']);
  $isbn = htmlspecialchars($data['isbn']);
  $sinopsis = htmlspecialchars($data['sinopsis']);
  $id_penerbit = htmlspecialchars($data['id_penerbit']);
  $id_pengarang = htmlspecialchars($data['id_pengarang']);
  $id_kategori = htmlspecialchars($data['id_kategori']);
  $jumlah = htmlspecialchars($data['jumlah']);
  $potoLama = htmlspecialchars($data['potoLama']);

  $poto = uploadSampul();
  if(!$poto) {
    return false;
  }
  
  if($poto == 'nosampul.jpg') {
    $poto = $potoLama;
  }

  // cek jika input ada yang kosong
  if($judul == '' || $tahun_terbit == '' || $poto == '' || $isbn == '' || $sinopsis == '' || $id_penerbit == '' || $id_pengarang == '' || $id_kategori == '' || $jumlah == '') {
    echo "<script>
            alert('tidak boleh ada yang kosong');
          </script>";
    return false;
  }

  // ubah data
  $query = "UPDATE buku SET
            judul = '$judul',
            tahun_terbit = '$tahun_terbit',
            sampul = '$poto',
            isbn = '$isbn',
            sinopsis = '$sinopsis',
            id_penerbit = '$id_penerbit',
            id_pengarang = '$id_pengarang',
            id_kategori = '$id_kategori',
            jumlah = '$jumlah'
            WHERE id_buku = '$id_buku'
            ";
  mysqli_query($conn, $query);
  mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

// tambah pengarang
function tambahPengarang($data) {
  global $conn;

  $nama_pengarang = htmlspecialchars($data['nama_pengarang']);
  $tempat_lahir = htmlspecialchars($data['tempat_lahir']);
  $tl = htmlspecialchars($data['tl']);
  $jk = htmlspecialchars($data['jk']);
  $tlp = htmlspecialchars($data['tlp']);
  $alamat = htmlspecialchars($data['alamat']);

  // upload poto
  $poto = upload();
  if(!$poto) {
    return false;
  }

  // cek jika input ada yang kosong
  if($nama_pengarang == '' || $tempat_lahir == '' || $tl == '' || $jk == '' || $tlp == '' || $alamat == '') {
    echo "<script>
            alert('tidak boleh ada yang kosong');
          </script>";
    return false;
  }

  // tambah data
  $query = "INSERT INTO pengarang
            VALUES
            ('', '$nama_pengarang', '$tempat_lahir', '$tl', '$jk', '$tlp', '$alamat', '$poto')
            ";
  mysqli_query($conn, $query);
  mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

// hapus pengaran
// hapus buku
function hapusPengarang($id){
  global $conn;

  $pengarang = query("SELECT * FROM pengarang WHERE id_pengarang = $id")[0];
  if($pengarang['poto'] != 'nopoto.jpg') {
    unlink('img/' . $pengarang['poto']);
  }
  
  // hapus data
  $query = "DELETE FROM pengarang WHERE id_pengarang = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

// ubah pengarang
function ubahPengarang($data) {
  global $conn;

  $id_pengarang = $data['id_pengarang'];
  $nama_pengarang = htmlspecialchars($data['nama_pengarang']);
  $tempat_lahir = htmlspecialchars($data['tempat_lahir']);
  $tl = htmlspecialchars($data['tl']);
  $jk = htmlspecialchars($data['jk']);
  $tlp = htmlspecialchars($data['tlp']);
  $alamat = htmlspecialchars($data['alamat']);
  $potoLama = htmlspecialchars($data['potoLama']);

  $poto = upload();
  if(!$poto) {
    return false;
  }
  
  if($poto == 'nopoto.jpg') {
    $poto = $potoLama;
  }

  // cek jika input ada yang kosong
  if($nama_pengarang == '' || $tempat_lahir == '' || $tl == '' || $jk == '' || $tlp == '' || $alamat == '') {
    echo "<script>
            alert('tidak boleh ada yang kosong');
          </script>";
    return false;
  }

  // ubah data
  $query = "UPDATE pengarang SET
            nama_pengarang = '$nama_pengarang',
            tempat_lahir = '$tempat_lahir',
            tl = '$tl',
            jk = '$jk',
            tlp = '$tlp',
            alamat = '$alamat',
            poto = '$poto'
            WHERE id_pengarang = '$id_pengarang'
            ";
  mysqli_query($conn, $query);
  mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

// hapus penerbit
function hapusPenerbit($id){
  global $conn;

  $penerbit = query("SELECT * FROM penerbit WHERE id_penerbit = $id")[0];
  
  // hapus data
  $query = "DELETE FROM penerbit WHERE id_penerbit = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

// tambah pernerbit
function tambahPenerbit($data) {
  global $conn;

  $nama_penerbit = htmlspecialchars($data['nama_penerbit']);
  $tlp = htmlspecialchars($data['tlp']);
  $alamat = htmlspecialchars($data['alamat']);

  // cek jika input ada yang kosong
  if($nama_penerbit == '' || $tlp == '' || $alamat == '') {
    echo "<script>
            alert('tidak boleh ada yang kosong');
          </script>";
    return false;
  }

  // tambah data
  $query = "INSERT INTO penerbit
            VALUES
            ('', '$nama_penerbit', '$tlp', '$alamat')
            ";
  mysqli_query($conn, $query);
  mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

// ubah penerbit
function ubahPenerbit($data) {
  global $conn;

  $id_penerbit = $data['id_penerbit'];
  $nama_penerbit = htmlspecialchars($data['nama_penerbit']);
  $tlp = htmlspecialchars($data['tlp']);
  $alamat = htmlspecialchars($data['alamat']);

  // cek jika input ada yang kosong
  if($nama_penerbit == '' || $tlp == '' || $alamat == '') {
    echo "<script>
            alert('tidak boleh ada yang kosong');
          </script>";
    return false;
  }

  // ubah data
  $query = "UPDATE penerbit SET
            nama_penerbit = '$nama_penerbit',
            tlp = '$tlp',
            alamat = '$alamat'
            WHERE id_penerbit = '$id_penerbit'
            ";
  mysqli_query($conn, $query);
  mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

// hapus peminjam
function hapusPeminjam($id){
  global $conn;

  $peminjam = query("SELECT * FROM peminjam WHERE id_peminjam = $id")[0];
  
  // hapus data
  $query = "DELETE FROM peminjam WHERE id_peminjam = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

// hapus admin
function hapusAdmin($id){
  global $conn;

  $admin = query("SELECT * FROM admin WHERE id_admin = $id")[0];
  
  // hapus data
  $query = "DELETE FROM admin WHERE id_admin = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

// ubah admin
function ubahAdmin($data) {
  global $conn;

  $id_admin = $data['id_admin'];
  $nama_admin = htmlspecialchars($data['nama_admin']);
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

  $query = "UPDATE admin SET
            nama_admin = '$nama_admin',
            tempat_lahir = '$tempat_lahir',
            tl = '$tl',
            jk = '$jk',
            tlp = '$tlp',
            email = '$email',
            alamat = '$alamat',
            poto = '$poto'
            WHERE id_admin = '$id_admin'
            ";

  mysqli_query($conn, $query);
  mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

function tambahKategori($data) {
  global $conn;

  $nama_kategori = htmlspecialchars($data['nama_kategori']);

  // cek jika input ada yang kosong
  if($nama_kategori == '') {
    echo "<script>
            alert('data tidak boleh kosong');
          </script>";
    return false;
  }

  // cek nama kategori
  $query = "SELECT * FROM kategori WHERE nama_kategori = '$nama_kategori'";
  $hasil = mysqli_query($conn, $query);
  if(mysqli_num_rows($hasil) > 0) {
    echo "<script>
            alert('kategori sudah ada');
          </script>";
    return false;
  }

  // tambah data
  $query = "INSERT INTO kategori
            VALUES
            ('', '$nama_kategori')
            ";
  mysqli_query($conn, $query);
  mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

function hapusKategori($id){
  global $conn;

  // hapus data
  $query = "DELETE FROM kategori WHERE id_kategori = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

function ubahKategori($data) {
  global $conn;

  $id_kategori = $data['id_kategori'];
  $nama_kategori = htmlspecialchars($data['nama_kategori']);

  // cek jika input ada yang kosong
  if($nama_kategori == '') {
    echo "<script>
            alert('data tidak boleh kosong');
          </script>";
    return false;
  }

  // ubah data
  $query = "UPDATE kategori SET
            nama_kategori = '$nama_kategori'
            WHERE id_kategori = '$id_kategori'
            ";
  mysqli_query($conn, $query);
  mysqli_error($conn);
  return mysqli_affected_rows($conn);
}

// hapus detail
function hapusDetail($id) {
  global $conn;

  // hapus data
  $query = "DELETE FROM detail_pinjam WHERE id_detail = $id";
  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}
?>