<?php

namespace App\Controllers;
use App\Models\M_Pelayanan;
use App\Models\M_Perekaman;

class UserController extends BaseController
{
public function display(): string
{
    $model = new M_Pelayanan(); 
    $model2 = new M_Perekaman();

    // Mengambil data antrian dari kedua model
    $no_antri_pelayanan = $model->findAll();
    $no_antri_perekaman = $model2->findAll();

    // Menggabungkan kedua data
    $no_antri = array_merge($no_antri_pelayanan, $no_antri_perekaman);

    // Menyiapkan data untuk dikirim ke view
    $data = [
        'title' => 'Display Antrian',
        'no_antri' => $no_antri
    ];

    // Mengirim data ke view
    return view('user/display', $data);
}


public function getData()
{
    $model = new M_Pelayanan();
    $model2 = new M_Perekaman();

    // Ambil tanggal hari ini dalam format Y-m-d
    $today = date('Y-m-d');

    // Ambil data antrian dari M_Pelayanan
    $dataPelayanan = $model->where('no_antri IS NOT NULL')
                           ->where('DATE(created_at)', $today)
                           ->orderBy('created_at', 'DESC')
                           ->findAll();

    // Ambil data antrian dari M_Perekaman
    $dataPerekaman = $model2->where('no_antri IS NOT NULL')
                            ->where('DATE(created_at)', $today)
                            ->orderBy('created_at', 'DESC')
                            ->findAll();

    // Gabungkan data Pelayanan dan Perekaman
    $data = array_merge($dataPelayanan, $dataPerekaman);

    // Array untuk menyimpan hasil yang telah diproses
    $loketData = [];

    // Proses setiap data antrian
    foreach ($data as $row) {
        $nama_loket = $row['nama_loket'] ?? null;

        // Cek jika nama loket sudah ada dan belum diproses
        if ($nama_loket && !isset($loketData[$nama_loket])) {
            $loketData[$nama_loket] = [
                'loket' => $nama_loket,
                'no_antri' => $row['no_antri'],
                'kategori' => $row['loket_antri']
            ];
        }
    }

    // Mengembalikan data sebagai respons JSON
    return $this->response->setJSON(array_values($loketData));
}






    public function ambil_antrian(): string
    {
        $model = new M_Pelayanan();
        $model2 = new M_Perekaman();
        $generated1 = $model->generateNoAntriPelayanan();
        $generated2 = $model2->generateNoAntriPerekaman();
        
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
    $model = new M_Pelayanan();

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
    $model = new M_Perekaman();

    // Ambil nomor antrian berikutnya
    $nextNo = $model->generateNoAntriPerekaman();

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
// public function ambilPerekaman()
//     {
//         $model = new M_Perekaman();

//         // Generate nomor antrian perekaman
//         $antri = $model->generateNoAntriPerekaman();

//         // Cek apakah nomor tersebut sudah ada hari ini
//         $existing = $model->where('no_antri', $antri)
//                           ->where('DATE(created_at)', date('Y-m-d'))
//                           ->where('loket_antri', 'REKAM E-KTP') // Pastikan kategori loket sesuai
//                           ->first();

//         if ($existing) {
//             return $this->response->setJSON([
//                 'status' => 'error',
//                 'message' => "Nomor antrian {$antri} sudah digunakan. Silakan coba lagi."
//             ]);
//         }

//         // Ambil data user yang sedang login (misalnya menggunakan session)
//         $user = session()->get('username'); // Ambil nama pengguna dari session

//         // Data siap disimpan
//         $data = [
//             'no_antri'    => $antri,
//             'loket_antri' => 'REKAM E-KTP',  // Loket untuk kategori perekaman
//             'user'        => $user,          // Nama pengguna yang mengambil antrian
//             'created_at'  => date('Y-m-d H:i:s')  // Tanggal dan waktu saat antrian dibuat
//         ];

//         // Simpan data antrian ke database
//         if ($model->save($data)) {
//             return $this->response->setJSON([
//                 'status' => 'success',
//                 'message' => 'Antrian berhasil diambil',
//                 'id' => $model->getInsertID(),
//                 'no_antri' => $antri  // Mengirimkan nomor antrian yang baru
//             ]);
//         } else {
//             return $this->response->setJSON([
//                 'status' => 'error',
//                 'message' => 'Gagal menyimpan antrian.',
//                 'errors' => $model->errors()
//             ]);
//         }
//     }




}