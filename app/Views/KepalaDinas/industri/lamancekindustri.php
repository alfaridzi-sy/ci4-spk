<?= $this->extend('layout/templatekepdis'); ?>
<?= $this->Section('isikonten'); ?>

<div class="container">

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
            <h1>Laman Data Industri</h1>
            <h5>Deskripsi :</h5>
            <p>Laman ini berisikan data-data terkait industri yang ada pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</p>
            <hr>
        </div>
    </div>
    <?php if ($dataindustri==0 || $dataindustri==null) { ?>
        <?php if ($status_req=='confirm' || $status_req==null) { ?>
            <div class="row">
                <div class="col">
                    <a href="/request-industri-kepdis"><button class="btn btn-primary"><span class="fa-solid fa-file-import"></span> Request data industri</button></a>
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
            <div class="table-responsive text-nowrap text-center">
                <table class="table">
                    <thead class="bg-dark text-white">
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
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                    <?php if ($dataindustri == 0 || $dataindustri == null) { ?>
                        <?php if ($status_req == 'pending') { ?>
                            <tr>
                                <td colspan="19" class="text-center">Status request Anda pending. Harap tunggu sebentar atau hubungi Administrator Anda.</td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td colspan="19">Data industri belum ada, silahkan lakukan request terlebih dahulu</td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <?php foreach ($dataindustri as $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <?php foreach ($value as $nilai) : ?>
                                    <td><?= $nilai; ?></td>
                                <?php endforeach; ?>
                                
                            </tr>
                        <?php endforeach; ?>
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