<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>

<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col">
            <button id="tombol-kembali" type="button" class="btn btn-outline-light rounded-circle" title="Kembali" onclick="history.go(-1)"><span class="fa-solid fa-chevron-left"></span></button>
        </div>
    </div>
    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align:center">Tabel Evaluasi</h1>
                    <p class="text-center">Tabel evaluasi merupakan tabel yang bersikan data hasil konversi data kaktegori/subkriteria dengan bobot yang telah ditetapkan oleh Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table table-responsive table-bordered">
                        <table class=" text-nowrap" style="max-height: 400px;">
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
    </div>

    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align:center">Tabel Kuadrat Pembagi Alternatif</h1>
                    <p class="text-center">Tabel kuadtat pembagi alternatif merupakan tabel yang berisikan hasil jumlah nilai kuadrat masing-masing data kategori/subkriteria pada tiap kriteria.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table class="table table-responsive table-bordered text-nowrap" style="max-height: 400px;">
                        <thead class="thead-dark">
                            <tr>

                                <?php foreach ($kolom as $colName => $colValue) : ?>
                                    <th><?= $colValue; ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php foreach ($pembagi as $key => $value) : ?>
                                    <td><?= $value; ?></td>
                                <?php endforeach; ?>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align:center">Tabel Normalisasi</h1>
                    <p class="text-center">Tabel normalisasi merupakan tabel yang berisikan data kategori/subkriteria yang telah dinormalisasikan dengan nilai kuadrrat pada masing-masing kriteria.</p>
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align:center">Tabel Nilai Y Maksimum</h1>
                    <p class="text-center">Tabel nilai Y maksimum merupakan tabel yang berisikan hasil kalkulasi perkalian bobot entropy dengan bobot awal pada kriteria yang bersifat <i><b>benefit</b></i><b>/keuntungan</b>. </p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">

                        <table class="table table-bordered text-nowrap" style="max-height: 400px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIB</th>
                                    <th>Nilai Ymaks</th>
    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($ymaks as $key => $value) : ?>
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
    </div>
    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align:center">Tabel Nilai Y Minimum</h1>
                    <p class="text-center">Tabel Y nilai minimum merupakan sebuah tabel yang berisikan hasil penjumlahan nilai kategori/sbkriteria dengan masin-masing bobot yang bersifat <i><b>cost</b></i><b>/kerugian</b>. </p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">

                        <table class="table table-bordered text-nowrap" style="max-height: 400px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIB</th>
                                    <th>Nilai Ymin</th>
    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($ymin as $key => $value) : ?>
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
    </div>
    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align:center">Tabel Nilai Optimasi</h1>
                    <p class="text-center">Tabel nilai optimasi merupakan tabel yang berisikan hasil penggabungan antara tabel dengan nilai y maksimum dan tabel nilai y minimum.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" style="max-height: 400px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIB</th>
                                    <th>Nilai Ygab</th>
    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($ygab as $key => $value) : ?>
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
    </div>

    <div class="card mb-4 mt-4">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                    <h1 style="margin-top: 10px; text-align:center">Tabel Perankingan</h1>
                    <p class="text-center">Tabel Perankingan merupakan tabel yang berisikan hasil akhir perhitungan metode entropy dan MOORA. Tabel ini memberikan penjelasan mengenai kelayakan industri berhak menerima bantuan atau tidak.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap" style="max-height: 400px;">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>NIB</th>
                                    <th>ID Industri</th>
                                    <th>Nilai Akhir</th>
                                    <th>Status</th>
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
                                    <?php endforeach; ?>
                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection('isikonten'); ?>