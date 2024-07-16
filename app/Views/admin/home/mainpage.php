<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>
<?php $session1 = session('session1'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="448px" height="336px" style="display: block; margin:auto;">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 style="margin-top: 10px; text-align:center; font-family:'Times New Roman', Times, serif; ">Selamat Datang di Sistem Pendukung Keputusan <?= $session1->get('datapengguna1')['namapengguna']; ?></h1>
            <h5 style="text-align: center; font-family:'Segoe UI Light', Tahoma, Geneva, Verdana, sans-serif">Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-3 ml-0 mr-0">
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-3 ml-0 mr-0">

            <div class="row-head">
                <div class="col-lg-12 mb-3 ml-0 mr-0">
                    <div class="wrapper-head">
                        <h4 class="font-weight-bold" style="font-family: 'Times New Roman', Times, serif;">Deskripsi :</h4>
                    </div>
                </div>
            </div>

            <div class="row-content">
                <div class="col-lg-12 mb-3 ml-0 mr-0">
                    <div class="wrapper-content">
                        <p class="text-justify">Sistem pendukung keputusan dibuat untuk mempermudah Dinas Perindustrian dan Perdagangan dalam menentukan penerima bantuan oleh Pemerintah Daerah Kabupaten Pamekasan beserta Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan kepada para pelaku industri kreatif di masa pandemi pada tahun 2020 dan 2021</p>
                    </div>
                </div>
            </div>

            <div class="row-content">
                <div class="col-lg-12 mb-3 ml-0 mr-0">
                    <div class="wrapper-content">
                        <h4 class="text-justify" style="font-family: 'Times New Roman', Times, serif;">Rincian Dashboard</h4>
                    </div>
                </div>
            </div>

            <div class="row-content">
                <div class="col-lg-12 mb-3 ml-0 mr-0">
                    <div class="row wrapper-content">
                        <div class="col-lg-4 mb-3">
                            <div class="card bg-primary text-white">
                                <h5 class="card-header">Jumlah industri</h5>
                                <div class="card-body">
                                    <h1 class="card-content"><?= $industri; ?></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mb-3">
                            <div class="card bg-success text-white">
                                <h5 class="card-header ">Jumlah Pengguna</h5>
                                <div class="card-body">
                                    <h1 class="card-content"><?= $pengguna; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>



</div>
<?= $this->endSection('isikonten'); ?>