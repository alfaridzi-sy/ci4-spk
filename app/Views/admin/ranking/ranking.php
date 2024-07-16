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
            <h1 style="text-align: center;">Tabel Hasil Perankingan</h1>
            <p class="text-center">Tabel Perankingan merupakan tabel yang berisikan data industri kreatif yang dinyatakan layak menerima bantuan dan dinyatakan tidak layak menerima bantuan dari Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</p>
            <hr>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <a href="request-ranking-admin"><button class="btn btn-primary rounded-circle" title="notifikasi"><span class="fa-solid fa-bell
            "></span></button></a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">

                <table class="table table-bordered text-nowrap">
                    <thead class=" thead-dark">
                        <tr>
                            <th>Nomor</th>
                            <th>NIB</th>
                            <th>ID Industri</th>
                            <th>Nilai Hasil Perankingan</th>
                            <th>Status Penerimaan Bantuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($ranking as $key => $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <?php foreach ($value as $nilai) : ?>
                                    <td><?= $nilai; ?></td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <p style="font-style: italic;">*Nilai ambang batas kelayakan perolehan bantuan adalah 0,5.</p>
            <br>
            <p>Sumber : Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan</p>
        </div>
    </div>
</div>

<?= $this->endSection('isikonten'); ?>