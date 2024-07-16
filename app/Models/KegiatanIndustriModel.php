<?php

namespace App\Models;

use CodeIgniter\Model;

class KegiatanIndustriModel extends Model
{
    protected $table = 'kegiatanusaha';
    protected $primaryKey = 'idkegiatan';
    protected $allowedFields = ['idkegiatan', 'namakegiatan'];

    public function getIndustryActivityData()
    {
        return $this->findAll();
    }

    
}
