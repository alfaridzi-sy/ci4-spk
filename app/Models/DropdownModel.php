<?php 

namespace App\Models;

use CodeIgniter\Model;

class DropdownModel extends Model
{
    // Model dapat menggunakan berbagai jenis tabel sekaligus tanpa harus di protect

    // Mengambil nilai KBLI
    public function getnilaiKBLI($idsektor)
    {
        
        return $this->db->table('kbli')
        ->where('idsektor', $idsektor)
        ->join('kegiatanusaha','kegiatanusaha.idkegiatan=kbli.idkegiatanusaha')
        ->get()->getResultArray();
    }

    // Mengambil nilai NIB
    public function getNIB($nib)
    {
        return $this->db->table('user')
        ->where('iduser', $nib)
        ->get()->getResultArray();

    }

    

}


