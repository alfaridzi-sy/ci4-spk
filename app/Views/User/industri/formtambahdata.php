<?= $this->extend('layout/templatepengguna'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container mt-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                </div>
            </div>
            <div class="row">
                <div class="col ">
                    <h1 class="text-center">Form Request Tambah Data Industri Kreatif</h1>
                    <h5 id="deskripsi">Deskripsi :</h5>
                    <p>Formulir ini merupakan formulir yang berisikan data-data terkait industri kreatif yang akan disimpan pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</p>

                    <hr>
                </div>
            </div>
            <div class="row row-content">
                <div class="col">
                    <form action="">

                        <div class="row align-items-center mb-3">
                            <div class="col col-lg-2">
                                <label for="IdRequest">ID Request :</label>
                            </div>
                            <div class="col col-lg-4">
                                <input type="text" name="idreq" id="idreq" class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <label for="subject">Subject Request :</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-2">
                                <label for="NIB">NIB Pengguna :</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" name="NIB" id="NIB" placeholder="Masukkan NIB Anda" value="<?= session()->get('datapengguna')['nibpengguna']; ?>" disabled class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <label for="namapengguna">Nama Pengguna :</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" name="namapengguna" id="namapengguna" placeholder="Masukkan ID Industri" value="<?= session()->get('datapengguna')['namapengguna']; ?>" class="form-control">
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-2">
                                <label for="idindustri">ID Industri :</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" name="idindustri" id="idindustri" placeholder="Masukkan ID Industri" pattern="[0-9]{13}" required class="form-control">
                            </div>
                            <div class="col-lg-2">
                                <label for="namaindustri">Nama Industri :</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" name="namaindustri" id="namaindustri" placeholder="Masukkan Nama Industri Anda" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-2">
                                <label for="modal">Modal Usaha :</label>
                            </div>
                            <div class="col-lg-10">
                                <input type="text" name="modal" id="modal" placeholder="Masukkan Modal Anda" required pattern="[0-9]{1,}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-2"><label for="alamat">Alamat Industri :</label></div>
                            <div class="col-lg-10">
                                <textarea name="alamat" id="alamat" cols="30" rows="3" placeholder="Masukkan Alamat Industri Anda" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-2">
                                <label for="sektor">Sektor Usaha :</label>
                            </div>
                            <div class="col-lg-10">
                            <select id="sektor" class="form-control" name="sektor" style="width:100%;" required>
                                    <option value="<?php $no; ?>"></option>
                                    <?php foreach ($kategori as $kat) : ?>
                                        <option value=<?= $kat['id_kategori']; ?> data-value=<?= $kat['id_kategori']; ?>><?php echo $kat['nama_kategori']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-2">
                                <label for="KBLI">KBLI Usaha :</label>
                            </div>
                            <div class="col-lg-10">
                                <select id="kbli" class="form-control" name="kbli" style="width:100%;" required>
                                    <option value="">Pilih KBLI</option>
                                    <!-- <?php foreach ($kbli as $idkbli) : ?>
                                        <option value=<?= $idkbli['idkbli']; ?>><?= $idkbli['idkbli'] . "-" . $idkbli['namakegiatan']; ?></option>
                                   <?php endforeach; ?> -->

                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-2">
                                <label for="wilayah">Kecamatan :</label>
                            </div>
                            <div class="col-lg-3">
                                <select id="wilayah" class="form-control" name="wilayah" style="width:100%;" required>
                                    <option value="">Pilih Kecamatan</option>
                                    <?php foreach ($kecamatan as $idkecamatan) : ?>
                                        <option value="<?= $idkecamatan['idkecamatan']; ?>"><?= $idkecamatan['namakecamatan']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <label for="jumlahtenagakerja">Jumlah Tenaga Kerja Usaha :</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="number" name="jumlahtenagakerja" id="jumlahtenagakerja" placeholder="Masukkan Jumlah Tenaga Kerja Anda" required pattern="[0-9]{1,}" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center">
                            <div class="col-lg-2">
                                <label for="tahun">Tahun Usaha :</label>
                            </div>
                            <div class="col-lg-10">
                                <select name="tahun" id="tahun" class="form-control">
                                    <option value="1">Pilih tahun industri anda</option>
                                    <option value="2">2020</option>
                                    <option value="3">2021</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col d-flex justify-content-end">
                                <button type="submit" name="tombol" id="tombol" class="btn btn-outline-primary">Tambah data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('isikonten'); ?>