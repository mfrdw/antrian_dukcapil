<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_UserModel;

class LoginController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('admin/login', $data);
    }

public function authenticate()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $userModel = new M_UserModel();
    $user = $userModel->where('username', $username)->first();

    if ($user && $user['password'] === $password) {
        // Simpan semua data user penting ke session
        session()->set([
            'id'         => $user['id'],
            'username'   => $user['username'],
            'nama'       => $user['nama'],
            'role_loket' => $user['role_loket'],
            'logged_in'  => true
        ]);

        return redirect()->to('/dashboard');
    } else {
        return redirect()->back()->with('error', 'Username atau password salah');
    }
}


    public function logout()
    {
        session()->destroy();

        return redirect()->to('/login')->with('success', 'Berhasil logout.');
    }

}