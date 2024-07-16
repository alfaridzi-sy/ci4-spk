<?= $this->extend('layout/template'); ?>
<?= $this->Section('isikonten'); ?>

<div class="container container-fluid">
    <div class="row">
        <div class="col">
            <img class="img-fluid" alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="../asset/pemkabsipp.png" width="224px" height="112px" style="display: block; margin:auto;">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h1 style="margin-top: 10px; text-align:center; font-family:'Times New Roman', Times, serif;">Daftar Kriteria dan Kategori</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <h5 class="font-weight-bold" style="font-family: 'Times New Roman', Times, serif;">Deskripsi :</h5>
            <p class="text-justify">Kriteria merupakan aspek-aspek penilaian yang dilakukan oleh Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan untuk menentukan penerima bantuan. Adapun kategori/subkriteria merupakan rincian aspek penilaian berdasarkan kriteria yang telah ditentukan oleh Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan.</p>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col col-lg-3 d-flex">
                    <a href="/criteria/tambahdata">
                        <button class="btn btn-success mb-3" style="border-radius: 23px; width:280px;">
                            <span class="fa-solid fa-file-circle-plus"></span> Tambah Data Kriteria</button>
                    </a>
                </div>
                <div class="col col-lg-3 d-flex ">
                    <a href="/category/tambahdata">
                        <button class="btn btn-success mb-3" style="border-radius: 23px; width:280px;">
                            <span class="fa-solid fa-file-circle-plus"></span> Tambah Data Kategori</button>
                    </a>
                </div>
                <div class="col col-lg-3 d-flex ">
                    <a href="/subcategory/tambahdata">
                        <button class="btn btn-success mb-3" style="border-radius: 23px; width:280px;">
                            <span class="fa-solid fa-file-circle-plus"></span> Tambah Data Subkategori</button>
                    </a>
                </div>
                <div class="col col-lg-3 d-flex ">
                    <a href="javascript:void(0)">
                        <button class="btn btn-success mb-3" style="border-radius: 23px; width:280px;">
                            <span class="fa-solid fa-file-circle-plus"></span> Tambah Data Dependency</button>
                    </a>
                </div>
            </div>
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
                    <?php echo "Total bobot kriteria telah penuh"; ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('pesan5')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo "ID Kriteria sudah ada!"; ?>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col col-lg-12 d-flex justify-content-center  text-center">
                    <div class="table-responsive mx-auto">
                        <table class="table table-responsive table-bordered table-hover" style="width: 100%;padding-left:15%;padding-right:15%;">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nama Kriteria</th>
                                    <th scope="col">Jenis Attribute</th>
                                    <th scope="col">Bobot Kriteria</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($kriteria as $krit) : ?>
                                    <tr class="kriteria-row" data-kriteria-id="<?= $krit['id_kriteria']; ?>">
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $krit['id_kriteria']; ?> </td>
                                        <td><?php echo $krit['nama_kriteria']; ?></td>
                                        <td><?php echo $krit['attribute_kriteria']; ?></td>
                                        <td><?php echo $krit['bobot_kriteria']; ?></td>
                                        <td><a href=" /criteria/edit/<?php echo $krit['id_kriteria']; ?>" class="btn btn-primary" title="Update data"><i class="fa-solid fa-rotate"></i></a>
                                            <form action="/criteria/<?php echo $krit['id_kriteria']; ?>" method="POST" class="d-inline">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" title="Hapus data"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    <tr class="kategori-row" data-kriteria-id="<?= $krit['id_kriteria']; ?>" style="display: none;">
                                        <td colspan="6">
                                            <table class="table table-resposive table-bordered" style="margin-right: 0px; margin-left:0px;">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>ID Kategori</th>
                                                        <?php if ($krit['isNumerical'] == 1) : ?>
                                                            <th>Min</th>
                                                            <th>Max</th>
                                                        <?php else : ?>
                                                            <th>Nama Kategori</th>
                                                        <?php endif; ?>
                                                        <th>Bobot Kategori</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no1 = 1; ?>
                                                    <?php foreach ($krit['subkriteria'] as $krit1) :  ?>
                                                        <tr class="kategori-data-row" data-kategori-id="<?= $krit1['id_kategori']; ?>">
                                                            <td><?php echo $no1++; ?></td>
                                                            <td><?php echo $krit1['id_kategori']; ?> </td>
                                                            <?php if ($krit['isNumerical'] == 1) : ?>
                                                                <td><?= $krit1['min'] ?></td>
                                                                <td><?= $krit1['max'] ?></td>
                                                            <?php else : ?>
                                                                <td><?= $krit1['nama_kategori'] ?></td>
                                                            <?php endif; ?>
                                                            <td><?php echo $krit1['bobot_kategori']; ?></td>
                                                            <td><a href=" /category/edit/<?php echo $krit1['id_kategori']; ?>" class="btn btn-sm btn-warning fa-solid fa-rotate" title="Update data"></a>
                                                                <form action="/category/<?php echo $krit1['id_kategori']; ?>" method="POST" class="d-inline">
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button type="submit" class="btn btn-sm btn-danger fa-solid fa-trash-can" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" title="Hapus data"></button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php if (isset($krit1['subkategori']) && is_array($krit1['subkategori'])) : ?>
                                                            <tr class="subkategori-row" data-kategori-id="<?= $krit1['id_kategori']; ?>" style="display: none;">
                                                                <td colspan="5">
                                                                    <table class="table table-bordered table-hover">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th scope="col">No</th>
                                                                                <th scope="col">ID Subkategori</th>
                                                                                <th scope="col">Nama Subkategori</th>
                                                                                <th scope="col">Aksi</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php $no_subkategori = 1; ?>
                                                                            <?php foreach ($krit1['subkategori'] as $subkategori) : ?>
                                                                                <tr>
                                                                                    <td><?= $no_subkategori++; ?></td>
                                                                                    <td><?= $subkategori['id_subkategori']; ?></td>
                                                                                    <td><?= $subkategori['nama_subkategori']; ?></td>
                                                                                    <td>
                                                                                        <a href="/subcategory/edit/<?= $subkategori['id_subkategori']; ?>" class="btn btn-warning" title="Update data"><i class="fa-solid fa-rotate"></i></a>
                                                                                        <form action="/subcategory/delete/<?= $subkategori['id_subkategori']; ?>" method="POST" class="d-inline">
                                                                                            <input type="hidden" name="_method" value="DELETE">
                                                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ?')" title="Hapus data"><i class="fa-solid fa-trash-can"></i></button>
                                                                                        </form>
                                                                                    </td>
                                                                                </tr>
                                                                            <?php endforeach; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
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
</div>

<script>
    $(document).ready(function() {
        $('.kriteria-row').click(function() {
            var kriteriaId = $(this).data('kriteria-id');
            // Cek apakah ada subkategori untuk kriteria ini
            if ($('.kategori-row[data-kriteria-id=' + kriteriaId + '] .kategori-data-row').length > 0) {
                $('.kategori-row[data-kriteria-id=' + kriteriaId + ']').toggle();
                console.log(kriteriaId);
            }
        });

        // Toggle untuk menampilkan subkategori saat baris kategori diklik
        $('.kategori-data-row').click(function() {
            var kategoriId = $(this).data('kategori-id');
            // Cek apakah ada subkategori untuk kategori ini
            if ($('.subkategori-row[data-kategori-id=' + kategoriId + ']').length > 0) {
                $('.subkategori-row[data-kategori-id=' + kategoriId + ']').toggle();
                console.log($('.kategori-row'));
            }
        });
    });
</script>
<?= $this->endSection('isikonten'); ?>