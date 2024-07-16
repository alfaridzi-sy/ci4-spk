<?php

namespace App\Controllers;

class User extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Laman Utama Pengguna Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        return view('/User/home/lamanutama', $data);
    }

    public function lamaninfoindustri()
    {
        $data = [
            'judul' => 'Laman Informasi Industri Pengguna Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        return view('/User/industri/lamaninfoindustri', $data);
    }
    public function lamanceklayak()
    {
        $data = [
            'judul' => 'Laman Cek Kelayakan Industri Pengguna Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        return view('/User/perhitungan/lamanceklayak', $data);
    }
    public function lamaninfoakun()
    {
        $data = [
            'judul' => 'Laman Informasi Akun Pengguna Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        return view('/User/akun/lamaninfoakun', $data);
    }

    public function notifikasi() {
        $data = [
            'judul' =>  'Laman Notifikasi Pengguna Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        return view('User/industri/notifikasi',$data);
    }

    public function tambahdata(){
        $data=[
            'judul' =>  'Laman Tambah data Industri Pengguna Sistem Pendukung Keputusan Dinas Perindustrian dan Perdagangan Kabupaten Pamekasan'
        ];

        return view('User/industri/formtambahdata',$data);
        
    }

}
