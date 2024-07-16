<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="<?= base_url('/asset/pemkabsipp.png') ?>" width="224px" height="112px" style="display: block; margin:auto;">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h1 style="margin-top: 10px; text-align:center; font-family:'Times New Roman', Times, sans-serif;">Laman Request Industri Kreatif</h1>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
            <h5 class="font-weight-bold" style="font-family: 'Times New Roman', Times, serif;">Deskripsi :</h5>
            <p style="font-family: 'HelvLight',sans-serif;">Laman request merupakan sebuah laman khusus yang berisikan permintaan mengenai penambahan, update dan hapus data industri yang dilakukan oleh pelaku industri kreatif.
                Adapun request yang dilakukan hanya dapat dilakukan oleh admin.
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col">

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

    <div class="row">
        <div class="col-lg-12 mb-3 ml-0 mr-0 d-flex justify-content-center">
            <table class="table table-responsive table-hover text-nowrap">
                <thead class="thead-dark">
                    <tr>
                        <th style="white-space:nowrap;" scope="col">No</th>
                        <th style="white-space:nowrap;" scope="col">ID Request</th>
                        <th style="white-space:nowrap;" scope="col">ID Pengguna</th>
                        <th style="white-space:nowrap;" scope="col">Subject Request</th>
                        <th style="white-space:nowrap;" scope="col">Status Request</th>
                        <th style="white-space:nowrap;" scope="col">Status Baca</th>
                        <th style="white-space:nowrap;" scope="col">Status Pengguna</th>
                        <th style="white-space:nowrap;" scope="col">Dibuat Pada</th>
                        <th style="white-space:nowrap; text-align:center;" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($request as  $value) : ?>
                        <?php if ($value['status_read']=='unread') { ?>
                            <tr style="font-weight: bold;">
                                    <td><?= $no++; ?></td>
                                    <?php foreach ($value as  $nilai) : ?>
                                        <td><?= $nilai; ?></td>
                                    <?php endforeach; ?>
                                    <td>
                                    <a href="/lihat-request-industri-kepdis/<?= $value['idreq']; ?>" class="btn btn-primary fa-solid fa-eye" title="Lihat data"></a>
                                        </td>
                                </tr>
                        <?php } else { ?>
                            <tr style="font-weight: light;">
                                <td><?= $no++; ?></td>
                                <?php foreach ($value as  $nilai) : ?>
                                    <td><?= $nilai; ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <a href="/view-request/<?= $value['idreq']; ?>" class="btn btn-primary fa-solid fa-eye-slash"></a>
                                        </td>
                            </tr>
                        <?php } ?>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<?= $this->endSection('isikonten'); ?>