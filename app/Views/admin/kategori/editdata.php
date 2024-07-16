<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>

<div class="container mt-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <button class="btn btn-outline-light no-outline rounded-circle fa-solid fa-chevron-left" style="width:max-content; height:max-content; color: grey;" onClick="history.go(-1)"></button>
                </div>
            </div>
            <div class="row ">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="<?= base_url('/asset/pemkabsipp.png') ?>" width="224px" height="112px" style="display: block; margin:auto;">
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <h1>Form Edit Data Kategori</h1>
                    <h5>Form ini merupakan form yang berguna untuk melakukan update data terkait data kategori/subkriteria pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</h5>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <?php foreach ($boy as $b) : ?>
                        <form action="/category/updatedata/<?php echo $b['id_kategori']; ?>" method="POST">

                            <div class="form-group row">
                                <label for="kategori" class="col-sm-2 col-form-label">ID Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $b['id_kategori']; ?>" placeholder="ID Kategori berupa angka" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="idkrit" class="col-sm-2 col-form-label">Kriteria</label>
                                <div class="col-sm-10">
                                    <select id="idkrit" class="form-control" name="idkrit" title="Silahkan pilih ID kriteria." required>
                                        <?php foreach ($kriteria as $kat7) : ?>
                                            <option value="<?= $kat7['id_kriteria']; ?>" data-is-numerical="<?= $kat7['isNumerical']; ?>" <?= ($kat7['id_kriteria'] == $b['id_kriteria'])  ? 'selected' : ''  ?>><?php echo $kat7['nama_kriteria']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" id="numericalFields" style="display: none;">
                                <label for="min" class="col-sm-2 col-form-label">Min</label>
                                <div class="col-sm-10">
                                    <input type="number" pattern="[0-9.]+" class="form-control" id="min" name="min" value="<?= isset($b['min']) ? $b['min'] : '' ?>" placeholder="Masukkan Nilai Min" title="Format inputan berupa angka atau desimal">
                                </div>
                            </div>

                            <div class="form-group row" id="maxFields" style="display: none;">
                                <label for="max" class="col-sm-2 col-form-label">Max</label>
                                <div class="col-sm-10">
                                    <input type="number" pattern="[0-9.]+" class="form-control" id="max" name="max" value="<?= isset($b['max']) ? $b['max'] : '' ?>" placeholder="Masukkan Nilai Max" title="Format inputan berupa angka atau desimal">
                                </div>
                            </div>

                            <div class="form-group row" id="alphabeticalFields" style="display: none;">
                                <label for="Nama" class="col-sm-2 col-form-label">Nama Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" maxlength="40" class="form-control" id="Nama" name="Nama" value="<?= isset($b['nama_kategori']) ? $b['nama_kategori'] : '' ?>" placeholder="Masukkan Nama Kategori" title="Format inputan berupa huruf dengan maksimal karakter sebanyak 40">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="bobot" class="col-sm-2 col-form-label">Bobot Kategori</label>
                                <div class="col-sm-10">
                                    <input type="text" pattern="[1-5]{1}" placeholder="Masukkan data bobot anda! (1-5)" class="form-control" title="Masukkan data dalam format numerik (1-5)" id="bobot" name="bobot" value="<?php echo $b['bobot_kategori']; ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col d-flex justify-content-end">
                                    <button type="submit" id="tombol" name="tombol" class="btn btn-outline-primary" style="border-radius: 23px;">Edit Data</button>
                                </div>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        // Function to toggle fields based on selected option
        function toggleFields() {
            var isNumerical = $('#idkrit option:selected').data('is-numerical');
            if (isNumerical == 1) {
                $('#numericalFields').show();
                $('#maxFields').show();
                $('#alphabeticalFields').hide();
            } else {
                $('#numericalFields').hide();
                $('#maxFields').hide();
                $('#alphabeticalFields').show();
            }
        }

        // Call toggleFields initially when the page loads
        toggleFields();

        // Attach onchange event listener to select element
        $('#idkrit').on('change', function() {
            toggleFields();
        });

        // Remove disabled attribute on button click
        $('#tombol').on('click', function() {
            $('#kategori').removeAttr('disabled');
        });

        // Validation for Nama field
        var namaField = document.getElementById('Nama');
        namaField.addEventListener('invalid', function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan masukkan nama kategori Anda');
            }
        });
    });
</script>

<?= $this->endSection('isikonten'); ?>