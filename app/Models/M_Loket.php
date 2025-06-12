<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Loket extends Model
{
    protected $table = 'loket';     
    protected $primaryKey = 'id';     
    protected $allowedFields = ['loket_name'];

    protected $useTimestamps = false; 

    protected $skipValidation = false; 
}
