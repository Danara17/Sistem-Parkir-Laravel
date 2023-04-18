<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    const ADMIN = 'admin';
    const P_MASUK = 'PMasuk';
    const P_KELUAR = 'PKeluar';
    const P_RUANG = 'PRuang';
}