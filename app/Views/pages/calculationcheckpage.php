<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 style="margin-top: 10px; text-align:center">DAFTAR SISWA</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Usia</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($siswa as $sis) : ?>
                        <tr>
                            <th scope="row">1</th>
                            <td><?= $sis['nama']; ?></td>
                            <td><?= $sis['kelas']; ?></td>
                            <td><?= $sis['usia']; ?></td>
                            <td><a href="" class="btn btn-danger">Delete</a> <a href="" class="btn btn-primary">Update</a></td>

                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection('isikonten'); ?>