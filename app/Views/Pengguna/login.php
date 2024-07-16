<?= $this->extend('layout/templatelogin'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container" style="margin-top: 2%; min-height:100%;">

    <div class="row">
        <div class="col">
            <form action="/user/login" method="post">
                <div class="card text-center">
                    <div class="card-body">

                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                                <meta http-equiv="refresh" content="5;url=/login">
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('pesan')) : ?>
                            <div id="alert" class="alert alert-danger" role="alert">
                                <?php $pesan = session()->getFlashdata('pesan'); ?>
                                <?php echo $pesan; ?>
                            </div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col">
                                <img alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="448px" height="336px">
                            </div>
                        </div>
                        <div class=row>
                            <div class="col">

                                <h1 class="card-title" style="font-family:'Times New Roman', Times, serif;">Sistem Pendukung Keputusan</h1>
                                <h4 class="card-title" style="font-family:'Times New Roman', Times, serif;">Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan</h4>
                            </div>
                        </div>
                        <hr>
                        <?php $nilailogin = session()->get('Logout'); ?>
                        <?php if ($nilailogin == true) { ?>
                            <div class="form-group">
                                <p>Username :</p>
                                <input type="text" class="form-control" name="username" id="username" value="" placeholder="Masukkan username anda" required>
                            </div>

                            <div class="form-group">
                                <p>Password :</p>
                                <input type="password" class="form-control" name="password" id="password" value="" placeholder="Masukkan password anda" required>
                            </div>
                        <?php } else { ?>
                            <div class="form-group">
                                <p>Username :</p>
                                <input type="text" class="form-control" name="username" id="username" value="" placeholder="Masukkan username anda" required>
                            </div>

                            <div class="form-group">
                                <p>Password :</p>
                                <input type="password" class="form-control" name="password" id="password" value="" placeholder="Masukkan password anda" required>
                            </div>
                        <?php } ?>
                        <p>Belum memiliki akun ? <a href="register">Klik disini!</a></p>

                        <button class="btn btn-outline-primary" id="tombol">Masuk</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<br>

<script>
    window.onload = function() {
        var boxalert = document.getElementById('alert');
        if (boxalert) {
            setTimeout(function() {
                boxalert.classList.add('hide');
            }, 5000)
        }

    }
</script>
<?= $this->endSection('isikonten'); ?>