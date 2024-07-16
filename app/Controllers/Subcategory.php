<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\KategoriModel;
use App\Models\SubCategoryModel;

class Subcategory extends BaseController
{
    public function tambahdata()
    {
        $kriteriaModel  = new KriteriaModel();
        $kriteriaData   = $kriteriaModel->getAllCriteria();

        $kategoriModel  = new KategoriModel();
        $kategoriData   = $kategoriModel->getAllCategory();

        $subkategoriModel   = new SubcategoryModel();
        $getLastID          = $subkategoriModel->getLastSubcategoryID();
        $lastCategoryID     = intval($getLastID);
        $newID              = $lastCategoryID + 1;

        $data = [
            'judul'         => 'Laman Kelola Subkategori | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'kriteria_data' => $kriteriaData,
            'kategori_data' => $kategoriData,
            'newID'         => $newID
        ];

        return view('/admin/subcategory/tambahdata', $data);
    }

    public function getCategories($idKriteria)
    {
        $subkategoriModel   = new SubcategoryModel();
        $categories         = $subkategoriModel->getCategoryByCriteriaWithNomialCondition($idKriteria);

        return json_encode($categories);
    }

    public function simpandata()
    {
        $request = service('request');

        // Validasi data yang diterima dari form
        $rules = [
            'id_kriteria' => 'required',
            'id_kategori' => 'required',
            'namaSubkategori' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data dari form
        $idKriteria = $request->getVar('id_kriteria');
        $idKategori = $request->getVar('id_kategori');
        $namaSubkategori = $request->getVar('namaSubkategori');

        // Simpan data menggunakan model SubcategoryModel
        $subkategoriModel = new SubcategoryModel();
        $subkategoriModel->save([
            'id_kriteria' => $idKriteria,
            'id_kategori' => $idKategori,
            'nama_subkategori' => $namaSubkategori
        ]);

        // Redirect ke halaman sebelumnya atau halaman sukses
        session()->setFlashdata('pesan', 'Data subkategori berhasil ditambahkan');
        return redirect()->to('/criteria');
    }

    public function delete($id_subkategori)
    {
        $subkategoriModel = new SubcategoryModel();
        $hapus = $subkategoriModel->deleteRow($id_subkategori);
        if ($hapus == true) {
            session()->setFlashdata('pesan1', 'Data berhasil dihapus');
            return redirect()->to('/criteria');
        }
    }
}
