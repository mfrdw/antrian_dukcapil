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
        'nama_loket', 
        'user', 
        'created_at'
    ];
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $dateFormat = 'datetime';


    public function generateNoAntriPelayanan()
    {
        $today = date('Y-m-d');
        
        // Mencari nomor antrian terbesar yang ada untuk hari ini
        $lastAntrian = $this->where('DATE(created_at)', $today)
                            ->orderBy('no_antri', 'desc')
                            ->first();

        if (!$lastAntrian) {
            // Jika tidak ada antrian pada hari ini, mulai dari A001
            return 'A001';
        }

        // Mengambil nomor antrian terakhir
        $lastNoAntri = $lastAntrian['no_antri'];
        
        // Mengambil angka setelah "A" dan mengubahnya menjadi integer
        $lastNumber = (int) substr($lastNoAntri, 1);

        // Menghitung nomor antrian selanjutnya
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Kembalikan nomor antrian baru
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