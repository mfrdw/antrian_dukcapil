<?php

namespace App\Controllers;
use App\Models\M_DataAntri;
use App\Models\M_UserModel;

class AdminController extends BaseController
{
    public function dashboard(): string
    {
        $data = [
            'title' => 'Dashboard',
        ];
        return view('admin/dashboard', $data);
    }

    public function panggil_antrian(): string
    {
        $modelAntri = new M_DataAntri();
        $modelUser = new M_UserModel();

        // Cek apakah user sudah login dan memiliki role_loket di session
        if (!session()->has('role_loket')) {
            // Jika tidak ada session role_loket, redirect ke login atau halaman yang sesuai
            return redirect()->to('/login');
        }

        // Ambil role_loket dari session
        $role_loket_session = session()->get('role_loket');

        // Ambil tanggal hari ini
        $today = date('Y-m-d');  

        // Menyimpan data antrian yang sesuai
        $data_antrian = [];

        // Jika role_loket sesuai dengan yang diinginkan
        if (in_array($role_loket_session, ['Loket 1', 'Loket 2', 'Loket 3', 'Loket 4', 'Loket 5'])) {
            $loket_antri = 'PELAYANAN';
        } elseif (strtoupper($role_loket_session) == 'LOKET 6') {
            $loket_antri = 'REKAM E-KTP';
        } else {
            // Jika role_loket tidak sesuai, tampilkan pesan error atau redirect
            return redirect()->back()->with('error', 'Role Loket tidak valid');
        }

        // Mengambil data antrian yang sesuai dengan loket_antri dan tanggal hari ini
        $antrian = $modelAntri->where('loket_antri', $loket_antri)
                            ->where('DATE(created_at)', $today)
                            ->findAll();

        $data_antrian = array_merge($data_antrian, $antrian);

        

        // Menyiapkan data untuk ditampilkan ke view
        $data = [
            'title' => 'Panggil Antrian',
            'data_antrian' => $data_antrian
        ];

        return view('admin/panggil_antrian', $data);
    }

public function getAntrian()
{
    $model = new M_DataAntri();
    $today = date('Y-m-d');
    $role_loket_session = session()->get('role_loket');

    // Validasi session role_loket
    if (empty($role_loket_session)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Role loket tidak ditemukan dalam session.'
        ]);
    }

    // Tentukan jenis layanan berdasarkan role
    $loket_antri = (in_array($role_loket_session, ['Loket 1', 'Loket 2', 'Loket 3', 'Loket 4', 'Loket 5']))
        ? 'PELAYANAN'
        : 'REKAM E-KTP';

    // Ambil semua antrian sesuai jenis dan tanggal
    $antrian = $model->where('loket_antri', $loket_antri)
                     ->where('DATE(created_at)', $today)
                     ->orderBy('created_at', 'DESC')
                     ->findAll();

    // Filter: hanya antrian dengan nama_loket yang PERSIS sama dengan role_loket
    $result = [];
    foreach ($antrian as $a) {
        if (isset($a['nama_loket']) && $a['nama_loket'] === $role_loket_session) {
            $result[] = $a;
        }
    }

    return $this->response->setJSON($result);
}


    public function getAntrian2()
{
    $model = new M_DataAntri();
    $today = date('Y-m-d');
    $role_loket_session = session()->get('role_loket');

    // Validasi session role
    if (empty($role_loket_session)) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Role loket tidak ditemukan dalam session.'
        ]);
    }

    // Tentukan jenis loket berdasarkan role
    $loket_antri = (in_array($role_loket_session, ['Loket 1', 'Loket 2', 'Loket 3', 'Loket 4', 'Loket 5'])) 
        ? 'PELAYANAN' 
        : 'REKAM E-KTP';

    // Ambil data antrian sesuai dengan hari ini & jenis loket
    $antrian = $model->where('loket_antri', $loket_antri)
                    ->where('DATE(created_at)', $today)
                    ->findAll();

    // Filter: HANYA data yang belum dipanggil (nama_loket kosong)
    $result = [];
    foreach ($antrian as $a) {
        if (empty($a['nama_loket'])) {
            $result[] = $a;
        }
    }

    return $this->response->setJSON($result);
}



public function updateNamaLoket($id)
{
    // Validasi ID
    if (!is_numeric($id) || $id <= 0) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'ID tidak valid.'
        ]);
    }

    $model = new M_UserModel();

    $role_loket = $model->where('role_loket', $id);

    // Data manual yang ingin dikirim
    $namaLoket = $role_loket;

    // Panggil model antrian
    $antrianModel = new M_DataAntri();
    $updated = $antrianModel->update($id, ['nama_loket' => $namaLoket]);

    // Berikan respon JSON
    return $this->response->setJSON([
        'status' => $updated ? 'success' : 'failed',
        'message' => $updated ? 'Nama loket berhasil diperbarui.' : 'Gagal memperbarui nama loket.'
    ]);
}



}