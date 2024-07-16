<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\IndustriModel;
use App\Models\KalkulasiModel;

class Pengguna extends BaseController
{

    public function index()
    {
        // Menampilkan keseluruhan database
        $penggunaModel = new UserModel();
        // $pengguna = $penggunaModel->tampildatapengguna();
        $pengguna = $penggunaModel->paginate(2);

        $data = [
            'judul' => 'Laman Kelola Pengguna | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'pengguna' => $pengguna,
            'pager' => $penggunaModel->pager
        ];
        
        return view('/admin/pengguna/user', $data);
    }

    public function tambahdata()
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
            'judul' => 'Laman Tambah Data Pengguna | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'NIB' => $NIB,
            'iduser' => $idpengguna
        ];
        return view('/admin/pengguna/tambahdata', $data);
    }

    public function tambah()
    {
        $inputan = [
            'iduser' => $this->request->getVar('iduser'),
            'namauser'
            => $this->request->getVar('namapengguna'),
            'username'
            => $this->request->getVar('username'),
            'password'
            => $this->request->getVar('password'),
            'NIB'
            => $this->request->getVar('NIB'),
            'status'
            => $this->request->getVar('status')
        ];

        $Modelpengguna = new UserModel();
        $tindakan = $Modelpengguna->simpandata($inputan);

        if ($tindakan == true) {
            return redirect()->to('/pengguna');
        }
    }

    public function edit($dataid)
    {
        $penggunaModel = new UserModel();
        $datapengguna = $penggunaModel->ambildataID($dataid);
        $datastatus = $penggunaModel->ambilstatus();

        $data = [
            'judul' => 'Laman Kelola Pengguna | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'pengguna' => $datapengguna,
            'status' => $datastatus
        ];
        return view('/admin/pengguna/editdata', $data);
    }

    public function updatedata($id)
    {
        $penggunaModel = new UserModel();
        $dataupdate = [
            'iduser' => $this->request->getVar('iduser'),
            'namauser'
            => $this->request->getVar('nama'),
            'username'
            => $this->request->getVar('username'),
            'password'
            => $this->request->getVar('password'),
            'NIB'
            => $this->request->getVar('nib'),
            'status' => $this->request->getVar('status'),
        ];

        $tindakan = $penggunaModel->updatedata($id, $dataupdate);

        if ($tindakan == true) {

            return redirect()->to('/pengguna');
        }
    }

    public function hapusdata($idpengguna)
    {
        $penggunaModel = new UserModel();
        $perhitunganModel = new KalkulasiModel();
        $industriModel = new IndustriModel();

        $datapengguna = $penggunaModel->ambildataID($idpengguna);

        //Pengecekan data di tabel perhitungan
        $cekperhitungan =  $perhitunganModel->CekNIBPerhitungan($datapengguna['NIB']);

        if ($cekperhitungan == false) {
            $hapusdatapengguna = $penggunaModel->hapusdata($idpengguna);
            return redirect()->to('/pengguna');
        } else {
            $hapusdataranking = $perhitunganModel->hapusdatamooraNIB($datapengguna['NIB']);
            if ($hapusdataranking == true) {
                $hapusdataperhitungan = $perhitunganModel->hapusdataNIB($datapengguna['NIB']);
                if ($hapusdataperhitungan == true) {
                    $hapusdataindustri = $industriModel->hapusdataindustriNIB($datapengguna['NIB']);
                    if ($hapusdataindustri == true) {
                        $hapusdatapengguna = $penggunaModel->hapusdata($idpengguna);
                        return redirect()->to('/pengguna');
                    } else {
                        echo "Penghapusan data industri gagal.";
                    }
                } else {
                    echo "Penghapusan data perhitungan gagal.";
                }
            } else {
                echo "Penghapusan data ranking gagal.";
            }
        }
    }
}
