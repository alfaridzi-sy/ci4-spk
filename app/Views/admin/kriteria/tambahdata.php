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
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="224px" height="112px" style="display: block; margin:auto;">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h1 class="mb-3 mt-3;" style="text-align : center;font-family:'Times New Roman', Times, serif;">Form Tambah Data Kriteria</h2>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h5 class="text-center" style="font-family:'Times New Roman', Times, serif">Form ini merupakan form yang digunakan untuk menambahkan data kriteria pada sistem pendukung keputusan <br>Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</h5>

                </div>
            </div>
            <div class="row">
                <div class="col">

                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col">
                    <form action="/criteria/simpandata" method="POST">
                        <div class="form-group row">
                            <label for="idKriteria" class="col-sm-3 col-form-label">ID Kriteria</label>
                            <div class="col-sm-9">
                                <input type="text" pattern="[0-9]{1,2}" maxlength="2" class="form-control" id="idKriteria" name="idKriteria" placeholder="Masukkan ID Kriteria" title="Format ID berupa angka maksimal 2 digit" value="<?= $ID; ?>" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Nama" class="col-sm-3 col-form-label">Nama Kriteria</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Nama" name="Nama" placeholder="Masukkan Nama Kriteria" title="Format nama kriteria berupa huruf" required>
                            </div>
                        </div>

                        <?php $no = 0; ?>
                        <div class="form-group row">
                            <label for="attribute" class="col-sm-3 col-form-label">Jenis Attribute Kriteria</label>
                            <div class="col-sm-9">
                                <select id="attribute" class="form-control" name="attribute" title="Silahkan pilih attribute kriteria" required>
                                    <option value="<?php $no; ?> selected disabled hidden">Pilih Attribute Kriteria</option>
                                    <option>Benefit</option>
                                    <option>Cost</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bobot" class="col-sm-3 col-form-label">Bobot</label>
                            <div class="col-sm-9">
                                <input type="text" pattern="[0]+([.][0-9]{1,})" class="form-control" id="bobot" name="bobot" placeholder="Masukkan Jumlah Bobot Kriteria (Satuan Desimal)" title="Jumlah Bobot Dalam Bentuk Desimal" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Jenis Kriteria</label>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenisKriteria" id="numerical" value="1" required>
                                    <label class="form-check-label" for="numerical">Numerical</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenisKriteria" id="alphabetical" value="0" required>
                                    <label class="form-check-label" for="alphabetical">Alphabetical</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button type="submit" id="tombol" class="btn btn-outline-primary btn-default font-weight-bold" style="border-radius:25px;width:max-content; font-family:'HelvLight',sans-serif;">Tambah data</button>
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
        var hapusatribut = document.getElementById('idKriteria');
        tombol.addEventListener('click', function() {
            hapusatribut.removeAttribute('disabled');
        });
        // Alert untuk masing-masing field input
        var IDKriteria = document.querySelector("input[name=idKriteria]");

        IDKriteria.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Format ID berupa angka maksimal 2 digit');
            }
        });

        var NamaKriteria = document.querySelector("input[name=Nama]");

        NamaKriteria.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Masukkan Nama Kriteria! Maks. 20 Karakter');
            }
        });

        var IDAttribute = document.querySelector("select[name=attribute]");

        IDAttribute.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Pilih Attribute Kriteria Anda');
            }
        });

        var IDBobotKriteria = document.querySelector("input[name=bobot]");

        IDBobotKriteria.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Masukkan Bobot Kriteria! Dalam Bentuk Desimal Dengan Maksimal 8 Digit Angka');
            }
        });

        var jenisKriteriaRadios = document.querySelectorAll('input[name="jenisKriteria"]');
        jenisKriteriaRadios.forEach(function(radio) {
            radio.addEventListener('invalid', function() {
                this.setCustomValidity('');
                if (!this.validity.valid) {
                    this.setCustomValidity('Pilih salah satu jenis kriteria!');
                }
            });
        });
    });
</script>

<?= $this->endSection('isikonten'); ?>