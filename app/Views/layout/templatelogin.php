<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title><?= $judul; ?></title>
    <link rel="stylesheet" href="<?= base_url('/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="/css/stylelogin1.css">
    <link rel="stylesheet" href="/css/select2.min.css">

    <script src="<?= base_url('/js/jquery.min.js') ?>"></script>
    <script src="/js/select2.min.js"></script>

</head>

<body style="display:flex; flex-direction:column;height: 100%;" class="bg-dark">

    <?= $this->renderSection('isikonten'); ?>


    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>

</body>
<footer class="bg-light text-center text-lg-start" style="flex-grow: 1; bottom:5; position:relative; width:100%;">
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); flex-grow:1;">
        © 2023 Copyright: Muhammad Hasbunallah Amril Sobri
    </div>
    <!-- Copyright -->
</footer>

</html>