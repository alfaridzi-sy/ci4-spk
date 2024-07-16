<?= $this->extend('layout/templatekepdis'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container mb-4 mt-4">

    <?php if (session()->getFlashdata('pesan')) : ?>
        <div id="alert" class="alert alert-success" role="alert">
            <?php $pesan = session()->getFlashdata('pesan'); ?>
            <?php echo $pesan; ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('pesan1')) : ?>
        <div id="alert1" class="alert alert-danger" role="alert">
            <?php $pesan = session()->getFlashdata('pesan1'); ?>
            <?php echo $pesan; ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col">
            <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="448px" height="336px" style="display: block; margin:auto;">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1>Laman Cek Hasil Perankingan</h1>
            <h5>Deskripsi :</h5>
            <p>Laman ini berisikan data-data terkait hasil perankingan pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</p>
            <hr>
        </div>
    </div>

    <?php if ($dataranking == null || $dataranking == 0) { ?>
        <?php if ($status_request == 'confirm' || $status_request==null) { ?>
            <div class="row">
                <div class="col">
                    <a href="/request-ranking-kepdis"><button class="btn btn-primary"><span class="fa-solid fa-file-import"></span> Request hasil perankingan</button></a>
                </div>
            </div>
        <?php } else { ?>
            <div class="row text-center text-white ">
                <div class="col-lg-3 ml-3 align-items-center" style="border-radius: 23px; background : orange; font-family:'HelvLight', sans-serif;">
                    <b><label for="status_request">Status Request : Pending</label></b>
                </div>
            </div>
        <?php } ?>
    <?php } ?>

    <div class="row mt-3 mb-3">
        <div class="col ">
            <div class="table-responsive d-flex justify-content-center">
                <table class="table table-bordered">
                    <thead class="thead-dark text-white text-nowrap">
                        <tr>
                            <th>No</th>
                            <th>NIB</th>
                            <th>ID Industri</th>
                            <th>Nilai Kelayakan</th>
                            <th>Status Industri</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($dataranking == null || $dataranking == 0) { ?>
                            <?php if ($status_request == 'pending') { ?>
                                <tr class="text-center">
                                    <td colspan="6">Maaf, Status request Anda adalah pending. Mohon tunggu atau hubungi Administrator Anda..</td>
                                </tr>
                            <?php } else { ?>
                                <tr class="text-center">
                                    <td colspan="6">Maaf, data ranking kosong, harap lakukan request untuk memperoleh data.</td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <?php $no = 1; ?>
                            <?php if (is_array($dataranking) && count($dataranking) > 0) : ?>
                                <?php foreach ($dataranking as $value) : ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <?php foreach ($value as $values) : ?>
                                            <td><?= $values; ?></td>
                                        <?php endforeach; ?>
                                        <td><button class="btn btn-sm btn-info rounded-circle"><span class="fa-solid fa-eye"></span></button></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr class="text-center">
                                    <td>Maaf, data ranking kosong, harap lakukan request untuk memperoleh data. <?= $dataranking; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<script>
    window.onload = function() {
        var boxalert = document.getElementById('alert');
        if (boxalert) {
            setTimeout(function() {
                boxalert.classList.add('hide');
            }, 2000)
        }

        var boxalert1 = document.getElementById('alert1');
        if (boxalert1) {
            setTimeout(function() {
                boxalert1.classList.add('hide');
            }, 2000)
        }

    }
</script>
<?= $this->endSection('isikonten'); ?>