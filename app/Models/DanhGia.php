<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGia extends Model
{
    use HasFactory;
    protected $table='danhgia';
    protected $fillable =[
        'id',
        'is_sp',
        'id_user',
        'noidung',
        'ngaylap',
        'danhgia'

    ];
}
