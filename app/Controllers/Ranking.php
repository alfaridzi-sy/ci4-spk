<?php

namespace App\Controllers;

use App\Models\KalkulasiModel;
use App\Models\RequestModel;

class Ranking extends BaseController
{
    public function index()
    {
        $ModelKalkulasi = new KalkulasiModel();
        $dataranking = $ModelKalkulasi->getRanking();

        $data = [
            'judul' => 'Laman Hasil Perankingan | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'ranking' => $dataranking
        ];

        return view('/admin/ranking/ranking', $data);
    }

    public function lamanrequest() {
        $ModelRequest = new RequestModel();
        $datarequest = $ModelRequest->request_ranking_admin();
        $data = [
            'judul' => 'Laman Request Ranking | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'request' => $datarequest
        ];

        return view('/admin/ranking/notifikasiranking',$data);
    }

    public function lihatrequest($idreq) {
        $ModelRequest = new RequestModel();
        $action_ubah = $ModelRequest->req_reads($idreq);
        $datarequest = $ModelRequest->req_check($idreq);

        $data = [
            'judul' => 'Laman Request Data Industri Kreatif | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'request' => $datarequest
        ];
        return view('/admin/industri/accrequest', $data);
        $data = [
            'judul' => 'Laman Request Data Ranking Industri Kreatif | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'request' => $datarequest
        ];

        return view('/admin/ranking/accrequest', $data);
    }    

    public function accrequest() {
        $ModelRequest = new RequestModel();
    }
}
