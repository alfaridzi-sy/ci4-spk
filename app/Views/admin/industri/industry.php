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
            <h1 style="margin-top: 10px; text-align:center; font-family:'Times New Roman', Times, serif;">Daftar Industri Kreatif</h1>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
            <h5 class="font-weight-bold" style="font-family: 'Times New Roman', Times, serif;">Deskripsi :</h5>
            <p>Industri kreatif merupakan industri yang bergerak di bidang perekonomian kreatif.
                Berikut merupakan daftar terkait Industri kreatif yang ada pada Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan :</p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <a href="/industry/tambahdata" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="col-lg-6 d-flex  justify-content-end">
            <a href="/industry/notifikasi" class="btn btn-primary mb-3" title="Notifikasi"><i class="fa-solid fa-bell"></i></a>
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
            <?php if (session()->getFlashdata('pesan4')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "Data Industri Kosong"; ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('pesan3')) : ?>
                <div class="alert alert-secondary" role="alert">
                    <?php echo "Data berhasil diedit"; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <div class="row text-center">
        <div class="col-lg-12 mb-3 ml-0 mr-0">
            <table class="table table-responsive text-nowrap">
                <thead class="thead-dark">
                    <tr>
                        <th style="white-space:nowrap;" scope="col">No</th>

                        <th style="white-space:nowrap;" scope="col">ID Industri</th>
                        <th style="white-space:nowrap;" scope="col">Nama Industri</th>
                        <th style="white-space:nowrap;" scope="col">Nama Pengguna</th>
                        <th style="white-space:nowrap;" scope="col">NIB</th>
                        <th style="white-space:nowrap;" scope="col">Sektor Usaha</th>
                        <th style="white-space:nowrap;" scope="col">Investasi</th>
                        <th style="white-space:nowrap;" scope="col">Jumlah Modal Usaha</th>
                        <th style="white-space:nowrap;" scope="col">KBLI</th>
                        <th style="white-space:nowrap;" scope="col">Nama Kegiatan</th>
                        <th style="white-space:nowrap;" scope="col">Skala Industri</th>
                        <th style="white-space:nowrap;" scope="col">Klasifikasi Usaha</th>
                        <th style="white-space:nowrap;" scope="col">Resiko Usaha</th>
                        <th style="white-space:nowrap;" scope="col">Alamat Usaha</th>
                        <th style="white-space:nowrap;" scope="col">Wilayah Usaha</th>
                        <th style="white-space:nowrap;" scope="col">Kecamatan</th>
                        <th style="white-space:nowrap;" scope="col">Jumlah Tenaga Kerja</th>
                        <th style="white-space:nowrap;" scope="col">Tenaga Kerja</th>
                        <th style="white-space:nowrap;" scope="col">Tahun Pendaftaran</th>
                        <th style="white-space:nowrap; text-align:center;" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php if ($industri == 0 || $industri == null) { ?>
                        <tr>
                            <td>Data industri belum ada</td>
                        </tr>
                    <?php } else { ?>
                        <?php foreach ($industri as $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <?php foreach ($value as $nilai) : ?>
                                    <td><?= $nilai; ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <a href="/industry/edit/<?= $value['ID_Industri']; ?>" class="btn btn-primary fa-solid fa-rotate" title="Update data"></a>
                                    <form action="/industry/delete/<?= $value['ID_Industri']; ?>" method="POST" class="d-inline">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger fa-solid fa-trash-can" title="Hapus data" onclick="return confirm('Apakah Anda yakin ingin menghapus data?')"></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php } ?>

                </tbody>
            </table>

        </div>
    </div>

</div>

<?= $this->endSection('isikonten'); ?>