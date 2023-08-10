<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    use HasFactory;
    protected $table='chitiethoadon';
    protected $fillable =[
        'id_hoadon',
        'TenSP',
        'SoLuong',
        'Gia',
        'ThanhTien',
        'TrangThai',

    ];
    public function hoadon(){
        return $this->belongsTo('App\Models\HoaDon', 'Id_HoaDon','id');
    }
    
}
