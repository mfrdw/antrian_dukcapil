<?php

namespace App\Controllers;
use App\Models\M_Pelayanan;
use App\Models\M_Perekaman;
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
    $modelAntri = new M_Pelayanan();
    $modelAntri2 = new M_Perekaman();
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

    // Tentukan loket_antri berdasarkan role_loket
    if (in_array($role_loket_session, ['Loket 1', 'Loket 2', 'Loket 3', 'Loket 4', 'Loket 5'])) {
        $loket_antri = 'PELAYANAN';
    } elseif (strtoupper($role_loket_session) == 'LOKET 6') {
        $loket_antri = 'REKAM E-KTP';
    } else {
        // Jika role_loket tidak sesuai, tampilkan pesan error atau redirect
        return redirect()->back()->with('error', 'Role Loket tidak valid');
    }

    // Ambil data antrian dari model Pelayanan berdasarkan loket_antri dan tanggal hari ini
    $antrianPelayanan = $modelAntri->where('loket_antri', $loket_antri)
                                    ->where('DATE(created_at)', $today)
                                    ->findAll();

    // Ambil data antrian dari model Perekaman berdasarkan loket_antri dan tanggal hari ini
    $antrianPerekaman = $modelAntri2->where('loket_antri', $loket_antri)
                                     ->where('DATE(created_at)', $today)
                                     ->findAll();

    // Gabungkan kedua data antrian (Pelayanan dan Perekaman)
    $data_antrian = array_merge($antrianPelayanan, $antrianPerekaman);

    // Menyiapkan data untuk ditampilkan ke view
    $data = [
        'title' => 'Panggil Antrian',
        'data_antrian' => $data_antrian
    ];

    return view('admin/panggil_antrian', $data);
}


public function getAntrian()
{
    $modelPelayanan = new M_Pelayanan();
    $modelPerekaman = new M_Perekaman();
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

    // Ambil data antrian dari M_Pelayanan
    $antrianPelayanan = $modelPelayanan->where('loket_antri', $loket_antri)
                                        ->where('DATE(created_at)', $today)
                                        ->orderBy('created_at', 'DESC')
                                        ->findAll();

    // Ambil data antrian dari M_Perekaman
    $antrianPerekaman = $modelPerekaman->where('loket_antri', $loket_antri)
                                        ->where('DATE(created_at)', $today)
                                        ->orderBy('created_at', 'DESC')
                                        ->findAll();

    // Gabungkan hasil dari kedua model
    $antrian = array_merge($antrianPelayanan, $antrianPerekaman);

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
    $modelPelayanan = new M_Pelayanan();
    $modelPerekaman = new M_Perekaman();
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

    // Ambil data antrian dari M_Pelayanan
    $antrianPelayanan = $modelPelayanan->where('loket_antri', $loket_antri)
                                        ->where('DATE(created_at)', $today)
                                        ->findAll();

    // Ambil data antrian dari M_Perekaman
    $antrianPerekaman = $modelPerekaman->where('loket_antri', $loket_antri)
                                        ->where('DATE(created_at)', $today)
                                        ->findAll();

    // Gabungkan hasil dari kedua model
    $antrian = array_merge($antrianPelayanan, $antrianPerekaman);

    // Filter: HANYA data yang belum dipanggil (nama_loket kosong)
    $result = [];
    foreach ($antrian as $a) {
        if (empty($a['nama_loket'])) {
            $result[] = $a;
        }
    }

    return $this->response->setJSON($result);
}



public function addLoket($idAntrian)
{
    $userModel = new M_UserModel();
    $antriModelPelayanan = new M_Pelayanan(); // Model untuk Pelayanan
    $antriModelPerekaman = new M_Perekaman(); // Model untuk Perekaman

    // 1. Ambil ID user dari session
    $idUser = session()->get('id');
    if (!$idUser) {
        return $this->response->setStatusCode(401)->setJSON([
            'status' => 'error',
            'message' => 'Session tidak aktif. Silakan login kembali.'
        ]);
    }

    // 2. Ambil data user login
    $user = $userModel->find($idUser);
    if (!$user) {
        return $this->response->setStatusCode(404)->setJSON([
            'status' => 'error',
            'message' => 'User tidak ditemukan.'
        ]);
    }

    // 3. Ambil data antrian berdasarkan ID dari tombol
    $loket_antri = $user['role_loket']; // Loket yang sedang login
    $antrian = null;

    // Tentukan model berdasarkan nama_loket
    if (in_array($loket_antri, ['Loket 1', 'Loket 2', 'Loket 3', 'Loket 4', 'Loket 5'])) {
        // Jika nama_loket adalah Loket 1 - Loket 5, gunakan M_Pelayanan
        $antrian = $antriModelPelayanan->find($idAntrian);
        $model = $antriModelPelayanan;
    } elseif ($loket_antri == 'Loket 6') {
        // Jika nama_loket adalah Loket 6, gunakan M_Perekaman
        $antrian = $antriModelPerekaman->find($idAntrian);
        $model = $antriModelPerekaman;
    } else {
        // Jika role_loket tidak valid
        return $this->response->setStatusCode(400)->setJSON([
            'status' => 'error',
            'message' => 'Role Loket tidak valid.'
        ]);
    }

    if (!$antrian) {
        return $this->response->setStatusCode(404)->setJSON([
            'status' => 'error',
            'message' => 'Data antrian tidak ditemukan.'
        ]);
    }

    // 4. Update data antrian dengan nama_loket dan user
    $model->update($idAntrian, [
        'nama_loket' => $user['role_loket'],
        'user'       => $user['nama'],
        'created_at' => date('Y-m-d H:i:s')
    ]);

    return $this->response->setJSON([
        'status' => 'success',
        'message' => 'Antrian berhasil diperbarui berdasarkan ID yang diklik.',
        'data' => [
            'id' => $idAntrian,
            'nama_loket' => $user['role_loket'],
            'user' => $user['nama']
        ]
    ]);
}



public function getRoleLoket()
{
    $role = session()->get('role_loket');
    if (!$role) {
        return $this->response->setStatusCode(401)->setJSON([
            'status' => 'error',
            'message' => 'Belum login atau role tidak tersedia.'
        ]);
    }

    return $this->response->setJSON([
        'status' => 'success',
        'role_loket' => $role
    ]);
}



}