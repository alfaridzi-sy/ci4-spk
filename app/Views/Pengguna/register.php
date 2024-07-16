<?= $this->extend('layout/templatelogin'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container" style="margin-top: 2%; min-height:100%; position:relative;">
    <div class="row">
        <div class="col">
            <form action="/user/register" method="post">
                <div class="card text-center">
                    <div class="card-body">

                        <div class="row">
                            <div class="col">
                                <img alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="448px" height="336px">
                            </div>
                        </div>

                        <h1 class="card-title" style="font-family:'Times New Roman', Times, serif;">Buat Akun Anda</h1>
                        <h5 style="font-family: 'Times New Roman', Times, serif;">Akun anda diperlukan jika ingin mengakses seluruh layanan kami.</h5>
                        <hr>
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
                            <p>NIB (Nomor izin berusaha):</p>
                            <input type="NIB" class="form-control" name="NIB" id="NIB" value="<?= $NIB; ?>">
                        </div>
                        <div class="form-group">
                            <p hidden>Status :</p>
                            <input type="status" class="form-control" name="status" id="status" value="user" hidden>
                        </div>
                        <p>Sudah memiliki akun ? <a href="/login">Klik disini!</a></p>

                        <button class="btn btn-outline-primary" id="tombol">Daftar akun</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<br>
<?= $this->endSection('isikonten'); ?>