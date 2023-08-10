<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhGiaReply extends Model
{
    use HasFactory;
    protected $table='danhgiareply';
    protected $fillable =[
        'id',
        'is_dg',
        'id_user',
        'noidung',

    ];
}
