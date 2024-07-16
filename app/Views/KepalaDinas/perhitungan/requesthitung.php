<?= $this->extend('layout/templatekepdis'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container mt-4 mb-4">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3 mt-3">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="96px" height="48px" style="display: block; margin:auto;">
                </div>
            </div>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <h1>Request Data Perhitungan</h1>
                    <h5>Deskripsi :</h5>
                    <p>Form ini merupakan form yang digunakan untuk meminta request data perhitungan kepada Administrator sistem agar data industri kreatif dapat ditampilkan.</p>
                    <hr>
                </div>
            </div>
            <form action="/request-data">
                <div class="row mb-3 mt-3">
                    <div class="col-lg-2">
                        <label for="idreq">Id Request :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" id="idreq" name="idreq" class="form-control" placeholder="Masukkan ID Request Anda" disabled value="<?= $id; ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-lg-2">
                        <label for="idpengguna">Id Pengguna :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" id="idpengguna" name="idpengguna" class="form-control" placeholder="Masukkan ID Pengguna Anda" disabled value="<?= $iduser; ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-lg-2">
                        <label for="subject">Subject :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Masukkan Subject Request Anda" disabled value="request_perhitungan">
                    </div>
                </div>
                <div class="row mb-3 mt-3" hidden>
                    <div class="col-lg-2">
                        <label for="status_req">Status Request :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" id="req_stat" name="req_stat" class="form-control" placeholder="Status Request Anda" value="pending">
                    </div>
                </div>

                <div class="row" hidden>
                    <div class="col-lg-2">
                        <label for="status_read">Status Baca :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" name="read_stat" id="read_stat" class="form-control" placeholder="Status Request Anda" value="unread">
                    </div>
                </div>

                <div class="row" hidden>
                    <div class="col-lg-2">
                        <label for="req_role">Role Pengguna :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" name="role_req" id="role_req" class="form-control" placeholder="Role Pengguna Anda" value="kepdis">
                    </div>
                </div>

                <div class="row mb-3 mt-3">
                    <div class="col d-flex justify-content-end">
                        <button type="submit" class="btn btn-outline-primary" id="tombol" name="tombol">Request Data</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        // Penghilangan attribute disable
        var tombol = document.getElementById('tombol');
        var hapusatribut = document.getElementById('idreq');
        var hapusatribut1 = document.getElementById('subject');
        var hapusatribut2 = document.getElementById('idpengguna');

        tombol.addEventListener('click', function() {
            hapusatribut.removeAttribute('disabled');
            hapusatribut1.removeAttribute('disabled');
            hapusatribut2.removeAttribute('disabled');
        });
    });
</script>
<?= $this->endSection('isikonten'); ?>