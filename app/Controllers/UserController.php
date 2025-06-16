<?php

namespace App\Controllers;
use App\Models\M_DataAntri;

class UserController extends BaseController
{
    public function display(): string
    {
        $data = [
        'title' => 'Display Antrian',
        ];
        return view('user/display', $data);
    }

    public function ambil_antrian(): string
    {
        $model = new M_DataAntri();
        $generated1 = $model->generateNoAntriPelayanan();
        $generated2 = $model->generateNoAntriPerekaman();
        
        $data = [
            'title' => 'Ambil Antrian',
            'antri1' => $generated1,
            'antri2' => $generated2
        ];

        return view('user/ambil_antrian', $data);
    }

    public function lihat_antrian(): string{

        $data = [
            'title' => 'Ambil Antrian'
        ];

        return view('user/cetak_antrian', $data);
    }


    public function ambilPelayanan()
    {
        $model = new M_DataAntri();

        $no_antri = $this->request->getPost('antrian');

        $Antri = $model->generateNoAntriPelayanan();

        $data = [
            'antri'      => $Antri,
            'loket_antri'   => 'PELAYANAN',
            'no_antri' => $no_antri,
            'user' => 'Fikri',
            'created_at'    => date('Y-m-d H:i:s')
        ];

            if ($model->save($data)) {
                return redirect()->to('/ambil_antrian');
            } else {
                return redirect()->back()->with('error', 'Gagal menyimpan antrian.');
            }
    }

    public function ambilPerekaman()
    {
        $model = new M_DataAntri();

        $no_antri = $this->request->getPost('antrian');

        $Antri = $model->generateNoAntriPerekaman();

        $data = [
            'antri'      => $Antri,
            'loket_antri'   => 'REKAM E-KTP',
            'no_antri' => $no_antri,
            'user' => 'Fikri',
            'created_at'    => date('Y-m-d H:i:s')
        ];

            if ($model->save($data)) {
                return redirect()->to('ambil_antrian');
            } else {
                return redirect()->back()->with('error', 'Gagal menyimpan antrian.');
            }
    }


}




