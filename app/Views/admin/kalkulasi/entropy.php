<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>

<div class="container mb-4 mt-4">
    <div class="row">
        <div class="col">
            <button id="tombol-kembali" type="button" class="btn btn-outline-light rounded-circle" title="Kembali" onclick="history.go(-1)"><span class="fa-solid fa-chevron-left"></span></button>
        </div>
    </div>
    <div class="card mt-3 mb-3">
        <div class="card-body" id="matriksevaluasi">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align:center">Tabel Evaluasi</h1>
                    <p class="text-center">Tabel evaluasi merupakan tabel hasil konversi nilai attribute dengan bobot pada masing-masing kategori/subkriteria.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px;">
                        <thead class="thead-dark">
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
                            <?php foreach ($datatabel as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <?php foreach ($value as $nilai) : ?>
                                        <td><?= $nilai; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align :center;">Tabel Normalisasi</h1>
                    <p class="text-center">Tabel normalisasi merupakan tabel hasil normalisasi masing-masing nilai data kategori/subkriteria dengan nilai pembagi kategori/subkriteria pada masing-masing kriteria.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px;">
                        <thead class="thead-dark">
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
                            <?php foreach ($tabelnormalisasi as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <?php foreach ($value as $nilai) : ?>
                                        <td><?= $nilai; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                                </tr>

                                <tr style="vertical-align: bottom;">
                                    <td colspan="3" style="text-align: center; font-style:italic; ">Jumlah</td>
                                    <?php foreach ($jumlahnormalisasi as $key => $value) : ?>
                                        <td><?= $value ?></td>
                                    <?php endforeach; ?>
                                </tr>
                        </tbody>
                    </table>
                    <p>Catatan : Nilai pembagi kategori/subkriteria bernilai <b>maksimal</b> pada kriteria yang bersifat <i><b>benefit</b></i>, dan bernilai <b>minimal</b> pada kriteria yang bersifat <i><b>cost</b></i>.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align :center;">Tabel Probabilitas</h1>
                    <p class="text-center">Tabel probabilitas merupakan tabel yang berisikan nilai probabilitas masing-masing nilai kategori/subkriteria pada tiap kriteria.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px;">
                        <thead class="thead-dark">
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
                            <?php foreach ($probabilitas as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <?php foreach ($value as $nilai) : ?>
                                        <td><?= $nilai; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                                </tr>
                        </tbody>
                    </table>
                    <p>Catatan : Nilai probabilitas diperoleh dengan cara membagi tiap nilai kategori/subkriteria dan jumlah nilai kategori/subkriteria pada masing-masing kriteria.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align :center;">Tabel Entropy Tiap Kriteria</h1>
                    <p class="text-center">Tabel entropy tiap kriteria merupakan tabel nilai entropy tiap kategori/subkriteria berdasarkan masing-masing kriteria.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px;">
                        <thead class="thead-dark">
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
                            <?php foreach ($entropykriteria as $key => $value) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <?php foreach ($value as $nilai) : ?>
                                        <td><?= $nilai; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                                </tr>

                                <tr style="vertical-align: bottom;">
                                    <td colspan="3" style="text-align: center; font-style:italic; ">Jumlah</td>
                                    <?php foreach ($jumlahentropykriteria as $key => $value) : ?>
                                        <td><?= $value ?></td>
                                    <?php endforeach; ?>
                                </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align :center;">Tabel Perhitungan Bobot Entropy Tiap Kriteria</h1>
                    <p class="text-center">Tabel perhitungan bobot entropy tiap kriteria merupakan tabel hasil kalkulasi nilai entropy tiap subkriteria menjadi bobot entropy.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <?php foreach ($kolom as $colName => $colValue) : ?>
                                    <th><?= $colValue; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($perhitunganbobotentropy as $key => $value) : ?>
                                    <td><?= $value; ?></td>
                                <?php endforeach; ?>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align :center;">Tabel Nilai Deviasi</h1>
                    <p class=" text-center">Tabel nilai deviasi merupakan tabel hasil kalkulasi pengurangan nilai mutlak 1 dengan nilai bobot entropy tiap kriteria.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <?php foreach ($kolom as $colName => $colValue) : ?>
                                    <th><?= $colValue; ?></th>
                                <?php endforeach; ?>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($deviasi as $key => $value) : ?>
                                    <td><?= $value; ?></td>
                                <?php endforeach; ?>
                                <td><?= $jumlahdeviasi; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align :center;">Tabel Nilai Lamda Entropy</h1>
                    <p class="text-center">Tabel nilai lamda entropy merupakan tabel hasil kalkulasi antara nilai bobot entropy tiap kriteria dengan nilai deviasi tiap kriteria.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <?php foreach ($kolom as $colName => $colValue) : ?>
                                    <th><?= $colValue; ?></th>
                                <?php endforeach; ?>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($lamda as $key => $value) : ?>
                                    <td><?= $value; ?></td>
                                <?php endforeach; ?>
                                <td><?= $jumlahlamda; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align :center;">Tabel Nilai Bobot Awal</h1>
                    <p class="text-center">Tabel nilai bobot awal merupakan tabel yang berisikan nilai awal bobot pada masing-masing kriteria berdasarkan ketentuan yang diberikan oleh Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <?php foreach ($kolom as $colName => $colValue) : ?>
                                    <th><?= $colValue; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($bobotawal as $key => $value) : ?>
                                    <td><?= $value; ?></td>
                                <?php endforeach; ?>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align :center;">Tabel Hasil Kali Bobot Awal</h1>
                    <p class="text-center">Tabel hasil kali bobot awal merupakan tabel yang berisikan hasil kalkulasi perkalian tiap nilai bobot entropy masing-masing kriteria dengan bobot awal tiap kriteria.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <?php foreach ($kolom as $colName => $colValue) : ?>
                                    <th><?= $colValue; ?></th>
                                <?php endforeach; ?>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($hasilkalibobot as $key => $value) : ?>
                                    <td><?= $value; ?></td>
                                <?php endforeach; ?>
                                <td><?= $jumlahhasilkalibobot; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3 mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align :center;">Tabel Nilai Bobot Akhir Entropy</h1>
                    <p class="text-center">Tabel nilai bobot akhir entropy merupakan tabel yang berisikan hasil akhir bobot entropy pada masiing-masing kriteria.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px; width: 100%;">
                        <thead class="thead-dark">
                            <tr>
                                <?php foreach ($kolom as $colName => $colValue) : ?>
                                    <th><?= $colValue; ?></th>
                                <?php endforeach; ?>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($bobotakhirentropy as $key => $value) : ?>
                                    <td><?= $value; ?></td>
                                <?php endforeach; ?>
                                <td><?= $jumlahbobotakhirentropy; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row mb-3">
        <div class="col col-lg-12 d-flex justify-content-center">
            <a href="/calculation/moora"><button type="submit" class="btn btn-outline-primary" name="tombol" id="tombol" style="border-radius: 23px;">Metode Moora <i class="fa-solid fa-chevron-right"></i></button></a>
        </div>
    </div>




</div>

<?= $this->endSection('isikonten'); ?>