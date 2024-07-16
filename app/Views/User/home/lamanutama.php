<?= $this->extend('layout/templatepengguna'); ?>
<?= $this->Section('isikonten'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1><?php $idpengguna = session()->get('datapengguna2')['namapengguna']; ?>
        
        </h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="448px" height="336px" style="display: block; margin:auto;">
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <h1>Selamat Datang <?= $idpengguna; ?>!</h1>
            <h5>Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</h5>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5 id="deskripsi">Deskripsi :</h5>
            <p>Laman ini merupakan laman utama Anda pada Sistem Pendukung Keputusan. Laman ini berisikan informasi terkait jumlah industri kreatif yang anda miliki.</p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card jumlah-industri">
                <div class="card-body">
                    <div class="card-title">
                        <h1>Jumlah Industri Anda :</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('isikonten'); ?>