<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container mt-3 mb-3">
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
                    <h1 style="text-align:center; font-family:'Times New Roman', Times, serif;">Form Edit Data Kriteria</h1>
                    <h5 class="text-center" style="font-family:'Times New Roman', Times, serif;">Form ini merupakan form untuk melakukan update terhadap data kriteria yang ada pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</h5>
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?php foreach ($boy as $b) : ?>
                        <form action="/criteria/updatedata/<?php echo $b['id_kriteria']; ?>" method="POST">

                            <div class="form-group row">
                                <label for="kriteria" class="col-sm-2 col-form-label">ID Kriteria</label>
                                <div class="col-sm-10">
                                    <input type="text" pattern="[0-9]{1,2}" placeholder="Masukkan ID Kriteria" class="form-control" id="kriteria" name="kriteria" value="<?php echo $b['id_kriteria']; ?>" title="Format berupa angka sebanyak 2 digit." disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-2 col-form-label">Nama Kriteria</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $b['nama_kriteria']; ?>" placeholder="Masukkan Nama Kriteria" title="Format berupa huruf sebanyak 40 karakter." required>
                                </div>
                            </div>

                            <?php $no = 0; ?>
                            <div class="form-group row">
                                <label for="attribut" class="col-sm-2 col-form-label">Jenis Attribute Kritera</label>
                                <div class="col-sm-10">
                                    <select id="attribut" class="form-control" name="attribut" aria-valuenow="<?php echo $b['attribute_kriteria']; ?>" title="Silahkan pilih jenis attriibute kriteria." required>
                                        <option value="<?php $no; ?>">Pilih Jenis Attribute Kriteria</option>
                                        <option <?= ($b['attribute_kriteria'] == 'Benefit') ? 'selected' : '' ?>>Benefit</option>
                                        <option <?= ($b['attribute_kriteria'] == 'Cost') ? 'selected' : '' ?>>Cost</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bobot1" class="col-sm-2 col-form-label">Bobot</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="bobot1" name="bobot1" value="<?php echo $b['bobot_kriteria']; ?>" placeholder="Masukkan Bobot Kriteria Dalam Desimal" title="Contoh Format : 0,xxxx" pattern="[0]+[.][0-9]{1,}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jenis Kriteria</label>
                                <div class="col-sm-10">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenisKriteria" id="numerical" value="1" required <?php if ($b['isNumerical'] == 1) echo 'checked';  ?>>
                                        <label class="form-check-label" for="numerical">Numerical</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenisKriteria" id="alphabetical" value="0" required <?php if ($b['isNumerical'] == 0) echo 'checked';  ?>>
                                        <label class="form-check-label" for="alphabetical">Alphabetical</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-outline-primary" id="tombol" name="tombol" style="font-family:'HelvLight', sans-serif; border-radius: 23px;">Edit Data</button>
                                </div>
                            </div>

                        <?php endforeach; ?>
                        </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        // Penghilangan attribute disable
        var tombol = document.getElementById('tombol');
        var hapusatribut = document.getElementById('kriteria');
        tombol.addEventListener('click', function() {
            hapusatribut.removeAttribute('disabled');
        });

        // Alert untuk masing-masing field input
        var IDKriteria = document.querySelector("input[name=kriteria]");

        IDKriteria.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Format ID berupa angka maksimal 2 digit');
            }
        });

        var NamaKriteria = document.querySelector("input[name=nama]");

        NamaKriteria.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Masukkan Nama Kriteria! Maks. 20 Karakter');
            }
        });

        var IDAttribute = document.querySelector("select[name=attribut]");

        IDAttribute.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Pilih Attribute Kriteria Anda');
            }
        });

        var IDBobotKriteria = document.querySelector("input[name=bobot1]");

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