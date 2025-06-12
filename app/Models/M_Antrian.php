<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Antrian extends Model
{
    protected $table = 'no_antrian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kategori', 'no_antrian'];

    protected $useTimestamps = true;
}
