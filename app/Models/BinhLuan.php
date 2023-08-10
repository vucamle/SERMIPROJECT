<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuan extends Model
{
    use HasFactory;
    protected $table='binhluan';
    protected $fillable =[
        'id_user',
        'name',
        'id_sanpham',
        'noidung',
        'trangthai',
        'ngaydang'
        

    ];
    public function hoadon(){
        return $this->belongsTo('App\Models\User', 'id_user','id');
    }
}
