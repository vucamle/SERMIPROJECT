<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $table='sanpham';
    protected $fillable = [
        'TenSP',
        'Gia',
        'GiaMoi',
        'Image1',
        'Image2',
        'SoLuong',
        'MoTa',
        'TrangThai',
        'MaLoai',
        'DanhMuc',

    ];


}
