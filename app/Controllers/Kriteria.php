<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\KalkulasiModel;
use App\Models\KategoriModel;
use App\Models\SubcategoryModel;
use Config\Database;

use function PHPSTORM_META\type;

class Kriteria extends BaseController
{

    public function index()
    {
        // Menampilkan keseluruhan database
        $kriteriaModel      = new KriteriaModel;
        $kategoriModel      = new KategoriModel();
        $subcategoryModel   = new SubcategoryModel();
        $kriteria = $kriteriaModel->getAllCriteria();
        $kategori = $kategoriModel->getAllCategory();

        $datasubkriteria = [];
        foreach ($kriteria as  $nilaikolomkriteria) {
            $subdata = [];
            foreach ($kategori as  $nilaikolomkategori) {
                if ($nilaikolomkategori['id_kriteria'] === $nilaikolomkriteria['id_kriteria']) {
                    $subkat = $subcategoryModel->getSubcategoriesByCategory($nilaikolomkategori['id_kategori']);
                    $nilaikolomkategori['subkategori'] = $subkat;

                    $subdata[] = $nilaikolomkategori;
                }
                $datasubkriteria[$nilaikolomkriteria['id_kriteria']] = [
                    'id_kriteria' => $nilaikolomkriteria['id_kriteria'],
                    'nama_kriteria' => $nilaikolomkriteria['nama_kriteria'],
                    'attribute_kriteria' => $nilaikolomkriteria['attribute_kriteria'],
                    'bobot_kriteria' => $nilaikolomkriteria['bobot_kriteria'],
                    'isNumerical' => $nilaikolomkriteria['isNumerical'],
                    'subkriteria' => $subdata
                ];
            }
        }


        $data = [
            'judul' => 'Laman Kelola Kriteria dan Kategori | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'kriteria' => $datasubkriteria
        ];

        return view('/admin/kriteria/criteria', $data);
    }
    // // Menampilkan database dengan kondisi tertentu/ Select * kriteria where id_kriteria = $idkriteria
    // public function tesdbtertentu($idkrit)
    // {
    //     $idkrit = $this->kriteriaModel->where(['bobot_kriteria' => $idkrit])->findAll();
    //     dd($idkrit);
    // }

    public function tambahdata()
    {
        // menampilkan seluruh data pada kolom tertentu
        $kriteriaModel = new kriteriaModel;
        $datakriteria = $kriteriaModel->getCriteiraID();
        $dataidterakhir = intval($datakriteria);
        $dataid = $dataidterakhir + 1;
        $data = [
            'judul' => 'Laman Tambah Data Kriteria | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'ID' => $dataid
        ];
        return view('/admin/kriteria/tambahdata', $data);
    }

    public function simpandata()
    {
        $simpan = new KriteriaModel();
        $Masuk = [
            'id_kriteria' => $this->request->getVar('idKriteria'),
            'nama_kriteria' => $this->request->getVar('Nama'),
            'attribute_kriteria' => $this->request->getVar('attribute'),
            'bobot_kriteria' => $this->request->getVar('bobot'),
            'isNumerical' => $this->request->getVar('jenisKriteria')
        ];

        $ModelKriteria = new KriteriaModel;
        $Cekbobot = $ModelKriteria->WeightCheck();
        $idcek = $ModelKriteria->IDChecked($Masuk['id_kriteria']);

        if ($idcek === null) {
            if ($Cekbobot < 1) {
                $simpan->save($Masuk);
                if ($simpan == true) {
                    session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                    $simpan->insert($Masuk);
                    // Cek kriteria yang ditambahkan pada tabel kriteria
                    $cekkolom = $ModelKriteria->CheckLastCriteria();
                    $konversistring = str_replace(' ', '_', $cekkolom);
                    $tambahkolom = \Config\Database::forge();
                    $datakolom = [
                        $konversistring => [
                            'type'             =>  'INT',
                            'constraint'    => 2,
                            'default'         => 0
                        ],
                    ];
                    $tambahkolom->addColumn('perhitungan', $datakolom);
                    return redirect()->to('/criteria');
                } else {
                    echo print_r($simpan->errors());
                }
            } else {
                session()->setFlashdata('pesan4', 'Total Bobot Kriteria telah penuh');
                return redirect()->to('/criteria');
            }
        } else {
            session()->setFlashdata('pesan5', 'ID Kriteria sudah ada!');
            return redirect()->to('/criteria');
        }
    }

    public function delete($idkrit)
    {
        $delete = new KriteriaModel;
        $ModelPerhitungan = new KalkulasiModel();
        // $tindakan = \Config\Database::forge();

        // $ambilnama = $delete->GetCriteriaNameByID($idkrit);

        // $konversistring = str_replace(' ', '_', $ambilnama);
        // // dd($konversistring);
        // $aksideletekolom = $ModelPerhitungan->GetNameByName($konversistring);

        // if ($aksideletekolom != null) {
        //     $tindakan->dropColumn('perhitungan', $aksideletekolom);
        // }
        $hapus = $delete->deleteCriteria($idkrit);

        if ($hapus == true) {
            session()->setFlashdata('pesan1', 'Data berhasil dihapus');
            return redirect()->to('/criteria');
        }
    }

    public function edit($idkrit)
    {
        $datakriteria = new KriteriaModel;
        $getSelectedCriteria = $datakriteria->getPartialCriteria($idkrit);
        $data = [
            'judul' => 'Laman Edit Data Kriteria | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'boy' => $getSelectedCriteria
        ];

        return view('/admin/kriteria/editdata', $data);
    }

    public function updatedata($id)
    {

        $simpan = new KriteriaModel();
        $Masuk = [
            'id_kriteria' => $this->request->getVar('kriteria'),
            'nama_kriteria' => $this->request->getVar('nama'),
            'attribute_kriteria' => $this->request->getVar('attribut'),
            'bobot_kriteria' => $this->request->getVar('bobot1'),
            'isNumerical' => $this->request->getVar('jenisKriteria')
        ];
        $simpan2 = $id;
        $ModelKriteria = new KriteriaModel();
        $ModelPerhitungan = new KalkulasiModel();
        $tindakan = \Config\Database::forge();
        $cekkriteria = $ModelKriteria->UpdateCheck($simpan2);
        $konversi = round($cekkriteria, 2);
        $konversi2 = floatval($Masuk['bobot_kriteria']);
        $hasilcek = $konversi + $konversi2;
        $kuota = 1;

        // $ambildatanama = $ModelKriteria->GetCriteriaNameByID($simpan2);
        // $konversistring = str_replace(' ', '_', $ambildatanama);
        // $ambildatanama2 = $ModelPerhitungan->GetNameByName($konversistring);


        if ($hasilcek <= 1) {

            $simpan->updateCriteria($simpan2, $Masuk);
            // if ($ambildatanama2 != null) {
            //     $datakolombaru = [
            //         $ambildatanama2 => [
            //             'name' => str_replace(' ', '_', $Masuk['nama_kriteria']),
            //             'type' => 'INT',
            //             'constraint' => 2,
            //             'null' => false,
            //         ],
            //     ];

            //     $tindakan->modifyColumn('perhitungan', $datakolombaru);
            // } else {
            //     echo "Data tidak ada";
            // }
            if ($simpan == true) {
                session()->setFlashdata('pesan3', 'Data berhasil edit');
                return redirect()->to('/criteria');
            }
        } else {
            session()->setFlashdata('pesan4', 'Total Bobot Kriteria telah penuh');
            return redirect()->to('/criteria');
        }
    }
}
