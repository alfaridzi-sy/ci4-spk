<?php

namespace App\Controllers;

use App\Models\DropdownModel;

class Dynamic extends BaseController
{

    // Algoritma pengiriman data dropdown saat berubah
    public function Action()
    {
        
            $action1 = $this->request->getVar('action');
            $id_sektor = $this->request->getVar('id_sektor');
            
            if ($id_sektor!='0'||null) {
                $dropdown= new DropdownModel();
                $data = $dropdown->getnilaiKBLI($id_sektor);
                               
                echo json_encode($data);
            }else {
                $dataerror = 'kosong';
                echo json_encode($dataerror);
            }
        
    }
    
    public function Action1()
    {
        
            $action1 = $this->request->getVar('action1');
            $nib = $this->request->getVar('nib');
            
            if ($nib!='0'||null) {
                $dropdown= new DropdownModel();
                $data = $dropdown->getNIB($nib);
                               
                echo json_encode($data);
            }else {
                $dataerror = 'kosong';
                echo json_encode($dataerror);
            }
        
    }
}

