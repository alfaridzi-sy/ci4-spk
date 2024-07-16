<?php

namespace App\Models;

use CodeIgniter\Model;

class KalkulasiModel extends Model
{
    protected $table = 'perhitungan';
    protected $primaryKey = 'idperhitungan';
    protected $allowedFields = ['idperhitungan', 'nib', 'idindustri', 'bobot', 'idkriteria'];

    public function getCategoryData()
    {
        $db = db_connect();
        $sql = $db->query("SELECT NIB, idindustri FROM industri");
        $hasil = $sql->getResultArray();

        foreach ($hasil as $namakolom => $value) {
            $data[$namakolom] = $value;
        }
        return $data;
    }
    public function jumlahdata()
    {
        $db = db_connect();
        $sql = $db->query("SELECT idperhitungan FROM perhitungan");
        $hasil = $sql->getFieldCount();


        // $banyak_data = count($hasil);

        return $hasil;
    }
    public function getAllCategory()
    {
        $db = db_connect();
        $sql = $db->query("SELECT id_kriteria,nama_kriteria,id_kriteria FROM kriteria");
        $hasilquery = $sql->getResultArray();
        $tambahdatakategori = new KalkulasiModel();
        $read = $tambahdatakategori->getCategoryData();

        $a = [];

        foreach ($read as $value) {
            $d[] = $value['nama_kategori'];
        }

        // Ambil nilai nama kriteria untuk nama tabel dinamis
        foreach ($hasilquery as $value) {
            // Analogi array sama kayak bakso, ada kresek->bakso beranak->bakso kecil
            // Format array -> nama var array, index array, isi index array, nilai komponen array
            // $b[$value['nama_kriteria']][$value['id_kriteria']]=$value['bobot_kriteria'];
            // $b[$value['id_kriteria']]=$value['nama_kriteria'];
            $b[] = $value['nama_kriteria'];
            $c[] = $value['bobot_kriteria'];
        }
        $r = [];
        // Memasukkan nilai array b pada array a 
        array_push($a, $b);
        array_push($r, $d);
        array_push($a, $c);
        array_push($a, $r);
        // Cara akses nilainya nanti pakai index 0 dikarenakan array a hanya memiliki 1 index yaitu 0

        return $a;
    }

    public function simpandata($data)
    {

        $db = db_connect();
        $db->table('perhitungan')->insertBatch($data);

        return true;
    }

    public function GetNameByName($namakolom)
    {
        $db = db_connect();

        $sql = $db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA ='uji1' AND TABLE_NAME='perhitungan' AND COLUMN_NAME ='$namakolom'");
        $hasil = $sql->getRow();

        return $hasil->COLUMN_NAME;
    }

    public function UpdateAllWeight($idkriteria,$data) {
        $db = db_connect();
        $sql = $db->query("UPDATE perhitungan SET bobot='$data' WHERE idkriteria='$idkriteria'");
        return true;
    }

    public function UpdateData($nib, $data)
    {

        return $this->db->table('perhitungan')
            ->set($data)
            ->where('nib', $nib)
            ->update($data);
    }

    public function deleteCalculation($nib)
    {
        $db = db_connect();
        $sql = $db->query("DELETE FROM perhitungan WHERE nib='$nib'");
        return true;
    }

    public function getColumn($data)
    {

        $db = db_connect();
        $sql = $db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA ='uji1' AND TABLE_NAME='perhitungan' AND COLUMN_NAME NOT IN ('idperhitungan', 'nib', 'idindustri')");
        $hasil = $sql->getResultArray();
        foreach ($hasil as $namakolom => $value) {
            $databaru[$namakolom] = str_replace('_', ' ', $value['COLUMN_NAME']);
        }
        $sql1 = $db->query("SELECT idindustri FROM industri WHERE idindustri=14");
        $hasil1 = $sql1->getResultArray();
        foreach ($hasil1 as $namakolom => $value) {
            foreach ($value as  $nilai) {
                $databaru1[$namakolom] = $nilai;
            }
        }
        $a = $databaru1[0];
        $array = [];
        $arraybaru = array_map(null, $databaru, $databaru1);
        foreach ($arraybaru as $pair) {
            // $pair[0] adalah nilai dari $array1, $pair[1] adalah nilai dari $array2
            // ?? merupakan cara untuk menambahkan nilai default
            $data1[$pair[0]] = $pair[1] ?? $a;
        }

        return $hasil;
    }

    public function getCriteriaName($id)
    {
        $db = db_connect();
        $sql = $db->query("SELECT nama_kriteria FROM kriteria WHERE id_kriteria='$id'");
        $hasil = $sql->getResultArray();
        dd($hasil);
        return $hasil;
    }

    public function getCriteriaName1()
    {
        $db = db_connect();
        $sql = $db->query("SELECT nama_kriteria FROM kriteria");
        $hasil = $sql->getResultArray();
        foreach ($hasil as $key => $value) {
            foreach ($value as  $nilai) {
                $data[$key] = $nilai;
            }
        }

        return $data;
    }

    public function UpdateBobot($bobot, $namakriteria)
    {
        // return $this->db->table('perhitungan')
        //     ->set($bobot)
        //     ->where('nib', $nib)
        //     ->update($bobot);
    }

    public function Weight()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM perhitungan ORDER BY idperhitungan, NIB");
        $hasil = $sql->getResultArray();
        return $hasil;
    }

    public function IDNIB()
    {
        $db = db_connect();
        $sql = $db->query("SELECT NIB, idindustri FROM perhitungan");
        $hasil = $sql->getResultArray();

        return $hasil;
    }

    public function UpdateDataBatch($data)
    {
        foreach ($data as  $baris) {
            $this->db->table('perhitungan')
                ->where('idkriteria', $baris['idkriteria'])
                ->where('nib', $baris['nib'])
                ->update($baris);
        }
    }


    public function cekbobotakhir()
    {
        $db = db_connect();
        $sql = $db->query("SELECT id_kriteria FROM bobotentropy");
        $result = $sql->getNumRows();

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function tambahbobotakhir($data)
    {
        $db = db_connect();
        $db->table('bobotentropy')->insertBatch($data);

        return true;
    }
    public function truncatebobot()
    {
        $db = db_connect();
        $db->table('bobotentropy')->truncate();

        return true;
    }

    public function GetEntropyWeight()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM bobotentropy");
        $result = $sql->getResultArray();

        return $result;
    }

    public function cekranking()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM moora");
        $result = $sql->getNumRows();

        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function tambahranking($data)
    {
        $db = db_connect();
        $db->table('moora')->insertBatch($data);
        return true;
    }

    public function truncateranking()
    {
        $db = db_connect();
        $db->table('moora')->truncate();
        return true;
    }

    public function getRanking()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM moora");
        $result = $sql->getResultArray();

        return $result;
    }

    public function CekNIBPerhitungan($NIB)
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM perhitungan WHERE nib='$NIB'");
        $result = $sql->getNumRows();


        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function hapusdataNIB($NIB)
    {
        $db = db_connect();
        $sql = $db->query(" DELETE FROM perhitungan WHERE nib='$NIB'");
        return true;
    }

    public function hapusdatamooraNIB($NIB)
    {
        $db = db_connect();
        $sql = $db->query("DELETE FROM moora WHERE nib='$NIB'");
        return true;
    }

    public function request(){
        $db=db_connect();
        $sql=$db->query("SELECT  * FROM req_kepdis WHERE subject_req = 'request_perhitungan'");
        $result=$sql->getResultArray();

        return $result;
    }

   


}
