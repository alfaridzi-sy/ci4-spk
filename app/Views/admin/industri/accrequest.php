<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container mt-4 mb-4">
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <button id="tombol-kembali" name="tombol-kembali" class="btn btn-outline-light rounded-circle" onclick="history.go(-1)" title="Kembali"><span class="fa-solid fa-chevron-left"></span></button>
                </div>
            </div>
            <div class="row mb-3 mt-1">
                <div class="col">
                    <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="224px" height="112px" style="display: block; margin:auto;">
                </div>
            </div>
            <div class="row mb-3 mt-3">
                <div class="col">
                    <h1 class="text-center">ACC Request Data</h1>
                    <h5>Deskripsi :</h5>
                    <p>Form ini merupakan form yang digunakan untuk memvalidasi data industri kreatif agar dapat ditampilkan sesuai dengan request.</p>
                    <hr>
                </div>
            </div>
            <form action="/confirm-request" method="post">
                <div class="row mb-3 mt-3">
                    <div class="col-lg-2">
                        <label for="idreq">Id Request :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" id="idreq" name="idreq" class="form-control" placeholder="Masukkan ID Request Anda" disabled value="<?= $request['idreq']; ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-lg-2">
                        <label for="subject">Subject :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Masukkan Subject Request Anda" disabled value="<?= $request['subject_req']; ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-3" hidden>
                    <div class="col-lg-2">
                        <label for="status_req">Status Request :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" id="req_stat" name="req_stat" class="form-control" placeholder="Status Request Anda" value="<?= $request['status_req']; ?>]">
                    </div>
                </div>

                <div class="row" hidden>
                    <div class="col-lg-2">
                        <label for="status_read">Status Baca :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" name="read_stat" id="read_stat" class="form-control" placeholder="Status Request Anda" value="<?= $request['status_read']; ?>]">
                    </div>
                </div>

                <div class="row" hidden>
                    <div class="col-lg-2">
                        <label for="role_req">Role Pengguna :</label>
                    </div>
                    <div class="col-lg-10">
                        <input type="text" name="role_req" id="role_req" class="form-control" placeholder="Role Pengguna" value="<?= $request['role_req']; ?>">
                    </div>
                </div>
<?php if ($request['status_req']=='confirm') { ?>
    <div class="row mb-3 mt-3">
        <div class="col d-flex justify-content-end">
            <button type="submit" class="btn btn-success" id="tombol" name="tombol" disabled> <span class="fa-solid fa-lg fa-check"></span> Accepted</button>
        </div>
    </div>
<?php } else { ?>
    <div class="row mb-3 mt-3">
        <div class="col d-flex justify-content-end">
            <button type="submit" class="btn btn-outline-primary" id="tombol" name="tombol">Confirm Request Data</button>
        </div>
    </div>
<?php } ?>

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

        tombol.addEventListener('click', function() {
            hapusatribut.removeAttribute('disabled');
            hapusatribut1.removeAttribute('disabled');
        });
    });
</script>


<?= $this->endSection('isikonten'); ?>