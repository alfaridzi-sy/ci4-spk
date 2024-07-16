<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title><?= $judul; ?></title>
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="/css/stylepengguna.css">
    <link rel="stylesheet" href="/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('/asset/fontawesome/css/fontawesome.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../asset/fontawesome/css/solid.css') ?>">
    <script src="<?= base_url('/js/jquery.min.js') ?>"></script>
    <script src="/js/select2.min.js"></script>
</head>

<body style="display:flex; flex-direction:column;height:100%;">
    <nav class="navbar navbar-expand-lg bg-dark">
        <button class="navbar-toggler bg-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="font-family: 'Times New Roman', Times, serif;">
            <i class="fa-solid fa-grip-lines"></i> Menu
        </button>
        <div class="container">
            <div class="container-fluid">

                <div class="collapse navbar-collapse navbar-dark navbar-hover" id="navbarSupportedContent">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('lamanutamapengguna'); ?>"><img alt="Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan" src="<?= base_url('../asset/pemkabsipp.png'); ?>" width="60px" height="40px" style="margin-right: -20px;"></a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('infoindustry'); ?>">Informasi Industri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('ceklayak'); ?>">Cek Kelayakan Industri</a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('infoakun'); ?>">Informasi Akun</a>
                        </li>
                        
                    </ul>
                    <form action="/logout-user" method="post" class="d-flex" role="search">
                        <button class="btn btn-outline-success" style="border-radius: 23px;" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <?= $this->renderSection('isikonten'); ?>


    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

    <footer class="bg-light text-center text-lg-start" style="flex-grow: 1;">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); flex-grow:1;">
            © 2024 Copyright: Muhammad Hasbunallah Amril Sobri
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>