<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container mb-4 mt-4">
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
                <div class="col text-center">
                    <h1 class="mb-3 text-center mt-3">Form Tambah Data Industri Kreatif</h1>
                    <h5>Form ini merupakan form yang berguna untuk menambahkan data industri kreatif pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</h5>
                    <hr>
                </div>
            </div>
            <div class="row">

                <div class="col">
                    <form action="/industry/simpandata" method="POST">

                        <div class="form-group row">
                            <label for="idIndustri" class="col-sm-2 col-form-label">ID Industri</label>
                            <div class="col-sm-10">
                                <input pattern="[0-9]{1,13}" maxlength="13" type="text" class="form-control" id="idIndustri" name="idIndustri" placeholder="Masukkan ID Industri" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Nama" class="col-sm-2 col-form-label">Nama Industri</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Nama" name="Nama" required placeholder="Masukkan Nama Industri Anda" maxlength="100">
                            </div>
                        </div>
                        <?php $no = 0; ?>
                        <div class="form-group row">
                            <label for="pengguna" class="col-sm-2 col-form-label">ID Pengguna</label>
                            <div class="col-sm-10">
                                <select name="idpengguna" id="idpengguna" class="form-control" placeholder="Silahkan ketik nomor ID/Nama pengguna" style="width:100%;" required>
                                    <option value="<?php $no; ?>"></option>
                                    <?php foreach ($user as $idp) : ?>
                                        <option value=<?= $idp['iduser']; ?> data-value=<?= $idp['iduser']; ?>><?php echo $idp['iduser'] . " - " . $idp['namauser']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <?php $no = 0; ?>
                        <div class="form-group row">
                            <label for="pengguna" class="col-sm-2 col-form-label">NIB</label>
                            <div class="col-sm-10">
                                <select name="nib" id="nib" class="form-control" placeholder="Silahkan ketik nomor ID/Nama pengguna" style="width:100%;" required>
                                    <option value="<?php $no; ?>"></option>
                                    <!-- <?php foreach ($user as $idp) : ?>
                                    <option value=<?= $idp['NIB']; ?>><?php echo $idp['NIB']; ?></option>
                                <?php endforeach; ?> -->
                                </select>
                            </div>
                        </div>

                        <?php $no = 0; ?>
                        <div class="form-group row">
                            <label for="sektor" class="col-sm-2 col-form-label">Sektor Usaha</label>
                            <div class="col-sm-10">
                                <select id="sektor" class="form-control" name="sektor" style="width:100%;" required>
                                    <option value="<?php $no; ?>"></option>
                                    <?php foreach ($kategori as $kat) : ?>
                                        <option value=<?= $kat['id_kategori']; ?> data-value=<?= $kat['id_kategori']; ?>><?php echo $kat['nama_kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="Modal" class="col-sm-2 col-form-label">Modal Industri</label>
                            <div class="col-sm-10">
                                <input pattern="[0-9]{1,20}" maxlength="20" type="text" class="form-control" id="Modal" name="Modal" required placeholder="Masukkan Jumlah Modal Anda">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat Industri</label>
                            <div class="col-sm-10">
                                <input pattern="{1,100}" type="text" class="form-control" id="alamat" name="alamat" required placeholder="Masukkan Alamat Lengkap Anda">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kbli" class="col-sm-2 col-form-label">KBLI</label>
                            <div class="col-sm-10">
                                <select id="kbli" class="form-control" name="kbli" style="width:100%;" required>
                                    <option value="">Pilih KBLI</option>
                                    <!-- <?php foreach ($kbli as $idkbli) : ?>
                                        <option value=<?= $idkbli['idkbli']; ?>><?= $idkbli['idkbli'] . "-" . $idkbli['namakegiatan']; ?></option>
                                    <?php endforeach; ?> -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="wilayah" class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-10">
                                <select id="wilayah" class="form-control" name="wilayah" style="width:100%;" required>
                                    <option value="">Pilih Kecamatan</option>
                                    <?php foreach ($kecamatan as $idkecamatan) : ?>
                                        <option value="<?= $idkecamatan['idkecamatan']; ?>"><?= $idkecamatan['namakecamatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tenagakerja" class="col-sm-2 col-form-label" id="aa">Jumlah Tenaga Kerja</label>
                            <div class="col-sm-10">
                                <input pattern="[0-9]{1,5}" maxlength="5" type="text" class="form-control" id="tenagakerja" name="tenagakerja" required placeholder="Masukkan Jumlah Tenaga Kerja Anda">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                            <div class="col-sm-10">
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value="1">Pilih tahun industri anda</option>
                                    <option value="2">2020</option>
                                    <option value="3">2021</option>
                                </select>
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


<!-- <script type="text/javascript">
$(document).ready(function() {
    $('#sektor').change(function() {
    var sektor = $("#sektor option:selected").data('value');
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
    $.ajax({
        type : 'POST',
        url  : "<?= base_url('industry/kbli'); ?>",
        data : {'sektor':sektor},

        success: function(response) {
            $("#kbli").html(response);
        }

    })
    
    // var sektor = $('#sektor option:selected').data('value');
    
    $('[name=tenagakerja]').val(sektor);

    
    
});
    
    
});

</script> -->

<script type="text/javascript">
    $(document).ready(function() {

        // Dynamic dropdown KBLI

        $('#sektor').change(function(event) {
            event.preventDefault();
            var id_sektor = $("#sektor option:selected").data('value');
            var action = 'kirim';

            if (id_sektor != null && id_sektor != 0 || id_sektor != '0') {

                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('/Dynamic/Action'); ?>",
                    data: {
                        id_sektor: id_sektor,
                        action: action
                    },
                    dataType: "JSON",
                    success: function(data) {

                        var html = '<option value="">Pilih KBLI</option>';
                        for (var index = 0; index < data.length; index++) {
                            html += '<option value=' + data[index].idkbli + '>' + data[index].idkbli + '-' + data[index].namakegiatan + '</option>';
                        }
                        $("#kbli").html(html);
                    }

                });

            } else {
                var html = '<option value="0">Pilih KBLI</option>';
                $("kbli").html(html);
            }


        });

        // Dynamic dropdown NIB

        $('#idpengguna').change(function(event) {
            event.preventDefault();
            var nib = $("#idpengguna option:selected").data('value');
            var action1 = 'kirim';

            if (nib != null && nib != 0 || nib != '0') {

                $.ajax({
                    type: 'POST',
                    url: "<?php echo base_url('/Dynamic/Action1'); ?>",
                    data: {
                        nib: nib,
                        action1: action1
                    },
                    dataType: "JSON",
                    success: function(data) {

                        var html1 = '<option value="">Pilih Data NIB Pengguna</option>';
                        for (var index = 0; index < data.length; index++) {
                            html1 += '<option value=' + data[index].NIB + '>' + data[index].NIB + '</option>';
                        }
                        $("#nib").html(html1);
                    }

                });

            } else {
                var html1 = '<option value="0">Pilih Data NIB Pengguna</option>';
                $("nib").html(html1);
            }


        });

        // Alert error tiap inputan form
        var IDIndustri = document.querySelector("input[name=idIndustri]");

        IDIndustri.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Masukkan Angka Sebanyak 13 Digit');
            }
        });
        var NamaIndustri = document.querySelector("input[name=Nama]");

        NamaIndustri.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Isi Nama Industri Anda');
            }
        });
        var IDPengguna = document.querySelector("select[name=idpengguna]");

        IDPengguna.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Masukkan Angka Sebanyak 13 Digit');
            }
        });
        var IDModal = document.querySelector("input[name=Modal]");

        IDModal.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Masukkan Angka Maksimal 20 Digit');
            }
        });
        var IDalamat = document.querySelector("input[name=alamat]");

        IDalamat.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Masukkan Alamat Usaha Anda. Maks. 100 Karakter');
            }
        });
        var IDtenagakerja = document.querySelector("input[name=tenagakerja]");

        IDtenagakerja.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Masukkan Angka. Maks. 5 Digit');
            }
        });

        var IDNIB = document.querySelector("select[name=nib]");

        IDNIB.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Pilih Nomor Izin Berusaha Anda');
            }
        });

        var IDSektor = document.querySelector("select[name=sektor]");

        IDSektor.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Pilih Sektor Industri Anda');
            }
        });

        var IDKBLI = document.querySelector("select[name=kbli]");

        IDKBLI.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Pilih KBLI Industri Anda');
            }
        });

        var IDWilayah = document.querySelector("select[name=wilayah]");

        IDWilayah.addEventListener("invalid", function() {
            this.setCustomValidity('');
            if (!this.validity.valid) {
                this.setCustomValidity('Silahkan Pilih Kecamatan Wilayah Industri Anda');
            }
        });

        $('#idpengguna').select2({
            placeholder: 'Silahkan Pilih ID Pengguna'
        });

        $('#sektor').select2({
            placeholder: 'Silahkan Pilih Sektor Usaha'
        });

        $('#kbli').select2({
            placeholder: 'Silahkan Pilih ID KBLI'
        });

        $('#wilayah').select2({
            placeholder: 'Silahkan Pilih Kecamatan Usaha'
        });

        $('#nib').select2({
            placeholder: 'Silahkan Pilih Nomor Izin Berusaha'

        });

    });
</script>

<?= $this->endSection('isikonten'); ?>