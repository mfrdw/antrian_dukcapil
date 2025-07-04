<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_Pelayanan;
use App\Models\M_Perekaman;

class CetakController extends Controller
{
public function cetakPelayanan($id)
{
    $model   = new M_Pelayanan();
    $antrian = $model->find($id);

    if (!$antrian || $antrian['loket_antri'] !== 'PELAYANAN') {
        throw new \CodeIgniter\Exceptions\PageNotFoundException(
            'Antrian pelayanan tidak ditemukan.'
        );
    }

    // Kirim dua field terpisah
    return view('user/cetak_antrian', [
        'antri'    => $antrian['no_antri'],
        'loket_antri' => $antrian['loket_antri'],
    ]);
}


public function cetakPerekaman($id)
{
    $model   = new M_Perekaman();
    $antrian = $model->find($id);

    if (!$antrian || $antrian['loket_antri'] !== 'REKAM E-KTP') {
        throw new \CodeIgniter\Exceptions\PageNotFoundException(
            'Antrian perekaman tidak ditemukan.'
        );
    }

    // ──> kirim dua variabel:
    return view('user/cetak_antrian', [
        'antri'    => $antrian['no_antri'],
        'loket_antri' => $antrian['loket_antri'],
    ]);
}


}