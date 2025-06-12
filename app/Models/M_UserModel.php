<?php

namespace App\Models;

use CodeIgniter\Model;

class M_UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'username', 'password', 'role_loket'];
    protected $useTimestamps = false;


    
}
