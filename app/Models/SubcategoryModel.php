<?php

namespace App\Models;

use CodeIgniter\Commands\Utilities\Publish;
use CodeIgniter\Model;

class SubcategoryModel extends Model
{
    protected $table = 'subkategori';
    protected $primaryKey = 'id_subkategori';
    protected $allowedFields = ['id_subkategori', 'id_kategori', 'nama_subkategori'];

    public function getLastSubcategoryID()
    {
        $db     = db_connect();
        $sql    = $db->query("SELECT id_subkategori FROM subkategori ORDER BY id_subkategori DESC LIMIT 1");
        $result = $sql->getRow();

        if ($result) {
            return $result->id_subkategori;
        } else {
            // Jika tidak ada data, kembalikan nilai default atau sesuai kebutuhan aplikasi
            return 0;
        }
    }

    public function getCategoryByCriteriaWithNomialCondition($id_kriteria)
    {
        $db = db_connect();

        // Ambil kondisi isNumerical dari tabel kriteria
        $getKriteriaNominalCondition = $db->query("SELECT isNumerical FROM kriteria WHERE id_kriteria = '$id_kriteria'");
        $kriteriaNominalConditionData = $getKriteriaNominalCondition->getRow();
        $kriteriaNominalCondition = $kriteriaNominalConditionData->isNumerical;

        // Ambil data kategori berdasarkan id_kriteria
        $getCategoryByKriteria = $db->query("SELECT * FROM kategori WHERE id_kriteria='$id_kriteria'");
        $categoryByKriteriaData = $getCategoryByKriteria->getResultArray();

        // Buat array untuk menyimpan data yang akan dikembalikan
        $categories = [];

        foreach ($categoryByKriteriaData as $category) {
            if ($kriteriaNominalCondition == 1) {
                // Jika isNumerical == 1, tampilkan min dan max
                $optionText = "{$category['min']} - {$category['max']}";
            } else {
                // Jika isNumerical != 1 (nominal), tampilkan nama_kategori
                $optionText = $category['nama_kategori'];
            }

            // Tambahkan opsi ke array
            $categories[] = [
                'id_kategori' => $category['id_kategori'],
                'option_text' => $optionText
            ];
        }

        return $categories;
    }

    public function saveSubcategory($data)
    {
        $this->insert($data);
        return $this->db->insertID();
    }

    public function getSubcategoriesByCategory($id_kategori)
    {
        return $this->where('id_kategori', $id_kategori)->findAll();
    }

    public function deleteRow($id)
    {
        return $this->db->table('subkategori')
            ->delete(['id_subkategori' => $id]);
    }
}
