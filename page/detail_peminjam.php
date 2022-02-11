
    <!-- detail peminjam start -->
    <section class="detail-peminjam" id="detail-peminjam">
      <?php foreach($detailPeminjam as $dp) : ?>
      <div class="detail-container">
        <div class="detail-wrapper">
          <div class="box">
            <div class="box-img">
              <img src="../img/dasar.jpg" alt="sampul" />
            </div>

            <div class="detail-box">
              <h3><?= $dp['judul'] ?></h3>
              <p>pengarang : <?= $dp['nama_pengarang'] ?></p>
              <p>penerbit : <?= $dp['nama_penerbit'] ?></p>
            </div>

            <div class="setatus-box">
              <div class="tgl-box">
                <div class="pinjam">
                  <p class="ket-tgl">tgl pinjam</p>
                  <p class="tgl"><?= $dp['tgl_pinjam'] ?></p>
                </div>
                <div class="kembali">
                  <p class="ket-tgl">tgl kembali</p>
                  <p class="tgl"><?= $dp['tgl_kembali'] ?></p>
                </div>
              </div>
              <h2><?= $dp['status'] ?></h2>
              <h3 style="text-align: center; margin: -.5rem 0 1rem 0; color: #f33a3a;">
              <?php 
                $denda = 1000;
                $dateline = $dp['tgl_kembali'];
                $tgl_sekarang = date('Y-m-d');
                $lambat = selisih($tgl_sekarang,$dateline);
                if($lambat > 0) {
                  $denda = $lambat * $denda;
                  echo "terlambat $lambat hari denda Rp. $denda";
                }
              
              ?>
              </h3>
              <div class="btn-kembali">
                <button class="btn">kembali</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </section>
    <!-- detail peminjam end -->