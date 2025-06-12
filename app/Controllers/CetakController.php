<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Antrian;
use App\Models\M_DataAntri;

class CetakController extends Controller
{
    public function cetakPelayanan()
    {
        $model = new M_DataAntri();
        $noAntri = $model->generateNoAntriPelayanan(); 

        $data = [
            'antri' => $noAntri, 
        ];

        return view('user/cetak_antrian', $data);
    }

    public function cetakPerekaman()
    {
        $model = new M_Antrian();
        $antrian = $model->where('kategori', 'PEREKEMAN')->first();
        $data = [
            'antri' => $antrian,
        ];

        return view('user/cetak_antrian', $data);
    }
}
