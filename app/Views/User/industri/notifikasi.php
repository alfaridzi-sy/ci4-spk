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
            <h1 class="text-center">Laman Notifikasi Industri</h1>
            <h5 id="deskripsi">Deskripsi :</h5>
            <p>Laman ini berisikan data request Anda terkait penambahan industri kreatif pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</p>
            <hr>
        </div>
    </div>
    
    <div class="row">
        <div class="col">
            <div class="table-responsive table-bordered d-flex justify-content-center table-hover">
                <table>
                    <thead class="bg-dark text-white nowarp-text">
                        <tr>
                            <th>No</th>
                            <th>Nomor request</th>
                            <th>Tujuan request</th>
                            <th>Data industri</th>
                            <th>Status baca</th>
                            <th>Status Industri</th>
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
    
</div>

<?= $this->endSection('isikonten'); ?>