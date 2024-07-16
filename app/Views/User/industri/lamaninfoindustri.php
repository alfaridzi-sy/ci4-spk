<?= $this->extend('layout/templatepengguna'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container mb-4 mt-4">
    <div class="row">
        <div class="col">
            <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="224px" height="112px" style="display: block; margin:auto;">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <h1 class="text-center">Laman Informasi Industri</h1>
            <h5 id="deskripsi">Deskripsi :</h5>
            <p>Laman ini berisikan terkait informasi industri yang anda miliki dan terdaftar pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</p>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col col-lg-6 mb-4">
            <a class="btn btn-success" href="/tambah-data" title="Tambah Data"><span class="fa fa-plus"></span></a>
            <a class="btn btn-primary" href="/notifikasi-pengguna" title="Notifikasi"><span class="fa fa-bell"></span></a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="table-responsive table-bordered d-flex justify-content-center">
                <table>
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>No</th>
                            <th>data industri</th>
                            <th>status industri</th>
                            <th>created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>kadsfljas</td>
                            <td>1</td>
                            <td>pending</td>
                            <td>20-202-20022</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <h5 id="deskripsi">Terkait perubahan ataupun penghapusan terkait data industri kreatif, harap menghubungi Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</h5>
    <p>Alur : pengguna input data request -> status pending munculkan pada tabel dengan warna abu-abu -> setelah ditambahkan tampilkan pada lamn informasi industri</p>
</div>

<?= $this->endSection('isikonten'); ?>