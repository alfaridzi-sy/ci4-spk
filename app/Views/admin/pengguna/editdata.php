<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container mt-4 mb-4">
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col">
                    <div class="col-lg-12 pl-0 pr-0 mb-3">
                        <button class="btn btn-outline-light no-outline rounded-circle fa-solid fa-chevron-left" style="width:max-content; height:max-content; color: grey;" onClick="history.go(-1)"></button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="<?= base_url('/asset/pemkabsipp.png') ?>" width="224px" height="112px" style="display: block; margin:auto;">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1 class="text-center" style="font-family: 'Times New Roman', Times, serif;">Form Edit Data Pengguna</h1>
                    <p class="text-center">Form edit pengguna merupakan form yang digunakan untuk melakukan update terkait data akun pengguna</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <form action="/pengguna/updatedata/<?php echo $pengguna['iduser']; ?>" method="POST">

                        <div class="form-group row">
                            <label for="iduser" class="col-sm-2 col-form-label">ID Pengguna</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="iduser" name="iduser" value="<?php echo $pengguna['iduser']; ?>" placeholder="ID Pengguna berupa angka" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Pengguna</label>
                            <div class="col-sm-10">
                                <input type="text" pattern="[A-Za-z,'. ]+" class="form-control" id="nama" name="nama" value="<?php echo $pengguna['namauser']; ?>" placeholder="Masukkan nama anda!" title="Format penulisan nama berupa huruf dan hanya simbol . , dan ' yang diperbolehkan.">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" pattern=".+" placeholder="Masukkan data username anda!" class="form-control" title="Masukkan username anda" id="username" name="username" value="<?php echo $pengguna['username']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="text" pattern=".+" placeholder="Masukkan password anda!" class="form-control" title="Masukkan password anda" id="password" name="password" value="<?php echo $pengguna['password']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nib" class="col-sm-2 col-form-label">NIB</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Masukkan data nib anda! (1-5)" class="form-control" title="Masukkan data dalam format numerik (1-5)" id="nib" name="nib" value="<?php echo $pengguna['NIB']; ?>" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status Akun</label>
                            <div class="col-sm-10">

                                <select class="form-control" placeholder="Silahkan pilih status akun" id="status" name="status">
                                    <?php foreach ($status  as $key => $value) : ?>
                                        <?php $selected = ($value == $pengguna['status']) ? 'selected' : '' ?>
                                        <option value=<?php echo $pengguna['status']; ?><?= $selected; ?>><?php echo $pengguna['status']; ?></option>
                                    <?php endforeach; ?>
                                    <option value="admin">Admin</option>
                                    <option value="kepdis">Kepala Dinas</option>
                                    <option value="user">Pengguna</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col d-flex justify-content-end">
                                <button type="submit" id="tombol" name="tombol" class="btn btn-sm btn-outline-primary" style="border-radius: 23px;">Edit Data</button>
                            </div>
                        </div>

                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var tombol = document.getElementById('tombol');
        var hapusatribut = document.getElementById('iduser');
        var hapusatribut1 = document.getElementById('nib');
        tombol.addEventListener('click', function() {
            hapusatribut.removeAttribute('disabled');
            hapusatribut1.removeAttribute('disabled');
        });

        var nama = document.querySelector("input[name=nama]");

        nama.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan masukkan nama Anda');
            }
        });


    });
</script>
<?= $this->endSection('isikonten'); ?>