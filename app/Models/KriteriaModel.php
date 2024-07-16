<?php

namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $allowedFields = ['id_kriteria', 'nama_kriteria', 'attribute_kriteria', 'bobot_kriteria', 'isNumerical'];

    public function getAllCriteria()
    {
        return $this->findAll();
    }

    public function getPartialCriteria($id)
    {
        return $this->where(['id_kriteria' => $id])
            ->get()->getResultArray();
    }

    public function updateCriteria($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCriteria($id)
    {
        return $this->delete($id);
    }

    public function WeightCheck()
    {
        $db = db_connect();
        $query = $db->query("SELECT SUM(bobot_kriteria) AS total_bobot FROM {$this->table}");
        $result = $query->getRow();

        return $result->total_bobot;
    }

    public function UpdateCheck($id)
    {
        $db = db_connect();
        $query = $db->query("SELECT SUM(bobot_kriteria) AS total_bobot FROM {$this->table} WHERE id_kriteria <> '$id'");
        $result = $query->getRow();

        return $result->total_bobot;
    }

    public function IDChecked($id)
    {
        $db = db_connect();
        $query = $db->query("SELECT id_kriteria FROM {$this->table} WHERE id_kriteria='$id'");
        $result = $query->getRow();

        return $result;
    }

    public function CheckLastCriteria()
    {
        $db = db_connect();
        $sql = $db->query("SELECT nama_kriteria FROM {$this->table} ORDER BY id_kriteria DESC LIMIT 1");
        $hasil = $sql->getRow();

        return $hasil->nama_kriteria;
    }

    public function GetCriteriaNameByID($id)
    {
        $db = db_connect();
        $sql = $db->query("SELECT nama_kriteria FROM kriteria WHERE id_kriteria='$id'");
        $hasil = $sql->getRow();

        return $hasil->nama_kriteria;
    }

    public function getCriteiraID()
    {
        $db = db_connect();
        $sql = $db->query("SELECT id_kriteria FROM kriteria ORDER BY id_kriteria DESC LIMIT 1");
        $result = $sql->getRow();

        return $result->id_kriteria;
    }

    public function getAllCriteriaName() {
        $db=db_connect();
        $sql=$db->query("SELECT nama_kriteria FROM kriteria");
        $hasil = $sql->getResultArray();

        return $hasil;
    }
}
