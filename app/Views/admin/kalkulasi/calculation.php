<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="224px" height="112px" style="display: block; margin:auto;">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h1 style="margin-top: 10px; text-align:center; font-family:'Times New Roman', Times, serif;">Tabel Matriks Evaluasi</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h5 class="font-weight-bold" style="font-family: 'Times New Roman', Times, serif;">Deskripsi :</h5>
            <p>Matriks evaluasi merupakan matriks hasil konversi nilai data industri menjadi nilai bobot berdasarkan subkriteria/kategori.</p>
            <hr>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <a href="/notifikasi-hitung"><button id="tombol-notifikasi" class="btn btn-primary rounded-circle" title="notifikasi"><span class="fa-solid fa-bell"></span></button></a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo "Data berhasil ditambahkan"; ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan1')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "Data berhasil dihapus"; ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan3')) : ?>
                <div class="alert alert-secondary" role="alert">
                    <?php echo "Data berhasil diedit"; ?>
                </div>
            <?php endif; ?>

            <table class="table table-responsive text-nowrap">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>No</th>
                        <th>NIB</th>
                        <th>ID Industri</th>
                        <?php foreach ($kolom as $colName => $colValue) : ?>
                            <th><?= $colValue; ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($datatabel as $key => $nilai) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <?php foreach ($nilai as $value) : ?>
                                <td><?= $value; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="/calculation/entropy"><button type="button" class="btn btn-outline-dark text-white mb-3 bg-dark" style="margin-left:45%; border-radius:23px">Hitung <i class="fa-solid fa-chevron-right"></i></button></a>
        </div>
    </div>
</div>

<?= $this->endSection('isikonten'); ?>