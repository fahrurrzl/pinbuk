
<!-- home start -->
<section class="home" id="home">
      <div class="content">
        <h3>find your favorite <span class="line-down">books</span></h3>
        <p class="p-home">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim accusamus iure saepe non eos maiores hic illo est sed nesciunt!</p>
        <p style="margin-bottom: 1rem;"><a href="?page=home&aksi=content">selengkapnya</a></p>
        <a href="?page=home#books" class="btn">get started</a>
      </div>

      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
        <?php 
        if(empty($buku_terbaru)) {
          echo "<div class='swiper-slide'>
          <div class='slide-box'>
            <div class='slide-img'>
              <img src='../img/dasar.jpg' alt='sampul' />
            </div>
            <div class='slide-detail'>
              <h3>No books</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quis.</p>
            </div>
          </div>
          </div>";
        } else { foreach($buku_terbaru as $b) : ?>
          <div class="swiper-slide">
            <div class="card-home">
              <h3 class="new">baru</h3>
              <div class="img">
                <img src="admin/img/<?= $b['sampul'] ?>" alt="Sampul" />
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
          <?php endforeach; } ?>
        </div>
      </div>
      <!-- mouse scroll animasi start -->
    <div class="mouse-animation">
      <div class="mouse-wrapper">
      <i class="uil uil-angle-down"></i>
      </div>
    </div>
    <!-- mouse scroll animasi end -->
    </section>
    <!-- home end -->

    <!-- books start -->
    <section class="books" id="books">
      <div class="heading">
        <span>Books</span>
      </div>
      <!-- slider -->
      <div class="slider">
        <?php 
        if(empty($buku)) {
          echo "<div class='slider-kosong'>
          <h2>Buku kosong</h2>
          </div>";
        } else { foreach($buku as $sb) : ?>
        <div>
          <!-- box slider -->
          <div class="box">
            <div class="slide-img">
              <img src="admin/img/<?= $sb['sampul']; ?>" alt="Sampul" />
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
        <?php endforeach; } ?>
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
          <h3>Why Should You Read a <span class="line-down">Books?</span></h3>
          <p class="p-home">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Enim accusamus iure saepe non eos maiores hic illo est sed nesciunt!</p>
          <p style="margin-bottom: 1rem;"><a href="?page=home&aksi=content">selengkapnya</a></p>
          <a href="" class="btn">get started</a>
        </div>
      </div>
    </section>
    <!-- about end -->

    <!-- cta start -->
    <?php if(!isset($_SESSION['login'])) : ?>
    <section class="cta" id="cta">
      <div class="content">
        <h3><span class="line-down">sign up</span> <span class="lower-font">and</span> get started to reading</h3>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab obcaecati rerum nostrum exercitationem, nisi excepturi debitis cupiditate provident voluptate temporibus ratione sunt quidem eos minima quia. Nihil voluptatibus doloribus dolores!</p>
        <p style="margin-bottom: 1rem;"><a href="?page=home&aksi=content">selengkapnya</a></p>
        <a href="login.php" class="btn">get started</a>
        
      </div>
      <div class="img">
        <img src="img/cta.png" alt="cta" />
      </div>
    </section>
    <!-- cta end -->
    <?php endif; ?>