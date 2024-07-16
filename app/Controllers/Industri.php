<?php

namespace App\Controllers;

use App\Models\IndustriModel;
use App\Models\KategoriModel;
use App\Models\KbliModel;
use App\Models\KecamatanModel;
use App\Models\KriteriaModel;
use App\Models\DropdownModel;
use App\Models\KalkulasiModel;
use App\Models\KegiatanIndustriModel;
use App\Models\UserModel;
use App\Models\RequestModel;
use LDAP\Result;

class Industri extends BaseController
{
    protected $industriModel;
    protected $kategoriindustriModel;
    protected $userModel;
    public function __construct()
    {
        $this->industriModel = new IndustriModel();
        $this->kategoriindustriModel = new KategoriModel();
        $this->userModel = new UserModel();
    }
    public function index()
    {
        // Menampilkan keseluruhan database
        $industri = $this->industriModel->getIndustryData();
        $modelkriteria = new KriteriaModel();
        $kolom = $modelkriteria->getAllCriteria();
        foreach ($kolom as  $value) {
            $datakolom[] = $value['nama_kriteria'];
        }

        $data = [
            'judul' => 'Laman Kelola Industri | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'industri' => $industri,
            'kolom' => $datakolom
        ];

        return view('/admin/industri/industry', $data);
    }
    // Menampilkan database dengan kondisi tertentu/ Select * kriteria where id_kriteria = $idkriteria
    // public function tesdbtertentu($idkrit)
    // {
    //     $idkrit = $this->kriteriaModel->where(['bobot_kriteria' => $idkrit])->findAll();
    //     dd($idkrit);
    // }

    public function tambahdata()
    {
        // menampilkan seluruh data pada kolom tertentu
        $id = 1;
        $kategori = $this->kategoriindustriModel->getCustomCriteria($id);

        $kbli = new KbliModel();
        $datakbli = $kbli->getKegiatan();

        $pengguna = $this->userModel->findAll();

        $kecamatan = new KecamatanModel();
        $datakecamatan = $kecamatan->getKecamatan();

        $kegiatanusaha = new KegiatanIndustriModel();
        $datakegiatan = $kegiatanusaha->getIndustryActivityData();

        $data = [
            'judul' => 'Laman Tambah Data Industri | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'kbli' => $datakbli,
            'kategori' => $kategori,
            'kecamatan' => $datakecamatan,
            'kegiatanusaha' => $datakegiatan,
            'user' => $pengguna

        ];
        return view('/admin/industri/tambahdata', $data);
    }

    public function simpandata()
    {
        $simpan = new IndustriModel();
        // Data input form industri 
        $Masuk = [
            'idindustri' => $this->request->getVar('idIndustri'),
            'nama_industri' => $this->request->getVar('Nama'),
            'iduser' => $this->request->getVar('idpengguna'),
            'nib' => $this->request->getVar('nib'),
            'sektorusaha' => $this->request->getVar('sektor'),
            'modal' => $this->request->getVar('Modal'),
            'alamatusaha' => $this->request->getVar('alamat'),
            'kbli' => $this->request->getVar('kbli'),
            'kecamatan' => $this->request->getVar('wilayah'),
            'tenagakerja' => $this->request->getVar('tenagakerja')
        ];

        // Konversi tipe data input form industri
        $idindustrial = intval($Masuk['idindustri']);
        $namaindustri = $Masuk['nama_industri'];
        $idpengguna1 = intval($Masuk['iduser']);
        $nibuser = $Masuk['nib'];
        $sektorusaha = intval($Masuk['sektorusaha']);
        $alamatindustri = $Masuk['alamatusaha'];
        $kbliusaha = intval($Masuk['kbli']);
        $modalusaha = intval($Masuk['modal']);
        $kecamatanusaha = intval($Masuk['kecamatan']);
        $tenaga = intval($Masuk['tenagakerja']);

        // Kriteria di luar input
        $modalindustri = 0;
        $skalaindustri = 0;
        $skalausahaindustri = 0;
        $resiko = 0;
        $wilayahindustri = 0;
        $tenagakerja1 = 0;

        // Kumpulan array validasi kbli dan wilayah
        $arraykblirendah = [0, 10311, 10313, 10314, 10330, 10391, 10392, 10423, 10531, 10532, 10611, 10612, 10614, 10615, 10631, 10633, 10634, 10710, 10729, 10733, 10739, 10761, 10762, 10763, 10772, 10774, 10779, 10792, 10793, 10794, 10799, 10801, 10802, 12091, 13134, 16101, 16221, 16292, 16293, 25111, 25112, 25910, 25992, 25993, 31001, 31009];
        $arraykblimenengahrendah = [0, 10130, 10211, 10213, 10214, 10216, 10217, 10219, 10293, 10297, 10298, 10732, 10740, 10750, 10771, 10773, 13912, 13921, 13929, 14302, 14303, 16299, 25920];
        $arraykblimenengahtinggi = [0, 10110, 10120, 10510, 13121, 13122, 13133, 13999, 14111, 14112, 14120, 14131, 14132, 14200, 14301, 16101];
        $arraykblitinggi = [0, 12011, 12013, 12019];
        $arraywilayahkota = [0, 2, 5, 8, 11, 12];
        $arraywilayahtepiankota = [0, 3, 4, 6, 7, 10];
        $arraywilayahterpencil = [0, 1, 9];

        // Validasi KBLI
        $cekkbli1 = array_search($kbliusaha, $arraykblirendah);
        $cekkbli2 = array_search($kbliusaha, $arraykblimenengahrendah);
        $cekkbli3 = array_search($kbliusaha, $arraykblimenengahtinggi);
        $cekkbli4 = array_search($kbliusaha, $arraykblitinggi);

        // Validasi wilayah usaha
        $cekwilayah1 = array_search($kecamatanusaha, $arraywilayahkota);
        $cekwilayah2 = array_search($kecamatanusaha, $arraywilayahtepiankota);
        $cekwilayah3 = array_search($kecamatanusaha, $arraywilayahterpencil);

        // Kondisi wilayah usaha
        if ($cekwilayah1 == true) {
            $wilayahindustri = 25;
        } else {
            if ($cekwilayah2 == true) {
                $wilayahindustri = 24;
            } else {
                if ($cekwilayah3 == true) {
                    $wilayahindustri = 23;
                }
            }
        }

        // Kondisi skala industri
        if ($tenaga < 20) {
            $skalaindustri = 11;
        } else {
            $skalaindustri = 12;
        }

        // Kondisi modal industri 
        if ($modalusaha <= 50000000) {
            $modalindustri = 6;
        } elseif ($modalusaha > 50000000 && $modalusaha <= 100000000) {
            $modalindustri = 7;
        } elseif ($modalusaha > 100000000 && $modalusaha <= 500000000) {
            $modalindustri = 8;
        } elseif ($modalusaha > 500000000 && $modalusaha <= 1000000000) {
            $modalindustri = 9;
        } else {
            $modalindustri = 10;
        }

        // Kondisi Skala Usaha dan resiko usaha
        if ($modalusaha < 1000000000) {
            $skalausahaindustri = 13;
            if ($cekkbli1 == true) {
                $resiko = 15;
            } else {
                if ($cekkbli2 == true) {
                    $resiko = 16;
                } else {
                    if ($cekkbli3 == true) {
                        $resiko = 17;
                    } else {
                        if ($cekkbli4 == true) {
                            $resiko = 18;
                        }
                    }
                }
            }
        } else {
            $skalausahaindustri = 14;
            if ($cekkbli1 == true) {
                $resiko = 15;
            } else {
                if ($cekkbli2 == true) {
                    $resiko = 16;
                } else {
                    if ($cekkbli3 == true) {
                        $resiko = 17;
                    } else {
                        if ($cekkbli4 == true) {
                            $resiko = 18;
                        }
                    }
                }
            }
        }

        // Kondisi jumlah tenaga kerja
        if ($tenaga < 5) {
            $tenagakerja1 = 28;
        } elseif ($tenaga <= 10 && $tenaga >= 5) {
            $tenagakerja1 = 27;
        } else {
            $tenagakerja1 = 26;
        }

        // Data lengkap hasil konversi semua kriteria
        $simpan1 = [
            'idindustri' => $idindustrial,
            'nama_industri' => $namaindustri,
            'iduser' => $idpengguna1,
            'NIB' => $nibuser,
            'sektorusaha' => $sektorusaha,
            'jumlahmodal' => $modalusaha,
            'modal' => $modalindustri,
            'kbli' => $kbliusaha,
            'skalaikm' => $skalaindustri,
            'skalausaha' => $skalausahaindustri,
            'resikousaha' => $resiko,
            // 'jumlahusahaindustri' => $jumlahusahaindustri,
            'alamatusaha' => $alamatindustri,
            'wilayahusaha' => $wilayahindustri,
            'kecamatan' => $kecamatanusaha,
            'tenagakerja' => $tenagakerja1,
            'jumlahtenagakerja' => $tenaga

        ];

        // Proses penyimpanan database
        if ($simpan1 != null) {

            // Eksekusi penyimpanan database
            $simpandata = $simpan->SaveData($simpan1);

            // Validasi jumlah usaha industri
            $modelperrhitungan = new KalkulasiModel();
            $jumlahusaha = 0;
            $validasijumlah = $simpan->cekjumlahusaha($nibuser);
            $konversi = intval($validasijumlah);

            // Kondisi pengambilan nilai kriteria jumlah usaha yang dimiliki
            if ($konversi != 0) {
                // jika usaha yang dimiliki sebanyak satu buah usaha
                if ($konversi == 1) {
                    // Jumlah usaha sebanyak satu buah usaha
                    $jumlahusaha = 22;
                    // Mengambil ID dan NIB Industri untuk mengecek modal
                    $nib['nib'] = intval($nibuser);
                    $id['industri'] = intval($simpan1['idindustri']);

                    // Mengambil data lengkap industri untuk dikonversi ke dalam bobot
                    $datakonversi = [
                        'sektor' => $sektorusaha,
                        'modal' => $modalindustri,
                        'skalaindustri' => $skalaindustri,
                        'skalausaha' => $skalausahaindustri,
                        'resiko' => $resiko,
                        'wilayah' => $wilayahindustri,
                        'tenaga' => $tenagakerja1,
                        'jumlahusaha' => $jumlahusaha
                    ];

                    // Konversi data industri ke dalam bobot
                    $cekbobot = $simpan->GetWeight($datakonversi);
                    foreach ($cekbobot as $namakolom => $value1) {
                        #Data bobot
                        $databaruu[$namakolom] = $value1[0];
                        #Data id kriteria   
                        $databaruu1[$namakolom] = $value1[1];
                    }
                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $id, $databaruu);

                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $id;
                    }

                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }

                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);


                    //    Penyatuan data konversi pembobotan dengan NIB dan ID Industri
                    // $datahasilkonversi = [
                    //     'nib' => $nib,
                    //     'idindustri' => $id
                    // ] + $databaru;

                    // Ekselusi penyimpanan pada tabel perhitungan
                    $simpandataperhitungan = $modelperrhitungan->simpandata($modifarr);
                    // Kondisi jika terdapat dua buah usaha
                } elseif ($konversi == 2) {

                    // Nilai kriteria jumlah usaha sebanyak 2 buah
                    $jumlahusaha = 21;
                    // Data NIB pengguna
                    $nib['nib'] = intval($nibuser);
                    // Melakukan pengecekan dan pengambilan data modal tertinggi
                    $cekmodalusaha = $simpan->cekmodal($nib['nib']);
                    // inisiasi variabel databaru untuk memasukkan nilai hasil konversi modal
                    $databaru = null;
                    // Pengambilan data  IDindustri dengan modal tertinggi pada tiap kriteria
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            $databaru[$namakolom] = intval($nilaidata);
                            break;
                        }
                    }
                    // Pengambilan data industri modal terbesar berdasarkan masing-masing kriteria dan nilainya
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            continue;
                        }
                        $databaru1[$namakolom] = intval($nilaidata);
                    }
                    // Inisiasi data ID industri
                    $idmodal['industri'] = $databaru['idindustri'];
                    // Inisiasi data jumlah usaha
                    $datakonversi = [
                        'jumlahusaha' => $jumlahusaha
                    ];
                    // Penggabungan data lengkap industri untuk konversi nilai kategori menjadi bobot
                    $datagabungan = $databaru1 + $datakonversi;
                    // Pengecekan dan konversi nilai krategori menjadi bobot
                    $cekbobot = $simpan->GetWeight($datagabungan);

                    foreach ($cekbobot as $namakolom => $value1) {
                        #Data bobot
                        $databaruu[$namakolom] = $value1[0];
                        #Data id kriteria   
                        $databaruu1[$namakolom] = $value1[1];
                    }

                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $idmodal, $databaruu);

                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $idmodal;
                    }

                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }

                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);

                    // Eksekusi update data tabel perhitungan
                    $eksekusi = $modelperrhitungan->UpdateDataBatch($modifarr);
                } elseif ($konversi == 3) {
                    // Nilai kriteria jumlah usaha sebanyak 3 buah
                    $jumlahusaha = 20;
                    // Data NIB pengguna
                    $nib['nib'] = intval($nibuser);
                    // Melakukan pengecekan dan pengambilan data modal tertinggi
                    $cekmodalusaha = $simpan->cekmodal($nib['nib']);
                    // inisiasi variabel databaru untuk memasukkan nilai hasil konversi modal
                    $databaru = null;
                    // Pengambilan data  IDindustri dengan modal tertinggi pada tiap kriteria
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            $databaru[$namakolom] = intval($nilaidata);
                            break;
                        }
                    }
                    // Pengambilan data industri modal terbesar berdasarkan masing-masing kriteria dan nilainya
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            continue;
                        }
                        $databaru1[$namakolom] = intval($nilaidata);
                    }
                    // Inisiasi data ID industri
                    $idmodal = $databaru['idindustri'];
                    // Inisiasi data jumlah usaha
                    $datakonversi = [
                        'jumlahusaha' => $jumlahusaha
                    ];
                    // Penggabungan data lengkap industri untuk konversi nilai kategori menjadi bobot
                    $datagabungan = $databaru1 + $datakonversi;
                    // Pengecekan dan konversi nilai krategori menjadi bobot
                    $cekbobot = $simpan->GetWeight($datagabungan);
                    foreach ($cekbobot as $namakolom => $value1) {
                        #Data bobot
                        $databaruu[$namakolom] = $value1[0];
                        #Data id kriteria   
                        $databaruu1[$namakolom] = $value1[1];
                    }

                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $idmodal, $databaruu);

                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $idmodal;
                    }

                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }

                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(
                        null,
                        $datanib,
                        $dataindustri,
                        $databaruu,
                        $databaruu1
                    );
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);

                    // Eksekusi update data tabel perhitungan
                    $eksekusi = $modelperrhitungan->UpdateDataBatch($modifarr);
                } else {
                    // Kondisi jumlah usaha lebih dari 3 buah usaha
                    $jumlahusaha = 19;
                    // Data NIB pengguna
                    $nib['nib'] = intval($nibuser);
                    // Melakukan pengecekan dan pengambilan data modal tertinggi
                    $cekmodalusaha = $simpan->cekmodal($nib['nib']);
                    // inisiasi variabel databaru untuk memasukkan nilai hasil konversi modal
                    $databaru = null;
                    // Pengambilan data  IDindustri dengan modal tertinggi pada tiap kriteria
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            $databaru[$namakolom] = intval($nilaidata);
                            break;
                        }
                    }
                    // Pengambilan data industri modal terbesar berdasarkan masing-masing kriteria dan nilainya
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            continue;
                        }
                        $databaru1[$namakolom] = intval($nilaidata);
                    }
                    // Inisiasi data ID industri
                    $idmodal = $databaru['idindustri'];
                    // Inisiasi data jumlah usaha
                    $datakonversi = [
                        'jumlahusaha' => $jumlahusaha
                    ];
                    // Penggabungan data lengkap industri untuk konversi nilai kategori menjadi bobot
                    $datagabungan = $databaru1 + $datakonversi;
                    // Pengecekan dan konversi nilai krategori menjadi bobot
                    $cekbobot = $simpan->GetWeight($datagabungan);
                    foreach ($cekbobot as $namakolom => $value1) {
                        #Data bobot
                        $databaruu[$namakolom] = $value1[0];
                        #Data id kriteria   
                        $databaruu1[$namakolom] = $value1[1];
                    }

                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $idmodal, $databaruu);

                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $idmodal;
                    }

                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }

                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);

                    // Eksekusi update data tabel perhitungan
                    $eksekusi = $modelperrhitungan->UpdateDataBatch($modifarr);
                }
            } else {
                // Jumlah usaha sebanyak satu buah usaha
                $jumlahusaha = 22;
                // Mengambil ID dan NIB Industri untuk mengecek modal
                $nib['nib'] = intval($nibuser);
                $id['industri'] = intval($simpan1['idindustri']);

                // Mengambil data lengkap industri untuk dikonversi ke dalam bobot
                $datakonversi = [
                    'sektor' => $sektorusaha,
                    'modal' => $modalindustri,
                    'skalaindustri' => $skalaindustri,
                    'skalausaha' => $skalausahaindustri,
                    'resiko' => $resiko,
                    'wilayah' => $wilayahindustri,
                    'tenaga' => $tenagakerja1,
                    'jumlahusaha' => $jumlahusaha
                ];

                // Konversi data industri ke dalam bobot
                $cekbobot = $simpan->GetWeight($datakonversi);
                foreach ($cekbobot as $namakolom => $value1) {
                    $databaruu[$namakolom] = $value1[0];
                    $databaruu1[$namakolom] = $value1[1];
                }
                // pemasangan  array dengan komponen NIB dan ID industri
                $arraybaru = array_map(null, $nib, $id, $databaruu);
                // Pembuatan array NIB untuk banyak baris pasangan array
                foreach ($arraybaru as $pair) {
                    $arraynib[] = $pair[0]['nib'] ?? $nib;
                    $arrayindustri[] = $pair[1]['industri'] ?? $id;
                }
                // Pengaksesan nilai NIB dan ID industri
                #NIB 
                foreach ($arraynib as $barisnib => $komponennib) {
                    foreach ($komponennib as $nilainib) {
                        $datanib[] = $nilainib;
                    }
                }
                #ID Industri
                foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                    foreach ($komponenindustri as $nilaiindustri) {
                        $dataindustri[] = $nilaiindustri;
                    }
                }
                // Pemasangan nilai NIB dengan array pasangan
                $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                // Membuat nama kolom array agar tidak indeks 0,1,2,....
                $modifarr = array_map(function ($row) {
                    return [
                        'nib' => $row[0],
                        'idindustri' => $row[1],
                        'bobot' => $row[2],
                        'idkriteria' => $row[3]
                    ];
                }, $arraylengkap);


                //    Penyatuan data konversi pembobotan dengan NIB dan ID Industri
                // $datahasilkonversi = [
                //     'nib' => $nib,
                //     'idindustri' => $id
                // ] + $databaru;

                // Ekselusi penyimpanan pada tabel perhitungan
                $simpandataperhitungan = $modelperrhitungan->simpandata($modifarr);
            }


            if ($simpandata == true) {
                session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
                return redirect()->to('/industry');
            } else {
                echo print_r($simpan->errors());
            }
        } else {
            session()->setFlashdata('pesan4', 'Data industri kosong');
            return redirect()->to('/industry');
        }
    }


    public function edit($idkrit)
    {
        $dataindustri = $this->industriModel->where(['idindustri' => $idkrit])->findAll();
        foreach ($dataindustri as $namakolom => $nilai) {
            $datakonversi[$namakolom] = $nilai;
        }
        $pengguna = new UserModel();
        $datapengguna = $pengguna->ambildataID($datakonversi[0]['iduser']);

        $id_kriteria = 1;
        $id_sektor = $dataindustri[0]['sektorusaha'];
        $kategori1 = $this->kategoriindustriModel->getCustomCriteria($id_kriteria);
        $kategori = $this->kategoriindustriModel->getSector($id_kriteria, $id_sektor);
        $kbli = new KbliModel();
        $datakbli = $kbli->getKegiatan();
        $pengguna = $this->userModel->findAll();
        $kecamatan = new KecamatanModel();
        $datakecamatan = $kecamatan->getKecamatan();

        $kegiatanusaha = new KegiatanIndustriModel();
        // dd($dataindustri[0], $datakecamatan, $kategori);
        $data = [
            'judul' => 'Laman Edit Data Industri | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'boy' => $dataindustri[0],
            'kbli' => $datakbli,
            'kategori' => $kategori,
            'kategori1' => $kategori1,
            'kecamatan' => $datakecamatan,
            'user' => $datapengguna
        ];

        return view('/admin/industri/editdata', $data);
    }

    public function updatedata($id)
    {
        $session = session();
        $simpan = new IndustriModel();
        $Masuk = [
            'idindustri' => $this->request->getVar('idIndustri'),
            'nama_industri' => $this->request->getVar('Nama'),
            'iduser' => $this->request->getVar('pengguna'),
            'nib' => $this->request->getVar('NIB'),
            'sektorusaha' => $this->request->getVar('sektor'),
            'modal' => $this->request->getVar('Modal'),
            'alamat' => $this->request->getVar('alamat'),
            'kbli' => $this->request->getVar('kbli'),
            'kecamatan' => $this->request->getVar('wilayah'),
            'jumlahtenagakerja' => $this->request->getVar('tenagakerja'),
        ];
        // Konversi tipe data input form industri
        $idindustrial = intval($Masuk['idindustri']);
        $namaindustri = $Masuk['nama_industri'];
        $idpengguna1 = intval($Masuk['iduser']);
        $nibuser = $Masuk['nib'];
        $sektorusaha = intval($Masuk['sektorusaha']);
        $alamatindustri = $Masuk['alamat'];
        $kbliusaha = intval($Masuk['kbli']);
        $modalusaha = intval($Masuk['modal']);
        $kecamatanusaha = intval($Masuk['kecamatan']);
        $tenaga = intval($Masuk['jumlahtenagakerja']);

        // Kriteria di luar input
        $modalindustri = 0;
        $skalaindustri = 0;
        $skalausahaindustri = 0;
        $resiko = 0;
        $wilayahindustri = 0;
        $tenagakerja1 = 0;

        // Kumpulan array validasi kbli dan wilayah
        $arraykblirendah = [0, 10311, 10313, 10314, 10330, 10391, 10392, 10423, 10531, 10532, 10611, 10612, 10614, 10615, 10631, 10633, 10634, 10710, 10729, 10733, 10739, 10761, 10762, 10763, 10772, 10774, 10779, 10792, 10793, 10794, 10799, 10801, 10802, 12091, 13134, 16101, 16221, 16292, 16293, 25111, 25112, 25910, 25992, 25993, 31001, 31009];
        $arraykblimenengahrendah = [0, 10130, 10211, 10213, 10214, 10216, 10217, 10219, 10293, 10297, 10298, 10732, 10740, 10750, 10771, 10773, 13912, 13921, 13929, 14302, 14303, 16299, 25920];
        $arraykblimenengahtinggi = [0, 10110, 10120, 10510, 13121, 13122, 13133, 13999, 14111, 14112, 14120, 14131, 14132, 14200, 14301, 16101];
        $arraykblitinggi = [0, 12011, 12013, 12019];
        $arraywilayahkota = [0, 2, 5, 8, 11, 12];
        $arraywilayahtepiankota = [0, 3, 4, 6, 7, 10];
        $arraywilayahterpencil = [0, 1, 9];

        // Validasi KBLI
        $cekkbli1 = array_search($kbliusaha, $arraykblirendah);
        $cekkbli2 = array_search($kbliusaha, $arraykblimenengahrendah);
        $cekkbli3 = array_search($kbliusaha, $arraykblimenengahtinggi);
        $cekkbli4 = array_search($kbliusaha, $arraykblitinggi);

        // Validasi wilayah usaha
        $cekwilayah1 = array_search($kecamatanusaha, $arraywilayahkota);
        $cekwilayah2 = array_search($kecamatanusaha, $arraywilayahtepiankota);
        $cekwilayah3 = array_search($kecamatanusaha, $arraywilayahterpencil);

        // Kondisi wilayah usaha
        if ($cekwilayah1 == true) {
            $wilayahindustri = 25;
        } else {
            if ($cekwilayah2 == true) {
                $wilayahindustri = 24;
            } else {
                if ($cekwilayah3 == true) {
                    $wilayahindustri = 23;
                }
            }
        }

        // Kondisi skala industri
        if ($tenaga < 20) {
            $skalaindustri = 11;
        } else {
            $skalaindustri = 12;
        }

        // Kondisi modal industri 
        if ($modalusaha <= 50000000) {
            $modalindustri = 6;
        } elseif ($modalusaha > 50000000 && $modalusaha <= 100000000) {
            $modalindustri = 7;
        } elseif ($modalusaha > 100000000 && $modalusaha <= 500000000) {
            $modalindustri = 8;
        } elseif ($modalusaha > 500000000 && $modalusaha <= 1000000000) {
            $modalindustri = 9;
        } else {
            $modalindustri = 10;
        }

        // Kondisi Skala Usaha dan resiko usaha
        if ($modalusaha < 1000000000) {
            $skalausahaindustri = 13;
            if ($cekkbli1 == true) {
                $resiko = 15;
            } else {
                if ($cekkbli2 == true) {
                    $resiko = 16;
                } else {
                    if ($cekkbli3 == true) {
                        $resiko = 17;
                    } else {
                        if ($cekkbli4 == true) {
                            $resiko = 18;
                        }
                    }
                }
            }
        } else {
            $skalausahaindustri = 14;
            if ($cekkbli1 == true) {
                $resiko = 15;
            } else {
                if ($cekkbli2 == true) {
                    $resiko = 16;
                } else {
                    if ($cekkbli3 == true) {
                        $resiko = 17;
                    } else {
                        if ($cekkbli4 == true) {
                            $resiko = 18;
                        }
                    }
                }
            }
        }

        // Kondisi jumlah tenaga kerja
        if ($tenaga < 5) {
            $tenagakerja1 = 28;
        } elseif ($tenaga <= 10 && $tenaga >= 5) {
            $tenagakerja1 = 27;
        } else {
            $tenagakerja1 = 26;
        }

        // Data lengkap hasil konversi semua kriteria
        $simpan1 = [
            'idindustri' => $idindustrial,
            'nama_industri' => $namaindustri,
            'iduser' => $idpengguna1,
            'NIB' => $nibuser,
            'sektorusaha' => $sektorusaha,
            'jumlahmodal' => $modalusaha,
            'modal' => $modalindustri,
            'kbli' => $kbliusaha,
            'skalaikm' => $skalaindustri,
            'skalausaha' => $skalausahaindustri,
            'resikousaha' => $resiko,
            // 'jumlahusahaindustri' => $jumlahusahaindustri,
            'alamatusaha' => $alamatindustri,
            'wilayahusaha' => $wilayahindustri,
            'kecamatan' => $kecamatanusaha,
            'tenagakerja' => $tenagakerja1,
            'jumlahtenagakerja' => $tenaga

        ];

        // Proses penyimpanan database
        if ($simpan1 != null) {

            // Eksekusi penyimpanan database
            $simpandata = $simpan->UpdateData($simpan1['idindustri'], $simpan1);

            // Validasi jumlah usaha industri
            $modelperrhitungan = new KalkulasiModel();
            $jumlahusaha = 0;
            $validasijumlah = $simpan->cekjumlahusaha($nibuser);
            $konversi = intval($validasijumlah);

            // Kondisi pengambilan nilai kriteria jumlah usaha yang dimiliki
            if ($konversi != 0) {
                // jika usaha yang dimiliki sebanyak satu buah usaha
                if ($konversi == 1) {
                    // Nilai data kriteria jumlah usaha sebanyak 1 buah
                    $jumlahusaha = 22;

                    // Mengambil ID dan NIB Industri untuk mengecek modal
                    $nib['nib'] = intval($nibuser);
                    $idmodal['industri'] = intval($simpan1['idindustri']);

                    // Mengambil data lengkap industri untuk dikonversi ke dalam bobot
                    $datakonversi = [
                        'sektor' => $sektorusaha,
                        'modal' => $modalindustri,
                        'skalaindustri' => $skalaindustri,
                        'skalausaha' => $skalausahaindustri,
                        'resiko' => $resiko,
                        'wilayah' => $wilayahindustri,
                        'tenaga' => $tenagakerja1,
                        'jumlahusaha' => $jumlahusaha
                    ];

                    // Konversi data industri ke dalam bobot
                    $cekbobot = $simpan->GetWeight($datakonversi);

                    foreach ($cekbobot as $namakolom => $value1) {
                        #Data bobot
                        $databaruu[$namakolom] = $value1[0];
                        #Data id kriteria   
                        $databaruu1[$namakolom] = $value1[1];
                    }

                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $idmodal, $databaruu);

                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $idmodal;
                    }

                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }

                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);

                    // Eksekusi update data tabel perhitungan
                    $eksekusi = $modelperrhitungan->UpdateDataBatch($modifarr);

                    // Kondisi jika terdapat dua buah usaha
                } elseif ($konversi == 2) {
                    // Nilai kriteria jumlah usaha sebanyak 2 buah
                    $jumlahusaha = 21;
                    // Data NIB pengguna
                    $nib['nib'] = intval($nibuser);
                    // Melakukan pengecekan dan pengambilan data modal tertinggi
                    $cekmodalusaha = $simpan->cekmodal($nib['nib']);
                    // inisiasi variabel databaru untuk memasukkan nilai hasil konversi modal
                    $databaru = null;
                    // Pengambilan data  IDindustri dengan modal tertinggi pada tiap kriteria
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            $databaru[$namakolom] = intval($nilaidata);
                            break;
                        }
                    }
                    // Pengambilan data industri modal terbesar berdasarkan masing-masing kriteria dan nilainya
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            continue;
                        }
                        $databaru1[$namakolom] = intval($nilaidata);
                    }
                    // Inisiasi data ID industri
                    $idmodal['id'] = $databaru['idindustri'];
                    // Inisiasi data jumlah usaha
                    $datakonversi = [
                        'jumlahusaha' => $jumlahusaha
                    ];
                    // Penggabungan data lengkap industri untuk konversi nilai kategori menjadi bobot
                    $datagabungan = $databaru1 + $datakonversi;
                    // Pengecekan dan konversi nilai krategori menjadi bobot
                    $cekbobot = $simpan->GetWeight($datagabungan);
                    foreach ($cekbobot as $namakolom => $value1) {
                        #Data bobot
                        $databaruu[$namakolom] = $value1[0];
                        #Data id kriteria   
                        $databaruu1[$namakolom] = $value1[1];
                    }

                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $idmodal, $databaruu);

                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $idmodal;
                    }

                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }

                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(
                        null,
                        $datanib,
                        $dataindustri,
                        $databaruu,
                        $databaruu1
                    );
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);

                    // Eksekusi update data tabel perhitungan
                    $eksekusi = $modelperrhitungan->UpdateDataBatch($modifarr);
                } elseif ($konversi == 3) {
                    // Nilai kriteria jumlah usaha sebanyak 3 buah
                    $jumlahusaha = 20;
                    // Data NIB pengguna
                    $nib['nib'] = intval($nibuser);
                    // Melakukan pengecekan dan pengambilan data modal tertinggi
                    $cekmodalusaha = $simpan->cekmodal($nib['nib']);
                    // inisiasi variabel databaru untuk memasukkan nilai hasil konversi modal
                    $databaru = null;
                    // Pengambilan data  IDindustri dengan modal tertinggi pada tiap kriteria
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            $databaru[$namakolom] = intval($nilaidata);
                            break;
                        }
                    }
                    // Pengambilan data industri modal terbesar berdasarkan masing-masing kriteria dan nilainya
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            continue;
                        }
                        $databaru1[$namakolom] = intval($nilaidata);
                    }
                    // Inisiasi data ID industri
                    $idmodal['id'] = $databaru['idindustri'];
                    // Inisiasi data jumlah usaha
                    $datakonversi = [
                        'jumlahusaha' => $jumlahusaha
                    ];
                    // Penggabungan data lengkap industri untuk konversi nilai kategori menjadi bobot
                    $datagabungan = $databaru1 + $datakonversi;
                    // Pengecekan dan konversi nilai krategori menjadi bobot
                    $cekbobot = $simpan->GetWeight($datagabungan);
                    foreach ($cekbobot as $namakolom => $value1) {
                        #Data bobot
                        $databaruu[$namakolom] = $value1[0];
                        #Data id kriteria   
                        $databaruu1[$namakolom] = $value1[1];
                    }

                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $idmodal, $databaruu);

                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $idmodal;
                    }

                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }

                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(
                        null,
                        $datanib,
                        $dataindustri,
                        $databaruu,
                        $databaruu1
                    );
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);

                    // Eksekusi update data tabel perhitungan
                    $eksekusi = $modelperrhitungan->UpdateDataBatch($modifarr);
                } else {
                    // Kondisi jumlah usaha lebih dari 3 buah usaha
                    $jumlahusaha = 19;
                    // Data NIB pengguna
                    $nib['nib'] = intval($nibuser);
                    // Melakukan pengecekan dan pengambilan data modal tertinggi
                    $cekmodalusaha = $simpan->cekmodal($nib['nib']);
                    // inisiasi variabel databaru untuk memasukkan nilai hasil konversi modal
                    $databaru = null;
                    // Pengambilan data  IDindustri dengan modal tertinggi pada tiap kriteria
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            $databaru[$namakolom] = intval($nilaidata);
                            break;
                        }
                    }
                    // Pengambilan data industri modal terbesar berdasarkan masing-masing kriteria dan nilainya
                    foreach ($cekmodalusaha as $namakolom => $nilaidata) {
                        if ($namakolom == 'idindustri') {
                            continue;
                        }
                        $databaru1[$namakolom] = intval($nilaidata);
                    }
                    // Inisiasi data ID industri
                    $idmodal['id'] = $databaru['idindustri'];
                    // Inisiasi data jumlah usaha
                    $datakonversi = [
                        'jumlahusaha' => $jumlahusaha
                    ];
                    // Penggabungan data lengkap industri untuk konversi nilai kategori menjadi bobot
                    $datagabungan = $databaru1 + $datakonversi;
                    // Pengecekan dan konversi nilai krategori menjadi bobot
                    $cekbobot = $simpan->GetWeight($datagabungan);
                    foreach ($cekbobot as $namakolom => $value1) {
                        #Data bobot
                        $databaruu[$namakolom] = $value1[0];
                        #Data id kriteria   
                        $databaruu1[$namakolom] = $value1[1];
                    }

                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $idmodal, $databaruu);

                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $idmodal;
                    }

                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }

                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);

                    // Eksekusi update data tabel perhitungan
                    $eksekusi = $modelperrhitungan->UpdateDataBatch($modifarr);
                }
            } else {
                // Jumlah usaha sebanyak satu buah usaha
                $jumlahusaha = 22;
                // Mengambil ID dan NIB Industri untuk mengecek modal
                $nib['nib'] = intval($nibuser);
                $idmodal['industri'] = intval($simpan1['idindustri']);

                // Mengambil data lengkap industri untuk dikonversi ke dalam bobot
                $datakonversi = [
                    'sektor' => $sektorusaha,
                    'modal' => $modalindustri,
                    'skalaindustri' => $skalaindustri,
                    'skalausaha' => $skalausahaindustri,
                    'resiko' => $resiko,
                    'wilayah' => $wilayahindustri,
                    'tenaga' => $tenagakerja1,
                    'jumlahusaha' => $jumlahusaha
                ];

                // Konversi data industri ke dalam bobot
                $cekbobot = $simpan->GetWeight($datakonversi);
                foreach ($cekbobot as $namakolom => $value1) {
                    #Data bobot
                    $databaruu[$namakolom] = $value1[0];
                    #Data id kriteria   
                    $databaruu1[$namakolom] = $value1[1];
                }

                // pemasangan  array dengan komponen NIB dan ID industri
                $arraybaru = array_map(null, $nib, $idmodal, $databaruu);

                // Pembuatan array NIB untuk banyak baris pasangan array
                foreach ($arraybaru as $pair) {
                    $arraynib[] = $pair[0]['nib'] ?? $nib;
                    $arrayindustri[] = $pair[1]['industri'] ?? $idmodal;
                }

                // Pengaksesan nilai NIB dan ID industri
                #NIB 
                foreach ($arraynib as $barisnib => $komponennib) {
                    foreach ($komponennib as $nilainib) {
                        $datanib[] = $nilainib;
                    }
                }
                #ID Industri
                foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                    foreach ($komponenindustri as $nilaiindustri) {
                        $dataindustri[] = $nilaiindustri;
                    }
                }

                // Pemasangan nilai NIB dengan array pasangan
                $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                // Membuat nama kolom array agar tidak indeks 0,1,2,....
                $modifarr = array_map(function ($row) {
                    return [
                        'nib' => $row[0],
                        'idindustri' => $row[1],
                        'bobot' => $row[2],
                        'idkriteria' => $row[3]
                    ];
                }, $arraylengkap);

                // Eksekusi update data tabel perhitungan
                $eksekusi = $modelperrhitungan->UpdateDataBatch($modifarr);
            }


            if ($simpandata == true) {
                session()->setFlashdata('pesan3', 'Data berhasil diedit');
                return redirect()->to('/industry');
            } else {
                echo print_r($simpan->errors());
            }
        } else {
            session()->setFlashdata('pesan4', 'Data industri kosong');
            return redirect()->to('/industry');
        }
    }

    public function delete($idkrit)
    {
        // Jika memiliki satu buah usaha
        $modelindustri = new IndustriModel();
        $modelperhitungan = new KalkulasiModel();
        $tindakan = $modelindustri->getIndustryByID($idkrit);
        $cekjumlahusaha = $modelindustri->cekjumlahusaha($tindakan['NIB']);
        $jumlah = intval($cekjumlahusaha);
        $banyakindustri = 0;
        if ($jumlah == 1) {
            // $hapusdataperhitungan = $modelperhitungan->deleteCalculation($tindakan['NIB']);
            $hapus = $this->industriModel->delete($idkrit);
            if ($hapus == true) {
                session()->setFlashdata('pesan1', 'Data berhasil dihapus');
                return redirect()->to('/industry');
            }
        } else {
            if ($jumlah == 2) {
                $dataid = null;
                $cekmodal = $modelindustri->cekmodal2($tindakan['NIB'], $idkrit);
                // dd($cekmodal);
                foreach ($cekmodal as $namakolom => $value) {
                    if ($namakolom == 'idindustri') {
                        continue;
                    }
                    $datasebelum[$namakolom] = intval($value);
                }
                foreach ($cekmodal as $namakolom => $value) {
                    if ($namakolom == 'idindustri') {
                        $dataid[$namakolom] = intval($value);
                        break;
                    }
                }
                // Jumlah industri setelah dikurangi
                $cekjumlah = $modelindustri->cekjumlahusaha2($tindakan['NIB'], $idkrit);

                if ($cekjumlah == '1') {
                    $nib['nib'] = intval($tindakan['NIB']);
                    $id['id'] = $dataid['idindustri'];

                    $banyakindustri = 22;
                    $datajumlah = [
                        "jumlahusaha" => $banyakindustri
                    ];
                    $datagabungan = $datasebelum + $datajumlah;
                    $konversi = $modelindustri->GetWeight($datagabungan);

                    foreach ($konversi as $namakolom => $value1) {
                        $databaruu[$namakolom] = $value1[0];
                        $databaruu1[$namakolom] = $value1[1];
                    }
                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $id, $databaruu);
                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $id;
                    }
                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }
                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);

                    // dd($datalengkap);
                    $updateperhitungan = $modelperhitungan->UpdateDataBatch($modifarr);
                    $hapus = $this->industriModel->delete($idkrit);
                    if ($hapus == true) {
                        session()->setFlashdata('pesan1', 'Data berhasil dihapus');
                        return redirect()->to('/industry');
                    }
                }
            } elseif ($jumlah == 3) {

                $dataid = null;
                $cekmodal = $modelindustri->cekmodal2($tindakan['NIB'], $idkrit);

                foreach ($cekmodal as $namakolom => $value) {
                    if ($namakolom == 'idindustri') {
                        continue;
                    }
                    $datasebelum[$namakolom] = intval($value);
                }
                foreach ($cekmodal as $namakolom => $value) {
                    if ($namakolom == 'idindustri') {
                        $dataid[$namakolom] = intval($value);
                        break;
                    }
                }
                // Jumlah industri setelah dikurangi
                $cekjumlah = $modelindustri->cekjumlahusaha2($tindakan['NIB'], $idkrit);
                if ($cekjumlah == '2') {
                    $nib['nib'] = intval($tindakan['NIB']);
                    $id['id'] = $dataid['idindustri'];

                    $banyakindustri = 21;
                    $datajumlah = [
                        "jumlahusaha" => $banyakindustri
                    ];
                    $datagabungan = $datasebelum + $datajumlah;
                    $konversi = $modelindustri->GetWeight($datagabungan);
                    foreach ($konversi as $namakolom => $value1) {
                        $databaruu[$namakolom] = $value1[0];
                        $databaruu1[$namakolom] = $value1[1];
                    }
                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $id, $databaruu);
                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $id;
                    }
                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }
                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);

                    // dd($datalengkap);
                    $updateperhitungan = $modelperhitungan->UpdateDataBatch($modifarr);
                    $hapus = $this->industriModel->delete($idkrit);
                    if ($hapus == true) {
                        session()->setFlashdata('pesan1', 'Data berhasil dihapus');
                        return redirect()->to('/industry');
                    }
                }
            } elseif ($jumlah == 4) {
                $dataid = null;
                $cekmodal = $modelindustri->cekmodal2($tindakan['NIB'], $idkrit);

                foreach ($cekmodal as $namakolom => $value) {
                    if ($namakolom == 'idindustri') {
                        continue;
                    }
                    $datasebelum[$namakolom] = intval($value);
                }
                foreach ($cekmodal as $namakolom => $value) {
                    if ($namakolom == 'idindustri') {
                        $dataid[$namakolom] = intval($value);
                        break;
                    }
                }
                // Jumlah industri setelah dikurangi
                $cekjumlah = $modelindustri->cekjumlahusaha2($tindakan['NIB'], $idkrit);
                if ($cekjumlah == '3') {
                    $nib['nib'] = intval($tindakan['NIB']);
                    $id['id'] = $dataid['idindustri'];

                    $banyakindustri = 20;
                    $datajumlah = [
                        "jumlahusaha" => $banyakindustri
                    ];
                    $datagabungan = $datasebelum + $datajumlah;
                    $konversi = $modelindustri->GetWeight($datagabungan);
                    foreach ($konversi as $namakolom => $value1) {
                        $databaruu[$namakolom] = $value1[0];
                        $databaruu1[$namakolom] = $value1[1];
                    }
                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $id, $databaruu);
                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $id;
                    }
                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }
                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);

                    $updateperhitungan = $modelperhitungan->UpdateDataBatch($modifarr);
                    $hapus = $this->industriModel->delete($idkrit);
                    if ($hapus == true) {
                        session()->setFlashdata('pesan1', 'Data berhasil dihapus');
                        return redirect()->to('/industry');
                    }
                }
            } else {
                $dataid = null;
                $cekmodal = $modelindustri->cekmodal2($tindakan['NIB'], $idkrit);

                foreach ($cekmodal as $namakolom => $value) {
                    if ($namakolom == 'idindustri') {
                        continue;
                    }
                    $datasebelum[$namakolom] = intval($value);
                }
                foreach ($cekmodal as $namakolom => $value) {
                    if ($namakolom == 'idindustri') {
                        $dataid[$namakolom] = intval($value);
                        break;
                    }
                }
                // Jumlah industri setelah dikurangi
                $cekjumlah = $modelindustri->cekjumlahusaha2($tindakan['NIB'], $idkrit);
                $banyak = intval($cekjumlah);
                if ($banyak > 3) {
                    $nib['nib'] = intval($tindakan['NIB']);
                    $id['id'] = $dataid['idindustri'];

                    $banyakindustri = 19;
                    $datajumlah = [
                        "jumlahusaha" => $banyakindustri
                    ];
                    $datagabungan = $datasebelum + $datajumlah;
                    $konversi = $modelindustri->GetWeight($datagabungan);
                    foreach ($konversi as $namakolom => $value1) {
                        $databaruu[$namakolom] = $value1[0];
                        $databaruu1[$namakolom] = $value1[1];
                    }
                    // pemasangan  array dengan komponen NIB dan ID industri
                    $arraybaru = array_map(null, $nib, $id, $databaruu);
                    // Pembuatan array NIB untuk banyak baris pasangan array
                    foreach ($arraybaru as $pair) {
                        $arraynib[] = $pair[0]['nib'] ?? $nib;
                        $arrayindustri[] = $pair[1]['industri'] ?? $id;
                    }
                    // Pengaksesan nilai NIB dan ID industri
                    #NIB 
                    foreach ($arraynib as $barisnib => $komponennib) {
                        foreach ($komponennib as $nilainib) {
                            $datanib[] = $nilainib;
                        }
                    }
                    #ID Industri
                    foreach ($arrayindustri as $barisindustri => $komponenindustri) {
                        foreach ($komponenindustri as $nilaiindustri) {
                            $dataindustri[] = $nilaiindustri;
                        }
                    }
                    // Pemasangan nilai NIB dengan array pasangan
                    $arraylengkap = array_map(null, $datanib, $dataindustri, $databaruu, $databaruu1);
                    // Membuat nama kolom array agar tidak indeks 0,1,2,....
                    $modifarr = array_map(function ($row) {
                        return [
                            'nib' => $row[0],
                            'idindustri' => $row[1],
                            'bobot' => $row[2],
                            'idkriteria' => $row[3]
                        ];
                    }, $arraylengkap);
                    // dd($datalengkap);
                    $updateperhitungan = $modelperhitungan->UpdateDataBatch($modifarr);
                    $hapus = $this->industriModel->delete($idkrit);
                    if ($hapus == true) {
                        session()->setFlashdata('pesan1', 'Data berhasil dihapus');
                        return redirect()->to('/industry');
                    }
                }
            }
        }
    }


    public function notifikasi()
    {
        $industriModel = new RequestModel();
        $datarequest = $industriModel->request_industry_admin();
        // dd($datarequest);   
        $data = [
            'judul' => 'Laman Request Data Industri Kreatif | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'request' => $datarequest
        ];

        return view('/admin/industri/notifikasiindustri', $data);
    }

    public function lihatrequest($idreq) {
        $modelReq = new RequestModel();
        $action_ubah = $modelReq->req_reads($idreq);
        $datarequest = $modelReq->req_check($idreq);
        $data = [
            'judul' => 'Laman Request Data Industri Kreatif | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'request' => $datarequest
        ];

        return view('/admin/industri/accrequest', $data);

    }

    public function confirmreq(){
        $datainput = [
            'idreq' => $this->request->getVar('idreq'),
            'subject_req' => $this->request->getVar('subject')
        ];
        $modelReq = new RequestModel();
        $action_confirm = $modelReq->acc_req($datainput['idreq']);

        if ($action_confirm=true) {
            if ($datainput['subject_req']=='request_industri') {
                $action_send = $modelReq->copy_industry_data();
                $session = session();
                $session->setFlashdata('pesan', 'Request ACC data industri berhasil');
                return redirect()->to('/industry/notifikasi');
            }elseif ($datainput['subject_req']=='request_perhitungan') {
                $action_send = $modelReq->copy_calculate_data();
                $session = session();
                $session->setFlashdata('pesan', 'Request ACC data perhitungan berhasil');
                return redirect()->to('/notifikasi-hitung');
            }else {
                $action_send = $modelReq->copy_ranking_data();
                $session = session();
                $session->setFlashdata('pesan', 'Request ACC data industri berhasil');
                return redirect()->to('/industry/notifikasi');
            }
        }
    }
}
