
<!-- home start -->
<section class="home" id="home">
      <div class="content">
        <h3>find your favorite <span class="line-down">books</span></h3>
        <p class="p-home">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim accusamus iure saepe non eos maiores hic illo est sed nesciunt!</p>
        <a href="" class="btn">get started</a>
      </div>

      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
        <?php foreach($buku_terbatu as $b) : ?>
          <div class="swiper-slide">
            <div class="card-home">
              <div class="img">
                <img src="img/dasar.jpg" alt="Buku" />
              </div>
              <div class="content">
                <h3 class="title"><?= $b['judul']; ?></h3>
                <p>pengarang : <?= $b['nama_pengarang']; ?></p>
                <p>penerbit : <?= $b['nama_penerbit']; ?></p>
                <div class="btnContainer">
                  <a class="btn-card" href='?page=home&aksi=detail&id_buku=<?= $b['id_buku']; ?>'><i class="uil uil-message"></i></a>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
    <!-- home end -->

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

    <!-- about start -->
    <section class="about" id="about">
      <div class="heading">
        <span>about</span>
      </div>
      <div class="content-container">
        <div class="img">
          <img src="img/about.png" alt="" />
        </div>
        <div class="content">
          <h3>Why Should You Read <span class="lower-font">a</span> <span class="line-down">Books?</span></h3>
          <p class="p-home">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim accusamus iure saepe non eos maiores hic illo est sed nesciunt!</p>
          <a href="" class="btn">get started</a>
        </div>
      </div>
    </section>
    <!-- about end -->

    <!-- cta start -->
    <section class="cta" id="cta">
      <div class="content">
        <h3><span class="line-down">sign up</span> <span class="lower-font">and</span> get started to reading</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium, enim?</p>
        <a href="" class="btn">registrasi</a>
        <p class="alredy">alredy have an account? <a href="login.html">login</a></p>
      </div>
      <div class="img">
        <img src="img/cta.png" alt="cta" />
      </div>
    </section>
    <!-- cta end -->