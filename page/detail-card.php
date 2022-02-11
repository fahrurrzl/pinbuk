<?php 
$id_buku = $_GET['id_buku'];
$detailBuku = query("SELECT * FROM buku
INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang
INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit
WHERE id_buku = $id_buku")[0];

// menampilkan semua buku
$buku = query("SELECT * FROM buku
INNER JOIN pengarang ON buku.id_pengarang = pengarang.id_pengarang
INNER JOIN penerbit ON buku.id_penerbit = penerbit.id_penerbit");


?>
    <!-- detail start -->
    <section class="detailBuku" id="detailBuku">
      <div class="detail-container">
        <div class="detail-wrapper">
          <div class="detail-img">
            <img src="img/sikolog.jpg" alt="sampul" />
          </div>
          <div class="detail-info">
            <h1><?= $detailBuku['judul']; ?></h1>
            <p>pengarang : <?= $detailBuku['nama_pengarang']; ?></p>
            <p>penerbit : <?= $detailBuku['nama_penerbit']; ?></p>
            <p>tahun terbit : <?= $detailBuku['tahun_terbit']; ?></p>
            <p>ISBN : <?= $detailBuku['isbn']; ?></p>
            <p>sinopsis : <br>
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Vitae, aperiam at nisi enim et nemo asperiores beatae, ipsa id nam mollitia, eos officiis error consequatur. Esse quisquam placeat rerum ea!
              Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eum, molestias vero, quod ab magnam repellendus accusamus tenetur architecto, iste ut temporibus accusantium adipisci sunt provident distinctio non pariatur quibusdam itaque?
            </p>
          </div>
          <div class="detail-pinjam">
            <div class="tgl">
              <div class="tgl-pinjam">
                <p>tanggal pinjam</p>
                <p><span>5-7-2020</span></p>
              </div>
              <div class="tgl-kembali">
                <p>tanggal kembali</p>
                <p><span>12-7-2020</span></p>
              </div>
            </div>
            <button class="btn">pinjam</button>
          </div>
        </div>
      </div>
    </section>
    <!-- detail end -->

    <!-- books start -->
    <section class="books" id="books">
      <div class="heading">
        <span>Books</span>
      </div>
      <!-- slider -->
      <div class="slider">
        <?php foreach($buku as $sb) : ?>
        <div>
          <!-- box slider -->
          <div class="box">
            <div class="slide-img">
              <img src="img/dasar.jpg" alt="Books" />
            </div>
            <!-- detail box -->
            <div class="detail-box">
              <!-- type -->
              <div class="type">
                <h3><?= $sb['judul']; ?></h3>
                <p>pengarang : <?= $sb['nama_pengarang']; ?></p>
                <p>pengarang : <?= $sb['nama_penerbit']; ?></p>
              </div>
              <!-- pinjam -->
              <div class="btnCard">
              <a class="btn-card" href='?page=home&aksi=detail&id_buku=<?= $sb['id_buku']; ?>'><i class="uil uil-message"></i></a>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </section>
    <!-- books end -->