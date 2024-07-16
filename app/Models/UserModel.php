<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'iduser';
    protected $allowedFields = ['namauser', 'username', 'password', 'NIB', 'status'];

    public function GetIDUser()
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM {$this->table}");
        $result = $query->getRow();

        return $result;
    }

    public function ambildataID($id)
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM user WHERE iduser='$id'");
        $result = $sql->getResultArray();
        foreach ($result as $nilai) {
            $datapengguna = $nilai;
        }

        return $datapengguna;
    }

    public function dataid()
    {
        $db = db_connect();
        $sql = $db->query("SELECT iduser FROM user ORDER BY iduser DESC LIMIT 1");
        $hasil = $sql->getResultArray();
        $data = [];
        foreach ($hasil as $key => $nilaibaris) {
            foreach ($nilaibaris as  $kry => $value) {
                $data[$kry] = intval($value);
            }
        }

        return $data;
    }

    public function CheckIDPass($username, $password)
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM user WHERE username='$username'");
        $hasil = $sql->getResultArray();

        $datapengguna = [];
        foreach ($hasil as $baris => $nilaibaris) {
            foreach ($nilaibaris as  $key => $value) {
                $datapengguna[$key] = $value;
            }
        }
        if ($datapengguna==null || $datapengguna==0) {
            return false;
        }else {
            if ($username == $datapengguna['username'] && $password == $datapengguna['password']) {
                return $datapengguna;
            } else {
                return false;
            }
            
        }
    }

    public function simpandata($data)
    {
        $db = db_connect();
        $db->table('user')->insert($data);
        return true;
    }

    public function tampildatapengguna()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM user");
        $result = $sql->getResultArray();

        return $result;
    }

    public function updatedata($id, $data)
    {
        return $this->update($id, $data);
    }

    public function ambilstatus()
    {
        $db = db_connect();
        $sql = $db->query("SELECT DISTINCT user.status FROM user");
        $result = $sql->getResultArray();

        $data = [];
        foreach ($result as $baris) {
            foreach ($baris as $key => $value) {
                $data[] = $value;
            }
        }

        return $data;
    }

    public function hapusdata($idpengguna)
    {
        $db = db_connect();
        $sql = $db->query("DELETE FROM user WHERE iduser='$idpengguna'");

        return true;
    }

    public function JumlahPengguna()
    {
        $db = db_connect();
        $sql = $db->query("SELECT iduser FROM user");
        $result = $sql->getNumRows();

        return $result;
    }

    public function datausersaja()
    {
        $db = db_connect();
        $sql = $db->query("SELECT * FROM user WHERE status=user");
        $result =  $sql->getResultArray();

        return $result;
    }

    public function cekidpengguna($namapengguna,$katasandi) {
        $db=db_connect();
        $sql=$db->query("SELECT iduser,namauser, NIB, status FROM user WHERE username='$namapengguna' AND password='$katasandi'");
        $result = $sql->getResultArray();

        return $result[0];
    }

    


}
