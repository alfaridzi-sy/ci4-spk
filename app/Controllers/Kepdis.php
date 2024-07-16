<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\IndustriModel;
use App\Models\KriteriaModel;
use App\Models\KalkulasiModel;
use App\Models\RequestModel;

class Kepdis extends BaseController
{
    public function index()
    {
        $session = session();
        $ModelPengguna = new UserModel();
        $ModelIndustri = new IndustriModel();

        $dataindustri = $ModelIndustri->JumlahIndustri();
        $dataPengguna = $ModelPengguna->JumlahPengguna();
        $data = [
            'judul' => 'Laman Utama Kepala Dinas Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'pengguna' => $dataPengguna,
            'industri' => $dataindustri
        ];
        if (!$session->get('datapengguna')) {
            $session->setFlashdata('error', 'Session telah berakhir. Anda akan dialihkan ke halaman login dalam 5 detik.');
            return redirect()->to('/login');
        }
        return view('/KepalaDinas/home/lamanutama', $data);
    }

    public function lamancekindustri()
    {
        $reqModel = new RequestModel();
        $cekdataindustri = $reqModel->check_industry_data();
        $cekstatus = $reqModel->check_industry_req_stats();
        if ($cekdataindustri == 0 || $cekdataindustri == null) {
            $data = [
                'judul' => 'Laman Informasi Industri Kepala Dinas Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
                'dataindustri' => $cekdataindustri,
                'status_req' => $cekstatus
            ];

            return view('/KepalaDinas/industri/lamancekindustri', $data);
        } else {
            $dataindustri = $reqModel->get_industry_data();
            $data = [
                'judul' => 'Laman Informasi Industri Kepala Dinas Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
                'dataindustri' => $dataindustri
            ];

            return view('/KepalaDinas/industri/lamancekindustri', $data);
        }
    }

    public function lamanrequestindustri()
    {
        $reqModel = new RequestModel();
        $idrequest = $reqModel->req_count();
        $data = [
            'judul' => 'Laman Request Data Industri Kepala Dinas Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'id' => $idrequest + 1
        ];
        return view('/KepalaDinas/industri/requestindustri', $data);
    }

    public function requestalldata()
    {
        $datainput = [
            'idreq' => $this->request->getVar('idreq'),
            'subject_req' => $this->request->getVar('subject'),
            'status_req' => $this->request->getVar('req_stat'),
            'status_read' => $this->request->getVar('read_stat'),
            'role_req' => $this->request->getVar('role_req')
        ];

        $reqModel = new RequestModel();
        $action = $reqModel->add_req($datainput);

        if ($action == true) {
            $session = session();
            $session->setFlashdata('pesan', 'Request berhasil dikirimkan');
            if ($datainput['subject_req'] == 'request_industri') {
                return redirect()->to('/cekindustri');
            } elseif ($datainput['subject_req'] == 'request_perhitungan') {
                return redirect()->to('/cekhitung');
            } else {
                return redirect()->to('/cekranking');
            }
        } else {
            $session = session();
            $session->setFlashdata('pesan1', 'Request tidak berhasil dikirimkan');
            if ($datainput['subject_req'] == 'request_industri') {
                return redirect()->to('/cekindustri');
            } elseif ($datainput['subject_req'] == 'request_hitung') {
                return redirect()->to('/cekhitung');
            } else {
                return redirect()->to('/cekranking');
            }
        }
    }

    public function lamancekhitung()
    {
        $ModelKriteria = new KriteriaModel();
        $ModelRequest = new RequestModel();
        
        $header = $ModelKriteria->getAllCriteriaName();
        $cekstatus = $ModelRequest->check_calculation_req_stats();
        $databobotkalkulasi = $ModelRequest->check_calculation_data();
        $datanib = $ModelRequest->getIDandNIB();

        // Initialize the array before using it
        $arraybobot = [];

        foreach ($databobotkalkulasi as $baris) {
            if (!isset($arraybobot[$baris['nib']])) {
                $arraybobot[$baris['nib']] = array();
            }
            $arraybobot[$baris['nib']][$baris['idkriteria']] = $baris['bobot'];
        }
        $DataBobot = $arraybobot;

        $arraylengkap = [];
        // Perulangan Tabel Evaluasi
        foreach ($datanib as $nilaiarrayIDNIB) {
            $dataNIB = $nilaiarrayIDNIB['nib'];
            if (isset($DataBobot[$dataNIB])) {
                $arraylengkap[$dataNIB] = array_merge($nilaiarrayIDNIB, $DataBobot[$dataNIB]);
            }
        }

        $perpindahanelemen = $header[2];
        unset($header[2]);
        array_splice($header, 7, 0, [$perpindahanelemen]);

        $data = [
            'judul' => 'Laman Cek Kelayakan Industri Kepala Dinas Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'header' => $header,
            'status_req' => $cekstatus,
            'datakalkulasi' => $arraylengkap
        ];

        return view('/KepalaDinas/perhitungan/lamancekhitung', $data);
    }

    public function lamanrequestperhitungan()
    {
        $reqModel = new RequestModel();
        $idrequest = $reqModel->req_count();
        $data = [
            'judul' => 'Laman Request Perhitungan Kepala Dinas Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'id' => $idrequest + 1
        ];
        return view('/KepalaDinas/perhitungan/requesthitung', $data);
    }

    public function lamancekranking()
    {
        $reqModel = new RequestModel();
        $cekdataranking = $reqModel->check_ranking_data();
        $cekstatus = $reqModel->check_ranking_req_stats();
        
        if ($cekdataranking == 0 || $cekdataranking == null) {
            $pesan = null;
            $data = [
                'judul' => 'Laman Informasi Akun Kepala Dinas Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
                'dataranking' => $pesan,
                'status_request' => $cekstatus
            ];
    
            return view('/KepalaDinas/ranking/lamanranking', $data);
        } else {
            $dataranking = $reqModel->get_rank_data();
            $data = [
                'judul' => 'Laman Informasi Akun Kepala Dinas Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
                'dataranking' => $dataranking
            ];
    
            return view('/KepalaDinas/ranking/lamanranking', $data);
        }
    }

    public function lamanrequestperankingan()
    {
        $session = session();
        $idpengguna = $session->get('datapengguna')['idpengguna'];
        $reqModel = new RequestModel();
        $idrequest = $reqModel->req_count();
        $data = [
            'judul' => 'Laman Request Perankingan Kepala Dinas Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'id' => $idrequest + 1
        ];
        return view('/KepalaDinas/ranking/requestranking', $data);
    }

    public function notifikasi()
    {
        $data = [
            'judul' =>  'Laman Notifikasi Kepala Dinas Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        return view('KepalaDinas/industri/notifikasi', $data);
    }
}