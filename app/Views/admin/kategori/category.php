<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 style="margin-top: 10px; text-align:center">DAFTAR KATEGORI</h1>

            <a href="/category/tambahdata" class="btn btn-success mb-3">Tambah Data Kategori</a>
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
                <div class="col" style="overflow-x:scroll;">
                    <table class="table" style="overflow:auto;">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Bobot Kategori</th>
                                <th scope="col">Jenis Kriteria</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($kategori as $krit) : ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $krit['id_kategori']; ?></td>
                                    <td><?php echo $krit['nama_kategori']; ?></td>
                                    <td><?php echo $krit['bobot_kategori']; ?></td>
                                    <td><?php echo $krit['id_kriteria']; ?></td>
                                    <td><a href="/category/edit/<?php echo $krit['id_kategori']; ?>" class="btn btn-primary">Update</a>
                                        <form action="/category/<?php echo $krit['id_kategori']; ?>" method="POST" class="d-inline">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')">Delete</button>
                                        </form>
                                    </td>


                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection('isikonten'); ?>