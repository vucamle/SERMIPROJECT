<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietGioHang extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table='chitietgiohang';
    protected $fillable =[
        'MaGH',
        'MaSP',
        'SoLuong',
        'Gia'
    ];
}
