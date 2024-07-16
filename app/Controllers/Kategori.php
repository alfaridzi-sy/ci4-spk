<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\KriteriaModel;
use App\Models\KalkulasiModel;
use App\Models\RequestModel;

class Kategori extends BaseController
{

    public function index()
    {
        // Menampilkan keseluruhan database
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->getAllCategory();

        $data = [
            'judul' => 'Laman Kelola Kategori | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'kategori' => $kategori
        ];

        return view('/admin/kategori/category', $data);
    }
    // Menampilkan database dengan kondisi tertentu/ Select * kriteria where id_kriteria = $idkriteria

    public function tambahdata()
    {
        // menampilkan seluruh data pada kolom tertentu
        $kriteria = new KriteriaModel();
        $idkrit = $kriteria->getAllCriteria();

        $kategoriModel = new KategoriModel();
        $getLastCategoryID = $kategoriModel->getLastCategoryID();
        $lastCategoryID = intval($getLastCategoryID);
        $newCategoryID = $lastCategoryID + 1;

        $data = [
            'judul' => 'Laman Tambah Data Kategori | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'bobot' => $idkrit,
            'newID' => $newCategoryID

        ];
        return view('/admin/kategori/tambahdata', $data);
    }

    public function simpandata()
    {
        $categoryModel = new KategoriModel();

        // Mendapatkan data dari form
        $idKategori = $this->request->getVar('idKategori');
        $namaKategori = $this->request->getVar('Nama');
        $bobot = $this->request->getVar('bobot');
        $idKriteria = $this->request->getVar('idkrit');
        $isNumerical = $categoryModel->getIsNumerical($idKriteria); // Mendapatkan isNumerical dari database berdasarkan idKriteria

        // Cek kondisi jenis kriteria (numerical atau alphabetical)
        if ($isNumerical == 1) {
            // Jika isNumerical == 1, simpan min dan max
            $min = $this->request->getVar('min');
            $max = $this->request->getVar('max');

            $data = [
                'id_kategori' => $idKategori,
                'min' => $min,
                'max' => $max,
                'bobot_kategori' => $bobot,
                'id_kriteria' => $idKriteria
            ];
        } else {
            // Jika isNumerical != 1 (alphabetical), simpan nama_kategori
            $data = [
                'id_kategori' => $idKategori,
                'nama_kategori' => $namaKategori,
                'bobot_kategori' => $bobot,
                'id_kriteria' => $idKriteria
            ];
        }

        // Validasi dan simpan data
        $intIDCategory = intval($idKategori);
        $intID = intval($idKriteria);
        $intWeight = intval($bobot);

        $cekbobotkategori = $categoryModel->CheckWeightedCategory($intID, $intWeight);
        $cekidkategori = $categoryModel->CheckedID($intIDCategory);

        if ($cekidkategori == null) {
            if ($intWeight >= 1 && $intWeight <= 5) {
                if ($cekbobotkategori == null) {
                    $simpandatakategori = $categoryModel->InsertSector($data);
                    if ($simpandatakategori == true) {
                        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                        return redirect()->to('/category');
                    } else {
                        echo print_r($categoryModel->errors());
                    }
                } else {
                    session()->setFlashdata('pesan5', 'Data bobot pada kriteria sudah ada!');
                    return redirect()->to('/category');
                }
            } else {
                session()->setFlashdata('pesan6', 'Silahkan masukkan bobot sesuai dengan ketentuan');
                return redirect()->to('/category');
            }
        } else {
            session()->setFlashdata('pesan4', 'ID Kategori sudah ada!');
            return redirect()->to('/category');
        }
    }

    public function delete($idkrit)
    {
        $kategoriModel = new KategoriModel();
        $hapus = $kategoriModel->deleteRow($idkrit);
        if ($hapus == true) {
            session()->setFlashdata('pesan1', 'Data berhasil dihapus');
            return redirect()->to('/category');
        }
    }

    public function edit($idkrit)
    {
        $kategoriModel = new KategoriModel();
        $datakategori = $kategoriModel->getPartial($idkrit);
        $datakategori1 = $kategoriModel->getCriteira($idkrit);
        $data = [
            'judul' => 'Laman Edit Data Kategori | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'boy' => $datakategori,
            'kriteria' => $datakategori1
        ];

        return view('/admin/kategori/editdata', $data);
    }

    public function updatedata($id)
    {
        $simpan = new KategoriModel();
        $kalkulasi = new KalkulasiModel();
        $request = new RequestModel();

        $idKategori = $this->request->getVar('kategori');
        $namaKategori = $this->request->getVar('Nama');
        $bobot = $this->request->getVar('bobot');
        $idKriteria = $this->request->getVar('idkrit');
        $isNumerical = $simpan->getIsNumerical($idKriteria); // Mendapatkan isNumerical dari database berdasarkan idKriteria

        // Cek kondisi jenis kriteria (numerical atau alphabetical)
        if ($isNumerical == 1) {
            // Jika isNumerical == 1, simpan min dan max
            $min = $this->request->getVar('min');
            $max = $this->request->getVar('max');

            $Masuk = [
                'id_kategori' => $idKategori,
                'min' => $min,
                'max' => $max,
                'bobot_kategori' => $bobot,
                'id_kriteria' => $idKriteria
            ];
        } else {
            // Jika isNumerical != 1 (alphabetical), simpan nama_kategori
            $Masuk = [
                'id_kategori' => $idKategori,
                'nama_kategori' => $namaKategori,
                'bobot_kategori' => $bobot,
                'id_kriteria' => $idKriteria
            ];
        }
        
        $bobotkategori = intval($Masuk['bobot_kategori']);
        $cekbobot = $simpan->CheckedWeight($Masuk['id_kriteria'], $Masuk['bobot_kategori'], $Masuk['id_kategori']);
        $datatua = $simpan->GetOldData($Masuk['id_kategori'], $Masuk['id_kriteria']);

        if ($bobotkategori >= 1 && $bobotkategori <= 5) {
            if ($cekbobot == 'true') {
                $simpan2 = intval($id);

                $simpan->updateData($simpan2, $Masuk);
                $kalkulasi->UpdateAllWeight($Masuk['id_kriteria'], $Masuk['bobot_kategori']);
                $cekdatakepdis = $request->check_summary_calculation_data();
                if ($cekdatakepdis != null || $cekdatakepdis != 0) {
                    $request->UpdateKepdisWeight($Masuk['id_kriteria'], $Masuk['bobot_kategori']);
                    if ($request == true) {
                        session()->setFlashdata('pesan3', 'Data berhasil edit');
                        return redirect()->to('/category');
                    }
                } else {

                    if ($simpan == true) {
                        session()->setFlashdata('pesan3', 'Data berhasil edit');
                        return redirect()->to('/category');
                    }
                }
                // $simpan->save($Masuk);
            } else {
                session()->setFlashdata('pesan5', 'Data bobot pada kriteria sudah ada!');
                return redirect()->to('/category');
            }
        } else {
            session()->setFlashdata('pesan6', 'Silahkan masukkan bobot sesuai dengan ketentuan');
            return redirect()->to('/category');
        }
    }
}
