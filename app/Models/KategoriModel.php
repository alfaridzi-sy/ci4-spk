<?php

namespace App\Models;

use CodeIgniter\Commands\Utilities\Publish;
use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['id_kategori', 'nama_kategori', 'bobot_kategori', 'id_kriteria', 'min', 'max'];
    public function getCustomCriteria($id)
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM kategori WHERE id_kriteria='$id'");
        $result = $sql->getResultArray();

        return $result;
    }

    public function getSector($id, $idkriteria)
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM kategori WHERE id_kriteria='$id' AND id_kategori='$idkriteria'");
        $result = $sql->getResultArray();

        return $result[0];
    }

    public function getAllCategory()
    {
        // return $this->findAll();
        $db = db_connect();
        $sql = $db->query("SELECT * FROM kategori");
        $result = $sql->getResultArray();

        return $result;
    }

    public function InsertSector($data)
    {
        $db = db_connect();
        $db->table('kategori')->insert($data);
        return true;
    }

    // public function getCombinedCategory()
    // {
    //     return $this->db->table('kategori')
    //         ->join('kriteria', 'kriteria.id_kriteria=kategori.id_kriteria')
    //         ->get()->getResultArray();
    // }

    public function getCriteira($id)
    {

        $db = db_connect(); 
        $sql = $db->query("SELECT * FROM kriteria");
        $result = $sql->getResultArray();

        return $result;
    }

    public function getPartial($id)
    {
        return $this->db->table('kategori')
            ->where(['id_kategori' => $id])
            ->get()->getResultArray();
    }

    public function updateData($id, $data)
    {

        // return $this->update($data, $id);
        return $this->db->table('kategori')
            ->set($data)
            ->where('id_kategori', $id)
            ->update($data);
    }

    public function deleteRow($id)
    {
        return $this->db->table('kategori')
            ->delete(['id_kategori' => $id]);
    }


    public function CheckedWeight($id, $bobot, $id_kategori)
    {
        // Koneksi database
        $db = db_connect();

        // Update kategori berdasarkan id kriteria dan bobot pada masing-masing kriteria
        $query = $db->query("SELECT id_kategori,bobot_kategori, id_kriteria FROM kategori WHERE id_kriteria = '$id' AND bobot_kategori = '$bobot'");
        $result = $query->getResultArray();

        // inisiasi variabel pesan
        $pesan = "";

        // Jika data bobot kosong pada database
        if (empty($result)) {
            $pesan = "true";
        } else {
            // Pengecekan data bobot menggunakan ID Kategori, Bobot, dan ID Kriteria
            foreach ($result as  $value) {
                // Kondisi jika data yang diupdate adalah data yang sama
                if ($value['id_kategori'] === $id_kategori && $value['bobot_kategori'] === $bobot && $value['id_kriteria'] === $id) {
                    $pesan = "true";
                    break;
                    // Kondisi jika terdapat data pada field yang akan diupdate
                } elseif ($value['id_kategori'] !== $id_kategori && $value['bobot_kategori'] === $bobot && $value['id_kriteria'] === $id) {
                    $pesan = "false";
                    break;
                } else {
                    $pesan = 'false';
                    break;
                }
            }
        }
        return $pesan;
    }

    public function CheckedID($id_kategori)
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM kategori WHERE id_kategori='$id_kategori'");
        $result = $sql->getResultArray();

        return $result;
    }

    public function CheckWeightedCategory($bobot, $id_kriteria)
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM kategori WHERE bobot_kategori='$bobot' AND id_kriteria='$id_kriteria'");
        $result = $sql->getResultArray();

        return $result;
    }

    public function GetOldData($idkategori, $idkriteria)
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM kategori WHERE id_kategori='$idkategori' AND id_kriteria='$idkriteria'");
        $hasil = $sql->getResultArray();

        return $hasil[0];
    }

    public function getLastCategoryID()
    {
        $db = db_connect();
        $sql = $db->query("SELECT id_kategori FROM kategori ORDER BY id_kategori DESC LIMIT 1");
        $result = $sql->getRow();

        return $result->id_kategori;
    }

    public function getIsNumerical($id_kriteria){
        $db = db_connect();
        $sql = $db->query("SELECT isNumerical FROM kriteria WHERE id_kriteria='$id_kriteria'");
        $result = $sql->getRow();

        return $result->isNumerical;
    }
}
