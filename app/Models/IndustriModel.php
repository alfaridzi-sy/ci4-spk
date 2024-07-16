<?php

namespace App\Models;

use CodeIgniter\Model;

class IndustriModel extends Model
{
    protected $table = 'industri';
    protected $primaryKey = 'idindustri';
    protected $allowedFields = ['idindustri', 'nama_industri', 'iduser', 'NIB', 'sektorusaha', 'jumlahmodal', 'modal', 'kbli', 'skalaikm', 'skalausaha', 'resikousaha', 'alamatusaha', 'wilayahusaha', 'kecamatan', 'tenagakerja', 'jumlahtenagakerja'];

    public function getIndustryData()
    {
        $db = db_connect();
        $sql = $db->query("SELECT idindustri as ID_Industri,nama_industri as Nama_Industri,
         t2.namauser  as Nama_Pengguna,t1.NIB,t3.nama_kategori as Sektor_Usaha,jumlahmodal as Jumlah_Modal,
         t4.nama_kategori as Modal, t5.idkbli as ID_KBLI, t6.namakegiatan as Nama_Kegiatan,t7.nama_kategori as Skala_IKM,
         t8.nama_kategori as Skala_Usaha,t9.nama_kategori as Resiko_Usaha, alamatusaha as Alamat_Usaha, 
         t10.namakecamatan as Kecamatan,t11.nama_kategori as Wilayah_Usaha,
         jumlahtenagakerja as Jumlah_Tenaga_Kerja, t12.nama_kategori as Tenaga_Kerja, tahun
         FROM industri t1, user t2, kategori t3, kategori t4, kbli t5, kegiatanusaha t6, kategori t7,
         kategori t8, kategori t9, kecamatan t10, kategori t11, kategori t12
         WHERE t1.iduser=t2.iduser AND t1.sektorusaha=t3.id_kategori AND t1.modal=t4.id_kategori
         AND t1.kbli=t5.idkbli AND t5.idkegiatanusaha=t6.idkegiatan AND t1.skalaikm=t7.id_kategori
         AND t1.skalausaha=t8.id_kategori AND t1.resikousaha=t9.id_kategori
         AND t1.kecamatan=t10.idkecamatan AND t1.wilayahusaha=t11.id_kategori
         AND t1.tenagakerja=t12.id_kategori ");
        $result = $sql->getResultArray();

        return $result;
    }

    public function cekjumlahusaha($nib)
    {
        $db = db_connect();
        $sql = $db->query("SELECT count(idindustri) as hasil FROM industri WHERE NIB='$nib'");
        $hasil = $sql->getRow();

        return $hasil->hasil;
    }

    public function cekmodal($nib)
    {

        $db = db_connect();
        $sql = $db->query("SELECT t1.idindustri as idindustri, t1.sektorusaha as sektor, t1.modal as modal,
        t1.skalaikm as skalaindustri, t1.skalausaha as skalausaha,t1.resikousaha as resiko,t1.wilayahusaha as wilayah,
        t1.tenagakerja as tenaga FROM industri t1 
        WHERE NIB='$nib' AND t1.jumlahmodal=(SELECT MAX(jumlahmodal) FROM industri WHERE NIB='$nib')");
        $hasil = $sql->getResultArray();

        return $hasil[0];
    }

    public function GetWeight($data)
    {
        #Variabel pengambilan data input
        $data1 = $data['sektor'];
        $data2 = $data['modal'];
        $data3 = $data['skalaindustri'];
        $data4 = $data['skalausaha'];
        $data5 = $data['resiko'];
        $data6 = $data['wilayah'];
        $data7 = $data['tenaga'];
        $data8 = $data['jumlahusaha'];

        $db = db_connect();
        $sql = $db->query("SELECT t1.bobot_kategori as Sektor_Usaha, t2.bobot_kategori as Investasi, t3.bobot_kategori as Skala_Industri,
        t4.bobot_kategori as Klasifikasi_Usaha, t5.bobot_kategori as Resiko_Usaha,t8.bobot_kategori as Banyak_Usaha, t6.bobot_kategori as Lokasi_Usaha, t7.bobot_kategori as Tenaga_Kerja
        FROM kategori t1, kategori t2, kategori t3, kategori t4, kategori t5, kategori t6, kategori t7, kategori t8
        WHERE t1.id_kategori='$data1' AND  t2.id_kategori='$data2' AND t3.id_kategori='$data3' AND
        t4.id_kategori='$data4' AND t5.id_kategori='$data5' AND t6.id_kategori='$data6' AND 
        t7.id_kategori='$data7' AND t8.id_kategori='$data8' ");

        $hasil2 = $sql->getResultArray();

        $sql2 = $db->query("SELECT t1.id_kriteria as kriteriasektor, t2.id_kriteria as kriteriamodal, t3.id_kriteria as kriteriaskalaindustri,
        t4.id_kriteria as kriteriaskalausaha, t5.id_kriteria as kriteriaresiko,t8.id_kriteria as kriteriajumlahusaha, t6.id_kriteria as kriteriawilayah, t7.id_kriteria as kriteriatenagakerja
        FROM kategori t1, kategori t2, kategori t3, kategori t4, kategori t5, kategori t6, kategori t7, kategori t8
        WHERE t1.id_kategori='$data1' AND  t2.id_kategori='$data2' AND t3.id_kategori='$data3' AND
        t4.id_kategori='$data4' AND t5.id_kategori='$data5' AND t6.id_kategori='$data6' AND 
        t7.id_kategori='$data7' AND t8.id_kategori='$data8'");

        $hasil1 = $sql2->getResultArray();

        #Data Bobot
        foreach ($hasil2[0] as  $nilai) {
            $databobot[] = intval($nilai);
        }

        #Data kriteria
        foreach ($hasil1[0] as  $nilai) {
            $dataidkriteria[] = intval($nilai);
        }

        #Data gabungan bobot dengan kriteria
        $pasangdata = array_map(null, $databobot, $dataidkriteria);

        return $pasangdata;
    }

    public function SaveData($data)
    {
        $db = db_connect();
        $db->table('industri')->insert($data);
        return true;
    }

    public function UpdateData($id, $data)
    {
        return $this->db->table('industri')
            ->set($data)
            ->where('idindustri', $id)
            ->update($data);
    }

    public function getIndustryByID($id)
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM industri WHERE idindustri='$id'");
        $result = $sql->getResultArray();

        return $result[0];
    }

    public function cekmodal2($nib, $id)
    {

        $db = db_connect();
        $sql = $db->query("SELECT t1.idindustri as idindustri, t1.sektorusaha as sektor, t1.modal as modal,
        t1.skalaikm as skalaindustri, t1.skalausaha as skalausaha,t1.resikousaha as resiko,t1.wilayahusaha as wilayah,
        t1.tenagakerja as tenaga FROM industri t1 
        WHERE NIB='$nib' AND t1.idindustri<>'$id' AND t1.jumlahmodal=(SELECT MAX(jumlahmodal) FROM industri WHERE NIB='$nib' AND idindustri<>'$id')
        ");
        $hasil = $sql->getResultArray();

        return $hasil[0];
    }

    public function cekjumlahusaha2($nib, $id)
    {
        $db = db_connect();
        $sql = $db->query("SELECT count(idindustri) as hasil FROM industri WHERE NIB='$nib' AND idindustri<>'$id'");
        $hasil = $sql->getRow();

        return $hasil->hasil;
    }

    public function hapusdataindustriNIB($NIB)
    {
        $db = db_connect();
        $sql = $db->query("DELETE FROM industri WHERE NIB='$NIB'");
        return true;
    }

    public function JumlahIndustri()
    {
        $db = db_connect();
        $sql = $db->query("SELECT idindustri AS Jumlah_industri FROM industri");
        $result = $sql->getNumRows();

        return $result;
    }

    

    // public function getIndustryDataPartial()
    // {
    //     return $this->table('industri')
    //         ->join('kategori', 'industri.modal=kategori.id_kategori OR industri.skalaikm=kategori.id_kategori OR industri.skalausaha=kategorid_kategori OR industri.resikousaha=kategorid_kategori OR industri.sektorusaha=kategorid_kategori OR industri.jumlahusaha=kategorid_kategori OR industri.wilayahusaha=kategorid_kategori OR industri.tenagakerja=kategorid_kategori')
    //         ->get()->getArrayResult();
    // }

    // public function getDataIndustryTable()
    // {
    //     $db = db_connect();
    //     $query = $db->query("SELECT idindustri,nama_industri,user.namauser as namapengguna, 
    //     user.NIB,kategorisektor.nama_kategori AS sektor,kategorimodal.nama_kategori as modal,jumlahmodal,
    //     kbli,kategoriskalaikm.nama_kategori as skalaikm,kategoriskalausaha.nama_kategori as klasifikasiusaha,
    //     alamatusaha,kategoriwilayah.nama_kategori as wilayahusaha,kecamatan.namakecamatan,
    //     kategoriresiko.nama_kategori as resikousaha,jumlahtenagakerja, 
    //     kategoritenagakerja.nama_kategori as tenagakerja 
    //     FROM industri, user, kecamatan, kategorisektor, kategorimodal, kategoriskalaikm,
    //     kategoriskalausaha, kategoriwilayahusaha, kategoriresiko, kategoritenagakerja 
    //     WHERE industri.kecamatan=kecamatan.idkecamatan AND industri.iduser=user.iduser 
    //     AND industri.sektorusaha=kategorisektor.id_kategori AND industri.modal=kategorimodal.id_kategori
    //     AND industri.skalaikm=kategoriskalaikm.id_kategori AND industri.skalausaha=kategoriskalausaha.id_kategori
    //     AND industri.wilayahusaha=kategoriwilayahusaha.id_kategori AND industri.resikousaha=kategoriresiko.id_kategori
    //     AND industri.tenagakerja=kategoritenagakerja.id_kategori");


    //     $result = $query->getResultArray();

    //     // $konvers=implode(',',$result1);

    //     // $a=[];

    //     // // elemen array query
    //     // foreach ($result as $kolom) :
    //     //     $b[]=$kolom['idindustri'];
    //     //     $d[]=$kolom['nama_industri'];
    //     //     $e[]=$kolom['namapengguna'];
    //     //     $f[]=$kolom['NIB'];
    //     //     $g[]=$kolom['sektor'];
    //     //     $h[]=$kolom['jumlahmodal'];
    //     //     $i[]=$kolom['kbli'];
    //     //     $j[]=$kolom['alamatusaha'];
    //     //     $k[]=$kolom['namakecamatan'];
    //     //     $l[]=$kolom['jumlahtenagakerja'];

    //     // endforeach;

    //     // // elemen array query1
    //     // foreach ($result1 as $kolom1) :
    //     //     $num[]=$kolom1['modal'];
    //     // endforeach;

    //     // // elemen array query1
    //     // foreach ($result2 as $kolom2) :
    //     //     $skalaikm[]=$kolom2['skalaikm'];
    //     // endforeach;

    //     // // elemen array query1
    //     // foreach ($result3 as $kolom3) :
    //     //     $skalausaha[]=$kolom3['skalausaha'];
    //     // endforeach;

    //     // // elemen array query1
    //     // foreach ($result4 as $kolom4) :
    //     //     $resikousaha[]=$kolom4['resiko'];
    //     // endforeach;

    //     // // elemen array query1
    //     // foreach ($result5 as $kolom5) :
    //     //     $wilayahusaha[]=$kolom5['wilayahusaha'];
    //     // endforeach;

    //     // // elemen array query1
    //     // foreach ($result6 as $kolom6) :
    //     //     $tenagakerja[]=$kolom6['tenagakerja'];
    //     // endforeach;

    //     // array_push($a,$b,$d,$e,$f,$g,$num);
    //     // $a=[
    //     //     'idindustri'=>$b,
    //     //     'nama_industri'=>$d,
    //     //     'namapengguna'=>$e,
    //     //     'NIB'=>$f,
    //     //     'sektor'=>$g,
    //     //     'modal'=>$num,
    //     //     'jumlahmodal'=>$h,
    //     //     'kbli'=>$i,
    //     //     'skalaikm'=>$skalaikm,
    //     //     'skalausaha'=>$skalausaha,
    //     //     'alamatusaha'=>$j,
    //     //     'wilayahusaha'=>$wilayahusaha,
    //     //     'kecamatan'=>$k,
    //     //     'resikousaha'=>$resikousaha,
    //     //     'jumlahtenagakerja'=>$l,
    //     //     'tenagakerja'=>$tenagakerja
    //     // ];

    //     // $transformedData = array();

    //     // foreach ($a as $row) {
    //     //     foreach ($row as $key => $value) {
    //     //         if (!isset($transformedData[$key])) {
    //     //             $transformedData[$key] = array();
    //     //         }
    //     //         $transformedData[$key][] = $value;
    //     //     }
    //     // }

    //     // $finalData = array();
    //     // foreach ($transformedData as $key => $values) {
    //     //     $finalData[$key] = $values;
    //     // }
    //     // dd($a);

    //     dd($result);
    // }
}
