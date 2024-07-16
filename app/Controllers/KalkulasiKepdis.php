<?php

namespace App\Controllers;

use App\Models\IndustriModel;
use App\Models\KriteriaModel;
use App\Models\KalkulasiModel;
use App\Models\RequestModel;
use App\Models\KategoriModel;

class KalkulasiKepdis extends BaseController
{

    public function entropy()
    {
        #Model
        $KalkulasiModel = new KalkulasiModel();
        $KriteriaModel = new KriteriaModel();
        #Variabel inisiasi model
        $kolom = $KalkulasiModel->getCriteriaName1();
        $databobot = $KalkulasiModel->Weight();
        $dataID = $KalkulasiModel->IDNIB();
        $dataKriteria = $KriteriaModel->getAllCriteria();

        $perpindahanelemen = $kolom[2];
        unset($kolom[2]);
        array_splice($kolom, 7, 0, [$perpindahanelemen]);


        #>>>Tabel data kriteria<<<#
        $arraykriteria = array();
        // Perulangan data kriteria
        foreach ($dataKriteria as $bariskriteria) {
            if (isset($arraykriteria[$bariskriteria['id_kriteria']])) {
                $arraykriteria[$bariskriteria['id_kriteria']] = array();
            }
            $arraykriteria[$bariskriteria['id_kriteria']] =
                array(
                    $bariskriteria['nama_kriteria'],
                    $bariskriteria['attribute_kriteria'],
                    $bariskriteria['bobot_kriteria']
                );
        }
        $datalengkapkriteria = $arraykriteria;

        #>>>Tabel data bobot<<<#
        $arraybobot = array();
        // Perulangan data bobot
        foreach ($databobot as $baris) {
            if (!isset($arraybobot[$baris['nib']])) {
                $arraybobot[$baris['nib']] = array();
            }
            $arraybobot[$baris['nib']][$baris['idkriteria']] = $baris['bobot'];
        }
        $DataBobot = $arraybobot;

        #>>>Tabel Evaluasi<<<#
        $arraylengkap = [];
        // Perulangan Tabel Evaluasi
        foreach ($dataID as $nilaiarrayIDNIB) {
            $dataNIB = $nilaiarrayIDNIB['NIB'];
            if (isset($DataBobot[$dataNIB])) {
                $arraylengkap[$dataNIB] = array_merge($nilaiarrayIDNIB, $DataBobot[$dataNIB]);
            }
        }

        #>>>Tabel data kriteria <<<#
        $datalengkapkriteria = array();
        foreach ($dataKriteria as $bariskriteria) {
            $id_kriteria = $bariskriteria['id_kriteria'];
            $datalengkapkriteria[$id_kriteria] = array(
                $bariskriteria['nama_kriteria'],
                $bariskriteria['attribute_kriteria'],
                $bariskriteria['bobot_kriteria']
            );
        }
        #>>> Tabel kriteria index 0 <<< #
        $datakrit = [];
        foreach ($dataKriteria as  $value) {
            $datakrit[$value['id_kriteria']]  = array(
                $value['id_kriteria'],
                $value['nama_kriteria'],
                $value['attribute_kriteria'],
                $value['bobot_kriteria']
            );
        }

        # >>> Array data bobot awal kriteria <<< #
        $databobotawal = [];
        foreach ($dataKriteria as  $value) {
            $databobotawal[$value['id_kriteria']]  = doubleval($value['bobot_kriteria']);
        }
        // dd($databobotawal);
        $keypindah = '3';
        $posisi = 8;
        if (array_key_exists($keypindah, $databobotawal)) {
            $nilaipindah = $databobotawal[$keypindah];
            unset($databobotawal[$keypindah]);

            $databobotawal = array_slice($databobotawal, 0, $posisi, true) +
                [$keypindah => $nilaipindah] +
                array_slice($databobotawal, $posisi, null, true);
        }

        // $perpindahanelemen1 = $databobotawal[3];
        // unset($databobotawal[3]);
        // array_splice(
        //     $databobotawal,
        //     8,
        //     0,
        //     [$perpindahanelemen1]
        // );

        # >>> Tabel data bobot tabel evaluasi <<< #
        $DataBobot = array();
        foreach ($databobot as $baris) {
            $DataBobot[$baris['nib']][$baris['idkriteria']] = $baris['bobot'];
        }

        // Variabel jumlah alternatif
        $jumlahalternatif = [];
        // Perulangan menghitung banyak data industri berdasarkan NIB
        foreach ($DataBobot as $nibindustri => $arraynibindustri) {
            $jumlahalternatif[$nibindustri] = $nibindustri;
        }
        $banyakalternatif = count($jumlahalternatif);

        // Variabel array maksimal dan minimal
        $arraymin = [];
        $arraymaks = [];
        // Perulangan pengelompokan ID kriteria berdasarkan tipe attribute kriteria
        foreach ($datakrit as $krit => $k) {
            if ($k[2] == "Benefit") {
                $arraymaks[] = $k[0];
            } else {
                $arraymin[] = $k[0];
            }
        }
        // Variabel data array dengan nilai default
        $minval = array_fill_keys($arraymin, PHP_INT_MAX);
        $maxval = array_fill_keys($arraymaks, PHP_INT_MIN);
        // Perulangan pencarian data kompoonen maksimal dan minimal pada tabel bobot
        foreach ($DataBobot as $data) {
            // Cari nilai minimum
            foreach ($minval as $key => $minValue) {
                $minval[$key] = min($minValue, $data[$key]);
            }
            // Cari nilai maksimum
            foreach ($maxval as $key => $maxValue) {
                $maxval[$key] = max($maxValue, $data[$key]);
            }
        }

        #>>> Tabel normalisasi tabel evaluasi <<<#
        $nilainormalisasi = array();
        foreach ($DataBobot as $nibindus => $arraynib) {
            foreach ($arraynib as $kolombobot => $nilaibobot) {
                foreach ($maxval as $key => $value) {
                    if ($kolombobot == $key) {
                        if (!isset($nilainormalisasi[$nibindus][$kolombobot])) {
                            $nilainormalisasi[$nibindus][$kolombobot] = 0;
                        }
                        $nilainormalisasi[$nibindus][$kolombobot] += $nilaibobot / $value;
                    }
                }

                foreach ($minval as $key => $value) {
                    if ($kolombobot == $key) {
                        if (!isset($nilainormalisasi[$nibindus][$kolombobot])) {
                            $nilainormalisasi[$nibindus][$kolombobot] = 0;
                        }
                        $nilainormalisasi[$nibindus][$kolombobot] += $value / $nilaibobot;
                    }
                }
            }
        }

        $arraylengkap1 = [];
        // Perulangan Tabel normaliasi
        foreach ($dataID as $nilaiarrayIDNIB) {
            $dataNIB = $nilaiarrayIDNIB['NIB'];
            if (isset($nilainormalisasi[$dataNIB])) {
                $arraylengkap1[$dataNIB] = array_merge($nilaiarrayIDNIB, $nilainormalisasi[$dataNIB]);
            }
        }

        // dd($DataBobot, $arraylengkap, $arraylengkap1);
        #>>> Tabel penjumlahan kolom kriteria setelah proses normalisasi <<<#
        $jumlahnormalisasi = [];
        foreach ($nilainormalisasi as $nibindus1 => $arraynib) {
            foreach ($arraynib as $kolombobotnormalisasi => $nilaibobotnormalisasi) {
                $jumlahnormalisasi[$kolombobotnormalisasi] = isset($jumlahnormalisasi[$kolombobotnormalisasi]) ? 0 : 0;
                $jumlahnormalisasi[$kolombobotnormalisasi] += array_sum(array_column($nilainormalisasi, $kolombobotnormalisasi));
            }
        }

        #>>> Tabel matriks probailitas <<<#
        $matriksprobabilitas = [];
        foreach ($nilainormalisasi as $nibindus => $arraynib) {
            foreach ($arraynib as $kolombobotnormalisasi => $nilaibobotnormalisasi) {

                foreach ($jumlahnormalisasi as $kolomnormalisasi => $hasiljumlahnormalisasikolom) {
                    if (!isset($matriksprobabilitas[$nibindus][$kolombobotnormalisasi])) {
                        $matriksprobabilitas[$nibindus][$kolombobotnormalisasi] = 0;
                    }
                    if ($kolombobotnormalisasi == $kolomnormalisasi) {
                        $matriksprobabilitas[$nibindus][$kolombobotnormalisasi] += $nilaibobotnormalisasi / $hasiljumlahnormalisasikolom;
                    }
                }
            }
        }

        $arraylengkap2 = [];
        // Perulangan Tabel Probabilitas
        foreach ($dataID as $nilaiarrayIDNIB) {
            $dataNIB = $nilaiarrayIDNIB['NIB'];
            if (isset($matriksprobabilitas[$dataNIB])) {
                $arraylengkap2[$dataNIB] = array_merge($nilaiarrayIDNIB, $matriksprobabilitas[$dataNIB]);
            }
        }
        // dd($arraylengkap2);

        #>>> Tabel matriks nilai entropy tiap kriteria <<<#
        $matriksentropytiapkriteria = [];
        foreach ($matriksprobabilitas as $nibindus => $arraynib) {
            foreach ($arraynib as $kolomprobabilitas => $nilaiprobabilitas) {
                if (!isset($matriksentropytiapkriteria[$nibindus][$kolomprobabilitas])) {
                    $matriksentropytiapkriteria[$nibindus][$kolomprobabilitas] = 0;
                }
                $matriksentropytiapkriteria[$nibindus][$kolomprobabilitas] += $nilaiprobabilitas * (log($nilaiprobabilitas));
            }
        }

        $arraylengkap3 = [];
        // Perulangan Tabel Probabilitas
        foreach ($dataID as $nilaiarrayIDNIB) {
            $dataNIB = $nilaiarrayIDNIB['NIB'];
            if (isset($matriksentropytiapkriteria[$dataNIB])) {
                $arraylengkap3[$dataNIB] = array_merge($nilaiarrayIDNIB, $matriksentropytiapkriteria[$dataNIB]);
            }
        }
        // dd($arraylengkap3);

        #>>> Tabel jumlah nilai entropy pada masing-masing kolom kriteria <<<#
        $jumlahnilaientropy = [];
        foreach ($matriksentropytiapkriteria as $nibindus => $arraynib) {
            foreach ($arraynib as $kolomentropykriteria => $nilaimatriksentropy) {
                $jumlahnilaientropy[$kolomentropykriteria] = isset($jumlahnilaientropy[$kolomentropykriteria]) ? 0 : 0;
                $jumlahnilaientropy[$kolomentropykriteria] += array_sum(array_column($matriksentropytiapkriteria, $kolomentropykriteria));
            }
        }

        #>>> Tabel bobot entropy pada masing-masing kolom kriteria <<<#
        $perhitunganbobotentropy = [];
        foreach ($jumlahnilaientropy as $kolomnilaientropy => $nilaientropy) {
            if (!isset($perhitunganbobotentropy[$kolomnilaientropy])) {
                $perhitunganbobotentropy[$kolomnilaientropy] = 0;
            }
            $perhitunganbobotentropy[$kolomnilaientropy] += - (1 / log($banyakalternatif)) * $nilaientropy;
        }

        #>>> Variabel jumlah seluruh nilai bobot entropy <<<#
        $jumlahperhitunganbobotenropy = 0;
        $jumlahperhitunganbobotenropy = array_sum($perhitunganbobotentropy);

        #>>> Tabel nilai deviasi entropy <<<#
        $nilaideviasientropy = [];
        foreach ($perhitunganbobotentropy as $kolomhasilperhitunganbobot => $nilaihasilbobotentropy) {
            if (!isset($nilaideviasientropy[$kolomhasilperhitunganbobot])) {
                $nilaideviasientropy[$kolomhasilperhitunganbobot] = 0;
            }
            $nilaideviasientropy[$kolomhasilperhitunganbobot] = 1 - $nilaihasilbobotentropy;
        }

        #>>> Variabel jumlah seluruh nilai deviasi <<<#
        $jumlahnilaideviasi = 0;
        $jumlahnilaideviasi = array_sum($nilaideviasientropy);

        #>>> Tabel nilai lamda entropy <<<#
        $nilailamdaentropy = [];
        foreach ($nilaideviasientropy as $kolomdeviasi => $nilaideviasi) {
            if (!isset($nilailamdaentropy[$kolomdeviasi])) {
                $nilailamdaentropy[$kolomdeviasi] = 0;
            }
            $nilailamdaentropy[$kolomdeviasi] += (1 / ($banyakalternatif - $jumlahperhitunganbobotenropy)) * $nilaideviasi;
        }

        #>>> Jumlah seluruh nilai lamda entropy <<<#
        $jumlahnilailamda = 0;
        $jumlahnilailamda = array_sum($nilailamdaentropy);

        #>>> Matriks perkalian nilai lamda dengan bobot awal kriteria <<<#
        $perkalianlamdadanbobotawal = [];
        foreach ($nilailamdaentropy as $kolomnilailamda => $nilailamda) {
            foreach ($databobotawal as $kolomkriteria => $nilaibobotawal) {
                if (!isset($perkalianlamdadanbobotawal[$kolomnilailamda])) {
                    $perkalianlamdadanbobotawal[$kolomnilailamda] = 0;
                }
                if ($kolomnilailamda == $kolomkriteria) {
                    $perkalianlamdadanbobotawal[$kolomnilailamda] += $nilailamda * $nilaibobotawal;
                }
            }
        }
        // dd($nilailamdaentropy, $databobotawal, $perkalianlamdadanbobotawal);
        #>>> Jumlah seluruh nilai hasil perkalian <<<#
        $jumlahhasilperkalianbobotawal = 0;
        $jumlahhasilperkalianbobotawal = array_sum($perkalianlamdadanbobotawal);

        #>>> Tabel bobot akhir entropy <<<#
        $bobotakhirentropy = [];
        foreach ($perkalianlamdadanbobotawal as $kolomperkalianbobot => $nilaihasilperkalianbobot) {
            if (!isset($jumlahhasilperkalianbobotawal[$kolomperkalianbobot])) {
                $bobotakhirentropy[$kolomperkalianbobot] = 0;
            }
            $bobotakhirentropy[$kolomperkalianbobot] += $nilaihasilperkalianbobot / $jumlahhasilperkalianbobotawal;
        }

        #>>> Jumlah bobot akhir entropy <<<#
        $jumlahbobotakhir = 0;
        $jumlahbobotakhir = array_sum($bobotakhirentropy);

        $aksi = $KalkulasiModel->cekbobotakhir();
        if ($aksi == true) {
            $aksi1 = $KalkulasiModel->truncatebobot();

            $datakosong = [];
            foreach ($bobotakhirentropy as $kolomkriteria => $value) {
                $a[] = $kolomkriteria;
                $b[] = doubleval($value);
            }
            $datakosong = array_map(null, $a, $b);
            $datainput = array_map(function ($row) {
                return [
                    'id_kriteria' => $row[0],
                    'bobotakhir' => $row[1]
                ];
            }, $datakosong);

            $aksi2 = $KalkulasiModel->tambahbobotakhir($datainput);
        } else {
            $datakosong = [];
            foreach ($bobotakhirentropy as $kolomkriteria => $value) {
                $a[] = $kolomkriteria;
                $b[] = doubleval($value);
            }
            $datakosong = array_map(null, $a, $b);
            $datainput = array_map(function ($row) {
                return [
                    'id_kriteria' => $row[0],
                    'bobotakhir' => $row[1]
                ];
            }, $datakosong);

            $aksi3 = $KalkulasiModel->tambahbobotakhir($datainput);
        }

        $data = [
            'judul' => 'Laman Metode Entropy | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'datatabel' => $arraylengkap,
            'kolom' => $kolom,
            'tabelnormalisasi' => $arraylengkap1,
            'jumlahnormalisasi' => $jumlahnormalisasi,
            'probabilitas' => $arraylengkap2,
            'entropykriteria' => $arraylengkap3,
            'jumlahentropykriteria' => $jumlahnilaientropy,
            'perhitunganbobotentropy' => $perhitunganbobotentropy,
            'deviasi' => $nilaideviasientropy,
            'jumlahdeviasi' => $jumlahnilaideviasi,
            'lamda' => $nilailamdaentropy,
            'jumlahlamda' => $jumlahnilailamda,
            'bobotawal' => $databobotawal,
            'hasilkalibobot' => $perkalianlamdadanbobotawal,
            'jumlahhasilkalibobot' => $jumlahhasilperkalianbobotawal,
            'bobotakhirentropy' => $bobotakhirentropy,
            'jumlahbobotakhirentropy' => $jumlahbobotakhir

        ];

        return view('/admin/kalkulasi/entropy', $data);
    }

    public function moora()
    {

        // Model
        $Modelkalkulasi = new KalkulasiModel();
        $Modelindustri = new IndustriModel();
        $Modelkriteria = new KriteriaModel();

        // Variabel data 
        $TabelBobotAwal = $Modelkalkulasi->GetEntropyWeight();
        $TabelKriteria = $Modelkriteria->getAllCriteria();
        $TabelIndustri = $Modelindustri->getIndustryData();
        $KolomTabel = $Modelkalkulasi->getCriteriaName1();
        $TabelBobot = $Modelkalkulasi->Weight();
        $dataID = $Modelkalkulasi->IDNIB();


        $perpindahanelemen = $KolomTabel[2];
        unset($KolomTabel[2]);
        array_splice(
            $KolomTabel,
            7,
            0,
            [$perpindahanelemen]
        );
    
        #Tabel bobot entropy
        $Bobotentropy = [];
        foreach ($TabelBobotAwal as  $nilaibobot) {
            $Bobotentropy[$nilaibobot['id_kriteria']] = array($nilaibobot['id_kriteria'], $nilaibobot['bobotakhir']);
        }

        $BobotEvaluasi = [];
        foreach ($TabelBobot as $nilaibobot) {
            if (!isset($BobotEvaluasi[$nilaibobot['nib']])) {
                $BobotEvaluasi[$nilaibobot['nib']] = array();
            }
            $BobotEvaluasi[$nilaibobot['nib']][$nilaibobot['idkriteria']] = $nilaibobot['bobot'];
        }
        $kriteria = [];
        foreach ($TabelKriteria as $baristabel) {
            if (!isset($kriteria[$baristabel['id_kriteria']])) {
                $kriteria[$baristabel['id_kriteria']] = array();
            }
            $kriteria[$baristabel['id_kriteria']]  = array(
                $baristabel['id_kriteria'],
                $baristabel['nama_kriteria'],
                $baristabel['attribute_kriteria'],
                $baristabel['bobot_kriteria']
            );
        }

        $alternatif = [];
        foreach ($TabelIndustri as $baristabel) {
            if (!isset($alternatif[$baristabel['NIB']])) {
                $alternatif[$baristabel['NIB']] = array();
            }
            $alternatif[$baristabel['NIB']]  = array(
                $baristabel['ID_Industri'],
                $baristabel['Nama_Industri'],
                $baristabel['Nama_Pengguna'],
                $baristabel['Sektor_Usaha'],
                $baristabel['Jumlah_Modal'],
                $baristabel['Modal'],
                $baristabel['ID_KBLI'],
                $baristabel['Nama_Kegiatan'],
                $baristabel['Skala_IKM'],
                $baristabel['Skala_Usaha'],
                $baristabel['Resiko_Usaha'],
                $baristabel['Alamat_Usaha'],
                $baristabel['Kecamatan'],
                $baristabel['Wilayah_Usaha'],
                $baristabel['Jumlah_Tenaga_Kerja'],
                $baristabel['Tenaga_Kerja'],

            );
        }

        $arraylengkap = [];
        foreach ($kriteria as $id_kriteria => $nilaibariskriteria) {

            foreach ($dataID as $nilaiarrayIDNIB) {
                $dataNIB = $nilaiarrayIDNIB['NIB'];
                if (isset($BobotEvaluasi[$dataNIB])) {
                    $arraylengkap[$dataNIB] = array_merge($nilaiarrayIDNIB, $BobotEvaluasi[$dataNIB]);
                }
            }
        }

        $normalisasi = $BobotEvaluasi;
        $jumlahpembagi = [];
        foreach ($kriteria as $id_kriteria => $baristabel) {
            $pembagi = 0;
            foreach ($alternatif as $id_alternatif => $a) {
                $pembagi += pow($BobotEvaluasi[$id_alternatif][$id_kriteria], 2);
                $jumlahpembagi[$id_kriteria] = $pembagi;
            }

            foreach ($alternatif as $id_alternatif => $a) {
                $normalisasi[$id_alternatif][$id_kriteria] /= sqrt($pembagi);
            }
        }

        $perpindahanelemen2 = $jumlahpembagi[3];
        unset($jumlahpembagi[3]);
        array_splice(
            $jumlahpembagi,
            8,
            0,
            [$perpindahanelemen2]
        );

        $arraylengkap1 = [];
        foreach ($kriteria as $id_kriteria => $nilaibariskriteria) {

            foreach ($dataID as $nilaiarrayIDNIB) {
                $dataNIB = $nilaiarrayIDNIB['NIB'];
                if (isset($normalisasi[$dataNIB])) {
                    $arraylengkap1[$dataNIB] = array_merge($nilaiarrayIDNIB, $normalisasi[$dataNIB]);
                }
            }
        }

        $arraybenefit = [];
        $arraycost = [];

        foreach ($kriteria as $nilai) {
            if ($nilai[2] == "Benefit") {
                $arraybenefit[] = $nilai[0];
            } else {
                $arraycost[] = $nilai[0];
            }
        }

        $benefit = array_fill_keys($arraybenefit, PHP_INT_MAX);
        $cost = array_fill_keys($arraycost, PHP_INT_MIN);

        foreach ($Bobotentropy as $vals) {
            foreach ($benefit as $benefitkey => $valuebenefit) {
                if ($benefitkey == $vals[0]) {
                    $benefit[$benefitkey] = $vals[1];
                }
            }
            foreach ($cost as $costkey => $costvalue) {
                if ($costkey == $vals[0]) {
                    $cost[$costkey] = $vals[1];
                }
            }
        }

        $optimasi = [];
        $optimasi1 = [];
        $nilai1 = [];
        $nilai2 = [];
        $nilai3 = [];
        $tabelymaks = [];
        $tabelymin = [];
        $tabelygab = [];

        foreach ($alternatif as $nib => $nilaialternatif) {
            $optimasi[$nib] = 0;
            $optimasi1[$nib] = 0;

            foreach ($benefit as $benefitkey => $valuebenefit) {
                $optimasi[$nib] += ($normalisasi[$nib][$benefitkey] * $valuebenefit) * 1;
            }

            foreach ($cost as $costkey => $valuecost) {
                $optimasi1[$nib] += ($normalisasi[$nib][$costkey] * $valuecost * -1);
            }
            $nilai1[$nib] = $optimasi[$nib];
            $nilai2[$nib] = $optimasi1[$nib];
            // dd($optimasi, $optimasi1, $nilai1);
            foreach ($nilai1 as $keynilai1 => $valuenilai1) {
                $tabelymaks[$keynilai1] = array($keynilai1, $valuenilai1);
            }

            foreach ($nilai2 as $keynilai2 => $valuenilai2) {
                $tabelymin[$keynilai2] = array($keynilai2, $valuenilai2);
            }

            $angka = array_map(null, $nilai1, $nilai2);
            $nilai3 = array_map(function ($row) {
                return $row[0] + $row[1];
            }, $angka);

            foreach ($nilai3 as $keynilai3 => $valuenilai3) {
                $nilai4[$nib] = $valuenilai3;
                $tabelygab[$nib] = array($nib, $valuenilai3);
            }
        }

        $ranking = [];
        $status = [];
        arsort($nilai4);
        foreach ($nilai4 as $keynib => $nilaikompnen4) {
            foreach ($alternatif as $id_alternatif => $value) {
                if ($keynib == $id_alternatif) {

                    if ($nilaikompnen4 > 0.5) {
                        $status = 'Layak diberi bantuan';
                        $ranking[$keynib] = array($keynib, $value[0], $nilaikompnen4, $status);
                    } else {
                        $status = 'Tidak layak diberi bantuan';
                        $ranking[$keynib] = array($keynib, $value[0], $nilaikompnen4, $status);
                    }
                }
            }
        }

        $aksi = $Modelkalkulasi->cekranking();
        if ($aksi == true) {
            $aksi1 = $Modelkalkulasi->truncateranking();

            $datakosong = [];
            foreach ($ranking as $key => $value) {
                $e[] = $key;
                $f[] = intval($value[1]);
                $g[] = doubleval($value[2]);
                $h[] = $value[3];
            }
            $datakosong = array_map(null, $e, $f, $g, $h);
            $datainput = array_map(function ($row) {
                return [
                    'nib' => $row[0],
                    'idindustri' => $row[1],
                    'nilai' => $row[2],
                    'status' => $row[3]
                ];
            }, $datakosong);

            $aksi2 = $Modelkalkulasi->tambahranking($datainput);
        } else {
            $datakosong = [];
            foreach ($ranking as $key => $value) {
                $e[] = $key;
                $f[] = intval($value[1]);
                $g[] = doubleval($value[2]);
                $h[] = $value[3];
            }
            $datakosong = array_map(null, $e, $f, $g, $h);
            $datainput = array_map(function ($row) {
                return [
                    'nib' => $row[0],
                    'idindustri' => $row[1],
                    'nilai' => $row[2],
                    'status' => $row[3]
                ];
            }, $datakosong);

            $aksi3 = $Modelkalkulasi->tambahranking($datainput);
        }

        $data = [
            'judul' => 'Laman Metode Moora | Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan',
            'datatabel' => $arraylengkap,
            'kolom' => $KolomTabel,
            'tabelnormalisasi' => $arraylengkap1,
            'pembagi' => $jumlahpembagi,
            'ymaks' => $tabelymaks,
            'ymin' => $tabelymin,
            'ygab' => $tabelygab,
            'ranking' => $ranking
        ];

        return view('/admin/kalkulasi/moora', $data);
    }

}
