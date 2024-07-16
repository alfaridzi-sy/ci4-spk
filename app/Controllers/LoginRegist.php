<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\IndustriModel;
use App\Models\KriteriaModel;
use App\Models\RequestModel;

class LoginRegist extends BaseController
{
    public function index()
    {
        // $session3=session();
        // dd($session3->get('datapengguna3'));
        $data = [
            'judul' => 'Laman Login Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        return view('/Pengguna/login', $data);
    }
    public function login()
    {

        $Modelpengguna = new UserModel();
        $datauser = [
            'datausername' => $this->request->getVar('username'),
            'datapassword' => $this->request->getVar('password')
        ];
        $namapengguna = $datauser['datausername'];
        $katasandi = $datauser['datapassword'];
        $cekidpengguna = $Modelpengguna->cekidpengguna($namapengguna, $katasandi);
        $datapengguna = [
            'idpengguna' => $cekidpengguna['iduser'],
            'namapengguna' => $cekidpengguna['namauser'],
            'nibpengguna' => $cekidpengguna['NIB'],
            'statuspengguna' => $cekidpengguna['status']
        ];
        $autentikasi = $Modelpengguna->CheckIDPass($namapengguna, $katasandi);
        if ($autentikasi == false) {
            session()->setFlashdata('pesan', 'Login gagal, silahkan cek ulang username dan password Anda!');

            return redirect()->to('/login');
        } else {
            if ($autentikasi['status'] == 'admin') {
                $session1 = \Config\Services::session();
                $session1->start();
                $session1->set('datapengguna1', $datapengguna);
                // return view('/admin/home/mainpage',['session1' => $session1]);
                return redirect()->to('/mainpage')->with('session1', $session1);
            } elseif ($autentikasi['status'] == 'user') {
                $session2 = \Config\Services::session();
                $session2->start();
                $session2->set('datapengguna2', $datapengguna);
                $data = [
                    'judul' => 'Laman Utama Pengguna | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',

                ];
                return view('/User/home/lamanutama', $data);
            } else {
                $Modelindustri = new IndustriModel();
                $cekidpengguna = $Modelpengguna->cekidpengguna($namapengguna, $katasandi);
                $jumlahindustri = $Modelindustri->JumlahIndustri();
                $jumlahpengguna = $Modelpengguna->JumlahPengguna();
                $session3 = \Config\Services::session();
                $session3->start();
                $session3->set('datapengguna', $datapengguna);
                $data = [
                    'judul' => 'Laman Utama Kepala Dinas | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
                    'industri' => $jumlahindustri,
                    'pengguna' => $jumlahpengguna
                ];
                return view('/KepalaDinas/home/lamanutama', $data);
            }
        }
        // dd($autentikasi);
    }

    public function register()
    {
        $Modelpengguna = new UserModel();
        $dataID = $Modelpengguna->dataid();
        $idpengguna = 0;
        foreach ($dataID as $value) {
            $idpengguna = $value + 1;
        }


        $NIB
            = str_pad(mt_rand(0, 999999999999), 14, '0', STR_PAD_LEFT);

        $data = [
            'judul' => 'Laman Register Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'NIB' => $NIB,
            'iduser' => $idpengguna
        ];

        return view('/Pengguna/register', $data);
    }

    public function registerakun()
    {
        $Modelpengguna = new UserModel();
        $inputan = [
            "iduser" => $this->request->getVar('iduser'),
            "namauser" => $this->request->getVar('namapengguna'),
            "username" => $this->request->getVar('username'),
            "password" => $this->request->getVar('password'),
            "NIB" => $this->request->getVar('NIB'),
            "status" => $this->request->getVar('status')
        ];

        $aksi = $Modelpengguna->simpandata($inputan);

        if ($aksi == true) {
            $data = [
                'judul' => 'Laman Login Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
            ];
            return view('/Pengguna/login', $data);
        }
    }

    public function logout()
    {
        $session1 = \Config\Services::session();
        $session1->destroy();
        return redirect()->to('/login');
    }
    public function logout_user()
    {
        $ModelRequest = new RequestModel();
        $session2 = session();
        $truncate = $ModelRequest->truncate_request_user();
        $session2->destroy();
        return redirect()->to('/login');
        
    }

    public function logout_kepdis()
    {
        $ModelRequest = new RequestModel();
        $session3 = \Config\Services::session();
        $truncate = $ModelRequest->truncate_request();
        $session3->destroy();
        return redirect()->to('/login');
    }
}
