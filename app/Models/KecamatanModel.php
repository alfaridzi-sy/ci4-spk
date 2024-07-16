<?php

namespace App\Models;

use CodeIgniter\Model;

class KecamatanModel extends Model
{
    protected $table = 'kecamatan';
    protected $primaryKey = 'idkecamatan';
    

    public function getKecamatan()
    {
        return $this->findAll();
    }
    
}
