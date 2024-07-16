<?php

namespace App\Controllers;

use App\Models\IndustriModel;
use App\Models\UserModel;

class Pages extends BaseController
{
    public function index()
    {
        $industriModel = new IndustriModel();
        $penggunaModel = new UserModel();
        $datajumlahindustri = $industriModel->JumlahIndustri();
        $datajumlahpengguna = $penggunaModel->JumlahPengguna();

        $data = [
            'judul' => 'Home | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'industri' => $datajumlahindustri,
            'pengguna' => $datajumlahpengguna
        ];
        return view('admin/home/mainpage', $data);
    }
    public function criteria()
    {
        $data = [
            'judul' => 'Laman Kelola Kriteria | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        echo view('pages/criteria', $data);
    }
    public function category()
    {
        $data = [
            'judul' => 'Laman Kelola Kategori | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        echo view('pages/categorypage', $data);
    }
    public function ranking()
    {
        $data = [
            'judul' => 'Laman Hasil Perankingan | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        echo view('pages/rankingpage', $data);
    }


    public function industry()
    {
        $data = [
            'judul' => 'Laman Industri | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        echo view('pages/industrypage', $data);
    }
}
