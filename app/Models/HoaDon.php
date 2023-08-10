<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;
    protected $table='hoadon';
    protected $fillable = [
        'user_id',
        'hoten',
        'sdt',
        'diachi',
        'thanhtien',
        'trangthai',
    ];
    public function chitiethoadon(){
        return $this->hasMany('App\Models\ChiTietHoaDon', 'id_HoaDon');
    }
}
