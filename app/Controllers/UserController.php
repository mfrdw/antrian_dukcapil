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

    // Ambil nomor antrian berikutnya
    $nextNo = $model->generateNoAntriPelayanan();

    // Cek apakah nomor tersebut sudah ada di hari ini
    $existing = $model->where('no_antri', $nextNo)
                      ->where('DATE(created_at)', date('Y-m-d'))
                      ->first();

    if ($existing) {
        // Jika sudah ada, kembalikan error atau generate ulang
        return $this->response->setJSON([
            'status' => 'error',
            'message' => "Nomor antrian {$nextNo} sudah digunakan. Silakan coba lagi."
        ]);
    }

    $data = [
        'no_antri'     => $nextNo,
        'antri'        => $nextNo,
        'loket_antri'  => 'PELAYANAN',
        'user'         => 'Fikri',
        'created_at'   => date('Y-m-d H:i:s')
    ];

    if ($model->save($data)) {
        return $this->response->setJSON([
            'status' => 'success',
            'id' => $model->getInsertID()
        ]);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal menyimpan antrian.'
        ]);
    }
}

public function ambilPerekaman()
{
    $model = new M_DataAntri();

    // Generate nomor antrian perekaman
    $antri = $model->generateNoAntriPerekaman();

    // Cek apakah nomor tersebut sudah ada hari ini
    $existing = $model->where('no_antri', $antri)
                      ->where('DATE(created_at)', date('Y-m-d'))
                      ->first();

    if ($existing) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => "Nomor antrian {$antri} sudah digunakan. Silakan coba lagi."
        ]);
    }

    // Data siap disimpan
    $data = [
        'no_antri'     => $antri,
        'antri'        => $antri,
        'loket_antri'  => 'REKAM E-KTP',
        'user'         => 'Fikri',
        'created_at'   => date('Y-m-d H:i:s')
    ];

    if ($model->save($data)) {
        return $this->response->setJSON([
            'status' => 'success',
            'id' => $model->getInsertID()
        ]);
    } else {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Gagal menyimpan antrian.'
        ]);
    }
}




}