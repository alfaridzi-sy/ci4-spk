<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestModel extends Model
{
    protected $table = 'req_kepdis';
    protected $primaryKey = 'idreq';
    protected $allowedFields = ['idreq', 'subject_req', 'status_req', 'read_req', 'role_req', 'created_at'];
    protected $useTimestamps = false;

    public function req_count()
    {
        $db = db_connect();
        $sql = $db->query("SELECT idreq FROM req_kepdis");
        $result = $sql->getNumRows();

        return $result;
    }
    public function add_req($data)
    {
        $db = db_connect();
        $db->table('req_kepdis')->insert($data);
        return true;
    }
    public function req_reads($id)
    {
        return $this->db->table('req_kepdis')
            ->where('idreq', $id)
            ->update(['status_read' => 'read']);

        return true;
    }
    public function req_check($iddata)
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM req_kepdis WHERE idreq='$iddata'");
        $result = $sql->getResultArray();

        return $result[0];
    }

    public function acc_req($id)
    {
        return $this->db->table('req_kepdis')
            ->where('idreq', $id)
            ->update(['status_req' => 'confirm']);

        return true;
    }

    public function request_industry_admin()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM req_kepdis WHERE subject_req='request_industri'");
        $result = $sql->getResultArray();

        return $result;
    }

    public function copy_industry_data()
    {
        $db = db_connect();
        $sql = $db->query("INSERT INTO industri_kepdis  SELECT * FROM industri");

        return true;
    }

    public function check_industry_data()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM industri_kepdis");
        $result = $sql->getNumRows();

        return $result;
    }

    public function get_industry_data()
    {
        $db = db_connect();
        $sql = $db->query("SELECT idindustri as ID_Industri,nama_industri as Nama_Industri,
        t2.namauser  as Nama_Pengguna,t1.NIB,t3.nama_kategori as Sektor_Usaha,jumlahmodal as Jumlah_Modal,
        t4.nama_kategori as Modal, t5.idkbli as ID_KBLI, t6.namakegiatan as Nama_Kegiatan,t7.nama_kategori as Skala_IKM,
        t8.nama_kategori as Skala_Usaha,t9.nama_kategori as Resiko_Usaha, alamatusaha as Alamat_Usaha, 
        t10.namakecamatan as Kecamatan,t11.nama_kategori as Wilayah_Usaha,
        jumlahtenagakerja as Jumlah_Tenaga_Kerja, t12.nama_kategori as Tenaga_Kerja, tahun
        FROM industri_kepdis t1, user t2, kategori t3, kategori t4, kbli t5, kegiatanusaha t6, kategori t7,
        kategori t8, kategori t9, kecamatan t10, kategori t11, kategori t12
        WHERE t1.iduser=t2.iduser AND t1.sektorusaha=t3.id_kategori AND t1.modal=t4.id_kategori
        AND t1.kbli=t5.idkbli AND t5.idkegiatanusaha=t6.idkegiatan AND t1.skalaikm=t7.id_kategori
        AND t1.skalausaha=t8.id_kategori AND t1.resikousaha=t9.id_kategori
        AND t1.kecamatan=t10.idkecamatan AND t1.wilayahusaha=t11.id_kategori
        AND t1.tenagakerja=t12.id_kategori ");
        $result = $sql->getResultArray();

        return $result;
    }

    public function request_ranking_admin()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM req_kepdis WHERE subject_req='request_perankingan'");
        $result = $sql->getResultArray();

        return $result;
    }

    public function check_ranking_data()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM ranking_kepdis");
        $result = $sql->getNumRows();

        return $result;
    }

    public function get_rank_data()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM ranking_kepdis");
        $result = $sql->getResultArray();

        return $result;
    }

    public function copy_ranking_data()
    {
        $db = db_connect();
        $sql = $db->query("INSERT INTO ranking_kepdis  SELECT * FROM moora");

        return true;
    }
    public function check_ranking_req_stats()
    {
        $db = db_connect();
        $sql = $db->query("SELECT status_req FROM req_kepdis WHERE subject_req='request_perankingan' ORDER BY idreq DESC LIMIT 1");
        $result = $sql->getResultArray();
        $data = null;
        foreach ($result as $value) {
            foreach ($value as  $values) {
                $data = $values;
            }
        }

        return $data;
    }

    public function check_industry_req_stats()
    {
        $db = db_connect();
        $sql = $db->query("SELECT status_req FROM req_kepdis WHERE subject_req = 'request_industri' ORDER BY idreq DESC LIMIT 1");
        $result = $sql->getResultArray();
        $data = null;
        foreach ($result as $value) {
            foreach ($value as $values) {
                $data = $values;
            }
        }
        return $data;
    }

    public function check_calculation_req_stats()
    {
        $db = db_connect();
        $sql = $db->query("SELECT status_req FROM req_kepdis WHERE subject_req = 'request_perhitungan' ORDER BY idreq DESC LIMIT 1");
        $result = $sql->getResultArray();
        $data = null;
        foreach ($result as $value) {
            foreach ($value as $values) {
                $data = $values;
            }
        }
        return $data;
    }

    public function copy_calculate_data()
    {
        $db = db_connect();
        $sql = $db->query('INSERT INTO perhitungan_kepdis SELECT * FROM perhitungan');
        return true;
    }

    public function check_calculation_data() {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM perhitungan_kepdis ORDER BY nib, idperhitungan");
        $result =  $sql->getResultArray();

        return $result;
    }

    public function getIDandNIB() {
        $db = db_connect();
        $sql = $db->query("SELECT nib, idindustri FROM perhitungan_kepdis");
        $result =  $sql->getResultArray();

        return $result;
    }

    public function check_summary_calculation_data()  {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM perhitungan_kepdis");
        $result = $sql->getNumRows();

        return $result;
    }

    public function UpdateKepdisWeight($idkriteria, $bobot) {
        $db = db_connect();
        $sql = $db->query("UPDATE perhitungan_kepdis SET bobot='$bobot' WHERE idkriteria='$idkriteria'");
        return true;
    }

    public function truncate_request()
    {
        $db = db_connect();
        $db->table('ranking_kepdis')->truncate();
        $db->table('industri_kepdis')->truncate();
        $db->table('perhitungan_kepdis')->truncate();
        return true;
    }
}
