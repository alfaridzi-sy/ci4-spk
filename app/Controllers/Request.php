<?php

namespace App\Controllers;

use App\Models\RequestModel;
use App\Models\IndustriModel;

class Request extends BaseController
{
    public function req_page_industry()
    {
        $ModelRequest = new RequestModel();
        $datarequest = $ModelRequest->request_industry_admin();
        $data = [
            'judul' => 'Laman Request Data Industri Kreatif | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'request' => $datarequest
        ];

        return view('/admin/industri/notifikasiindustri', $data);
    }
    public function req_page_add_industry()
    {
        return view('welcome_message');
    }

    public function req_page_industry_kepala_dinas()  {
        $session3 = \Config\Services::session();
        $session3->start();
        $ModelRequest = new RequestModel();
        $idrequest = $ModelRequest->req_count();
        $iduser = $session3->get('datapengguna')['idpengguna'];
        $data = [
            'judul' => 'Laman Request Industri | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'id' => $idrequest + 1,
            'iduser' => $iduser
        ];

        return view('/KepalaDinas/industri/requestindustri', $data); 
    }
    public function req_page_ranking()
    {
        $ModelRequest = new RequestModel();
        $datarequest = $ModelRequest->request_ranking_admin();
        $data = [
            'judul' => 'Laman Request Ranking | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'request' => $datarequest
        ];
        return view('/admin/ranking/notifikasiranking', $data);
    }

    public function req_page_ranking_kepala_dinas()
    {
        $session3 = \Config\Services::session();
        $session3->start();
        $ModelRequest = new RequestModel();
        $idrequest = $ModelRequest->req_count();
        $iduser = $session3->get('datapengguna')['idpengguna'];
        $data = [
            'judul' => 'Laman Request Ranking | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'id' => $idrequest + 1,
            'iduser' => $iduser
        ];

        return view('/KepalaDinas/ranking/requestranking', $data);
    }

    public function req_page_ranking_pengguna()
    {
        $session2 = \Config\Services::session();
        $session2->start();
        $ModelRequest = new RequestModel();
        $idrequest = $ModelRequest->req_count();
        $iduser = $session2->get('datapengguna2')['idpengguna'];
        $data = [
            'judul' => 'Laman Request Ranking | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'id' => $idrequest + 1,
            'iduser' => $iduser
        ];

        return view('/User/ranking/requestranking', $data);
    }
    public function req_page_calculation()
    {
        $session3 = \Config\Services::session();
        $session3->start();
        $ModelRequest = new RequestModel();
        $idrequest = $ModelRequest->req_count();
        $iduser = $session3->get('datapengguna')['idpengguna'];
        $data = [
            'judul' => 'Laman Request Perhitungan | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'id' => $idrequest + 1,
            'iduser' => $iduser
        ];

        return view('/KepalaDinas/perhitungan/requesthitung', $data);
    }

    public function requestalldata_kepala_dinas()
    {
        $datainput = [
            'idreq' => $this->request->getVar('idreq'),
            'idpengguna' => $this->request->getVar('idpengguna'),
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

    public function requestalldata_pengguna()
    {
    }

    public function view_req($idreq)
    {
        $session = session();
        $ModelRequest = new RequestModel();
        $action_ubah = $ModelRequest->req_reads($idreq);
        $datarequest = $ModelRequest->req_check($idreq);
        // dd($datarequest);
        $data = [
            'judul' => 'Laman ACC  Data Request | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'request' => $datarequest
        ];

        return view('/admin/industri/accrequest', $data);
    }
    public function confirm_req()
    {
        $datainput = [
            'idreq' => $this->request->getVar('idreq'),
            'subject_req' => $this->request->getVar('subject')
        ];
        $modelReq = new RequestModel();
        $action_confirm = $modelReq->acc_req($datainput['idreq']);

        if ($action_confirm = true) {
            if ($datainput['subject_req'] == 'request_industri') {
                $action_send = $modelReq->copy_industry_data();
                $session = session();
                $session->setFlashdata('pesan', 'Request ACC data industri berhasil');
                return redirect()->to('/industry/notifikasi');
            } elseif ($datainput['subject_req'] == 'request_perhitungan') {
                $action_send = $modelReq->copy_calculate_data();
                $session = session();
                $session->setFlashdata('pesan', 'Request ACC data perhitungan berhasil');
                return redirect()->to('/request-hitung');
            } else {
                $action_send = $modelReq->copy_ranking_data();
                $session = session();
                $session->setFlashdata('pesan', 'Request ACC data ranking berhasil');
                return redirect()->to('/request-ranking-admin');
            }
        }
    }
}
