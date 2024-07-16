<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="224px" height="112px" style="display: block; margin:auto;">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 style="margin-top: 10px; text-align:center;font-family:'Times New Roman', Times, serif;">Daftar Pengguna</h1>
            <p class="text-center">Tabel laman daftar pengguna merupakan tabel yang berisikan data-data terkait akun pengguna yang terkait pada sistem pendukung keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</p>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col">

            <a href="/pengguna/tambahdata" class="btn btn-success mb-3 fa-solid fa-plus" title="Tambah data"></a>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo "Data berhasil ditambahkan"; ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan1')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "Data berhasil dihapus"; ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan3')) : ?>
                <div class="alert alert-secondary" role="alert">
                    <?php echo "Data berhasil diedit"; ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan4')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "ID Kategori sudah ada!"; ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan5')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "Data bobot pada kriteria sudah ada!"; ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan6')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "Silahkan masukkan bobot sesuai dengan ketentuan"; ?>
                </div>
            <?php endif; ?>
            <div class="row">
                <div class="col text-center" style="overflow-x:scroll;">
                    <table class="table" style="overflow:auto;">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Pengguna</th>
                                <th scope="col">Nama Pengguna</th>
                                <th scope="col" style="font-style: italic;">Username</th>
                                <th scope="col">Kata Sandi</th>
                                <th scope="col">NIB Pengguna</th>
                                <th scope="col">Status Akun</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($pengguna as $barispengguna) : ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $barispengguna['iduser']; ?></td>
                                    <td><?php echo $barispengguna['namauser']; ?></td>
                                    <td><?php echo $barispengguna['username']; ?></td>
                                    <td><?php echo $barispengguna['password']; ?></td>
                                    <td><?php echo $barispengguna['NIB']; ?></td>
                                    <td><?php echo $barispengguna['status']; ?></td>
                                    <td><a href="/pengguna/edit/<?php echo $barispengguna['iduser']; ?>" class="btn btn-primary fa-solid fa-rotate" title="Update data"></a>
                                        <form action="/pengguna/<?php echo $barispengguna['iduser']; ?>" method="POST" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger fa-solid fa-trash-can" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" title="Hapus data"></button>
                                        </form>
                                    </td>


                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="btn btn-secondary" style="float: right">
                        <?php echo $pager->links() ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection('isikonten'); ?>