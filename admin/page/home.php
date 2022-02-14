<?php 
require '../functions/functions.php';

// jumlah buku
$jumlah_buku = query("SELECT * FROM buku");
$jumlah_buku = count($jumlah_buku);

// jumlah pengarang
$jumlah_pengarang = query("SELECT * FROM pengarang");
$jumlah_pengarang = count($jumlah_pengarang);

// jumlah penerbit
$jumlah_penerbit = query("SELECT * FROM penerbit");
$jumlah_penerbit = count($jumlah_penerbit);

// jumlah peminjam
$jumlah_peminjam = query("SELECT * FROM peminjam");
$jumlah_peminjam = count($jumlah_peminjam);

// jumlah buku yang dipinjam
$jumlah_dipinjam = query("SELECT * FROM detail_peminjam");
$jumlah_dipinjam = count($jumlah_dipinjam);


?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">buku</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_buku; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">data pengarang</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_pengarang; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-pen fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">data penerbit</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlah_penerbit; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-paper-plane fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">data peminjam</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_peminjam; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Buku ynag dipinjam</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $jumlah_dipinjam; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Content Row -->
              
          <!-- Approach -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
            </div>
            <div class="card-body">
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corporis recusandae fugit hic atque, mollitia tempora unde quo rerum nulla libero quisquam eos autem quibusdam! Aut et ipsum a alias est.</p>
            </div>
          </div>