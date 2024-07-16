<?= $this->extend('layout/templatekepdis'); ?>
<?= $this->Section('isikonten'); ?>
<?php $nama = session()->get('datapengguna')['namapengguna']; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="448px" height="336px" style="display: block; margin:auto;">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1>Selamat datang <?= $nama; ?>!</h1>
            <h5 id="subjudul">Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan</h5>
            <hr>
            <h5 id="deskripsi">Deskripsi :</h5>
            <p>Sistem pendukung keputusan merupakan sebuah sistem yang digunakan untuk mengetahui alternatif pilihan terbaik berdasarkan hasil kalkulasi menggunakan berbagai jenis kriteria yang dibutuhkan. Pada sistem pendukung keputusan ini memberikan hasil berupa daftar perankingan terkait penerima bantuan pada industri kreatif Kabupaten Pamekasan di masa pandemi.
                Sistem ini dapat menjadi acuan bagi Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan dalam menentukan industri mana yang berhak memperoleh bantuan selama masa pandemi COVID-19.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr>
            <h5>Rincian sistem pendukung keputusan :</h5>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <div class="card card-hover" id="card-industri">
                        <div class="card-body">
                        <span class="fa-solid fa-industry"></span>
                            <h4>Industri Kreatif</h4>
                            <h1><?= $industri; ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card" id="card-pengguna">
                        <div class="card-body">
                        <span class="fa-solid fa-user"></span>
                            <h4>Pengguna</h4>
                            <h1><?= $pengguna; ?></h1>
                        </div>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('isikonten'); ?>