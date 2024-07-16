<?php

namespace App\Models;

use CodeIgniter\Model;

class KbliModel extends Model
{
    protected $table = 'kbli';
    protected $primaryKey = 'idkbli';


    public function getKBLI()
    {
        return $this->findAll();
    }

    public function getKegiatan()
    {

        return $this->db->table('kbli')
            ->join('kegiatanusaha', 'kbli.idkegiatanusaha=kegiatanusaha.idkegiatan')
            ->join('kategori', 'kbli.idsektor=kategori.id_kategori')
            ->get()->getResultArray();
    }

    public function getLowKBLI()
    {
        return $this->db->table('kbli')
            ->join('kegiatanusaha', 'kbli.idkegiatanusaha=kegiatanusaha.idkegiatan')
            ->join('kategori', 'kbli.idsektor=kategori.id_kategori')
            ->where('kegiatanusaha.tingkatresiko')
            ->get()->getResultArray();
    }
}
