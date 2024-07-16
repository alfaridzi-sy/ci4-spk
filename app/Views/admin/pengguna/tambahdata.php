<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container" style="margin-top: 2%; min-height:100%; max-height:100%;position:relative;">
    <div class="row">
        <div class="col col-lg-12 col-md-6 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col d-flex justify-content-start">
                            <div class="col-lg-12 pl-0 pr-0 mb-3">
                                <button class="btn btn-outline-light no-outline rounded-circle fa-solid fa-chevron-left" style="width:max-content; height:max-content; color: grey;" onClick="history.go(-1)"></button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="224px" height="112px" style="display: block; margin:auto;">
                        </div>
                    </div>

                    <form action="/pengguna/tambah" method="post">
                        <h1 class="card-title text-center" style="font-family:'Times New Roman', Times, serif;">Form Tambah Akun Pengguna</h1>
                        <p style="font-family: 'HelvLight',sans-serif; padding-right:5%; padding-left:5%;" class="text-center">Form ini merupakan form untuk menambahkan akun pengguna sistem pendukung keputusan <br> Dinas Perindustrian dan Perdagangan Pamekasan.</p>
                        <hr style="width:85%;">
                        <div class="form-group">
                            <p hidden>iduser :</p>
                            <input type="text" class="form-control" name="iduser" id="iduser" value="<?= $iduser; ?>" hidden>
                        </div>
                        <div class="form-group">
                            <p>Nama Lengkap :</p>
                            <input type="text" class="form-control" name="namapengguna" id="namapengguna" required>
                        </div>
                        <div class="form-group">
                            <p>Username :</p>
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="form-group">
                            <p>Password :</p>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group">
                            <p>NIB (Nomor izin berusaha) :</p>
                            <input type="NIB" class="form-control" name="NIB" id="NIB" value="<?= $NIB; ?>">
                        </div>
                        <div class="form-group">
                            <p hidden>Status :</p>
                            <input type="status" class="form-control" name="status" id="status" value="user" hidden>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-outline-primary" style="border-radius: 23px;">Tambah Data Pengguna</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
<br>
<?= $this->endSection('isikonten'); ?>