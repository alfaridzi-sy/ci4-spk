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
                <div class="col text-center">
                    <h1 style="text-align: center;" class="mb-3">Form Tambah Data Kategori</h1>
                    <h5>Form ini merupakan form yang berguna untuk menambahkan data kategori/subkriteria pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</h5>
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <form action="/category/simpandata" method="POST">

                        <div class="form-group row">
                            <label for="idKategori" class="col-sm-2 col-form-label">ID Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" pattern="[0-9]{1,2}" maxlength="2" class="form-control" id="idKategori" name="idKategori" placeholder="Masukkan ID Kategori" title="Format inputan berupa numerik dengan maksimal karakter sebanyak 2" value="<?= $newID ?>" required readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="idkrit" class="col-sm-2 col-form-label">Kriteria</label>
                            <div class="col-sm-10">
                                <select id="idkrit" class="form-control" name="idkrit" title="Silahkan pilih ID kriteria." required>
                                    <option value="<?php $no; ?>" selected disabled hidden>Pilih Kriteria Kategori</option>
                                    <?php foreach ($bobot as $kat7) : ?>
                                        <option value="<?= $kat7['id_kriteria']; ?>" data-is-numerical="<?= $kat7['isNumerical']; ?>"><?php echo $kat7['nama_kriteria']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" id="numericalFields" style="display: none;">
                            <label for="min" class="col-sm-2 col-form-label">Min</label>
                            <div class="col-sm-10">
                                <input type="number" pattern="[0-9.]+" class="form-control" id="min" name="min" placeholder="Masukkan Nilai Min" title="Format inputan berupa angka atau desimal">
                            </div>
                        </div>

                        <div class="form-group row" id="maxFields" style="display: none;">
                            <label for="max" class="col-sm-2 col-form-label">Max</label>
                            <div class="col-sm-10">
                                <input type="number" pattern="[0-9.]+" class="form-control" id="max" name="max" placeholder="Masukkan Nilai Max" title="Format inputan berupa angka atau desimal">
                            </div>
                        </div>

                        <div class="form-group row" id="alphabeticalFields" style="display: none;">
                            <label for="Nama" class="col-sm-2 col-form-label">Nama Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="40" class="form-control" id="Nama" name="Nama" placeholder="Masukkan Nama Kategori" title="Format inputan berupa huruf dengan maksimal karakter sebanyak 40">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bobot" class="col-sm-2 col-form-label">Bobot Kategori</label>
                            <div class="col-sm-10">
                                <input type="text" pattern="[1-5]{1}" maxlength="1" class="form-control" id="bobot" name="bobot" placeholder="Masukkan Bobot Kategori " required title="Format inputan berupa numerik (1-5) dengan maksimal karakter sebanyak 1">
                            </div>
                        </div>
                        <?php $no = 0; ?>

                        <div class="form-group row">
                            <div class="col d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-primary" style="border-radius: 23px;">Tambah Data</button>
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

        // Menampilkan form berdasarkan nilai isNumerical saat memilih kriteria
        $('#idkrit').on('change', function() {
            var isNumerical = $('option:selected', this).data('is-numerical');
            if (isNumerical == 1) {
                $('#numericalFields').show();
                $('#maxFields').show();
                $('#alphabeticalFields').hide();
            } else {
                $('#numericalFields').hide();
                $('#maxFields').hide();
                $('#alphabeticalFields').show();
            }
        });

        // Alert untuk masing-masing field input
        var IDKategori = document.querySelector("input[name=idKategori]");

        IDKategori.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Format ID berupa angka maksimal 2 digit');
            }
        });

        var nama = document.querySelector("input[name=Nama]");

        nama.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Format penulisan berupa huruf dengan maksimal karakter 40.');
            }
        });

        var bobotkategori = document.querySelector("input[name=bobot]");

        bobotkategori.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Format bobot berupa angka maksimal 1 digit (1-5)');
            }
        });

        var IdKriteria = document.querySelector("select[name=idkrit]");

        IdKriteria.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Pilih ID Kriteria Anda');
            }
        });

    });
</script>

<?= $this->endSection('isikonten'); ?>