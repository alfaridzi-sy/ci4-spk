<!-- Di dalam view -->
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
                    <h1 style="text-align: center;" class="mb-3">Form Tambah Data Subkategori</h1>
                    <h5>Form ini merupakan form yang berguna untuk menambahkan data subkategori pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</h5>
                    <hr>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <form action="/subcategory/simpandata" method="POST">

                        <div class="form-group row">
                            <label for="idKategori" class="col-sm-2 col-form-label">ID Subkategori</label>
                            <div class="col-sm-10">
                                <input type="text" pattern="[0-9]{1,2}" maxlength="2" class="form-control" id="idKategori" name="idKategori" placeholder="Masukkan ID Kategori" title="Format inputan berupa numerik dengan maksimal karakter sebanyak 2" value="<?= $newID ?>" required readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_kriteria" class="col-sm-2 col-form-label">Kriteria</label>
                            <div class="col-sm-10">
                                <select id="id_kriteria" class="form-control" name="id_kriteria" title="Silahkan pilih ID kriteria." required>
                                    <option value="" selected disabled hidden>Pilih Kriteria</option>
                                    <?php foreach ($kriteria_data as $kriteria) : ?>
                                        <option value="<?= $kriteria['id_kriteria']; ?>"><?= $kriteria['nama_kriteria'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_kategori" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select id="id_kategori" class="form-control" name="id_kategori" title="Silahkan pilih kategori berdasarkan kriteria." required disabled>
                                    <option value="" selected disabled hidden>Pilih Kategori</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="namaSubkategori" class="col-sm-2 col-form-label">Nama Subkategori</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namaSubkategori" name="namaSubkategori" placeholder="Masukkan Nama Subkategori" required>
                            </div>
                        </div>

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

<script>
    $(document).ready(function() {
        $('#id_kriteria').on('change', function() {
            var idKriteria = $(this).val();

            // Reset dropdown kategori
            $('#id_kategori').empty().append('<option value="" selected disabled hidden>Pilih Kategori</option>');

            // Jika tidak memilih kriteria, keluar dari fungsi
            if (!idKriteria) {
                $('#id_kategori').prop('disabled', true);
                return;
            }

            // Ajax request untuk mengambil kategori berdasarkan kriteria yang dipilih
            $.ajax({
                url: '/subcategory/getCategories/' + idKriteria,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response && response.length > 0) {
                        $('#id_kategori').prop('disabled', false);
                        $.each(response, function(index, category) {
                            $('#id_kategori').append('<option value="' + category.id_kategori + '">' + category.option_text + '</option>');
                        });
                    } else {
                        $('#id_kategori').prop('disabled', true);
                    }
                },
                error: function() {
                    $('#id_kategori').prop('disabled', true);
                    console.error('Error fetching categories.');
                }
            });
        });
    });
</script>

<?= $this->endSection('isikonten'); ?>