<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Perekaman extends Model
{
    protected $table = 'antrian_perekaman';
    protected $primaryKey = 'id';
    protected $allowedFields = [ 
        'loket_antri',
        'no_antri',     
        'jumlah_antri',
        'nama_loket', 
        'user', 
        'created_at'
    ];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $dateFormat = 'datetime';


    public function generateNoAntriPerekaman()
    {
        $today = date('Y-m-d');
        
        // Mencari nomor antrian terbesar yang ada untuk hari ini
        $lastAntrian = $this->where('DATE(created_at)', $today)
                            ->orderBy('no_antri', 'desc')
                            ->first();

        if (!$lastAntrian) {
            // Jika tidak ada antrian pada hari ini, mulai dari A001
            return 'B001';
        }

        // Mengambil nomor antrian terakhir
        $lastNoAntri = $lastAntrian['no_antri'];
        
        // Mengambil angka setelah "A" dan mengubahnya menjadi integer
        $lastNumber = (int) substr($lastNoAntri, 1);

        // Menghitung nomor antrian selanjutnya
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Kembalikan nomor antrian baru
        return 'B' . $newNumber;
    }


   


    public function getAntrianWithLoket()
    {
        return $this
            ->select('antrian.*, users.role_loket')
            ->join('users', 'users.id = antrian.user')
            ->findAll();
    }




}