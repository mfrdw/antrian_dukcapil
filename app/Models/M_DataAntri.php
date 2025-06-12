<?php

namespace App\Models;

use CodeIgniter\Model;

class M_DataAntri extends Model
{
    protected $table = 'antrian';
    protected $primaryKey = 'id';
    protected $allowedFields = [ 
        'loket_antri',
        'no_antri', 
        'jumlah_antrian', 
        'user', 
        'created_at'
    ];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $dateFormat = 'datetime';


     public function generateNoAntriPelayanan()
    {
        // Mendapatkan tanggal hari ini
        $today = date('Y-m-d');
        
        // Cek apakah sudah ada antrian yang dibuat untuk hari ini
        $lastAntrian = $this->where('DATE(created_at)', $today)
                            ->orderBy('id', 'desc')
                            ->first();

        // Jika tidak ada antrian hari ini, mulai dari A001
        if (!$lastAntrian) {
            return 'A001';
        }

        // Jika ada antrian, ambil nomor antrian terakhir dan increment
        $lastNoAntri = $lastAntrian['no_antri'];
        
        // Ambil bagian angka dari nomor antrian terakhir
        $lastNumber = (int) substr($lastNoAntri, 1); // Mengambil angka setelah "A"
        
        // Menambahkan 1 untuk nomor antrian berikutnya
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Padding ke tiga digit
        return 'A' . $newNumber;
    }

    public function generateNoAntriPerekaman()
    {
        $today = date('Y-m-d');
        
        $lastAntrian = $this->where('DATE(created_at)', $today)
                            ->where('no_antri LIKE', 'B%')  // Hanya cari antrian Perekaman (prefix 'B')
                            ->orderBy('id', 'desc')
                            ->first();

        // Jika tidak ada antrian hari ini, mulai dari B001
        if (!$lastAntrian) {
            return 'B001';
        }

        // Jika ada antrian, ambil nomor antrian terakhir dan increment
        $lastNoAntri = $lastAntrian['no_antri'];
        
        // Ambil bagian angka dari nomor antrian terakhir (setelah 'B')
        $lastNumber = (int) substr($lastNoAntri, 1); // Mengambil angka setelah "B"
        
        // Menambahkan 1 untuk nomor antrian berikutnya
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Padding ke tiga digit
        return 'B' . $newNumber;  // Mengembalikan nomor antrian baru dengan prefix B
    }



}
