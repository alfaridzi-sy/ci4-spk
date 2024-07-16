<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use Config\VariableMigrasi;

class TambahKolomKriteria extends Migration
{
    protected $namakolom;
    public function up()
    {
        // Menambahkan kolom terakhir pada database perhitungan sesuai sesuai dengan data terakhir kriteria
        $kolombaru = VariableMigrasi::$kolombaru;
        dd($kolombaru);
    }

    public function down()
    {
        //Menghapus kolom database berdasarkan kolom terakhir ataupun kolom yang dihapus
    }
}
