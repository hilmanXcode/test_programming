<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_barang extends Model
{
    use HasFactory;
    protected $table = 'm_barang';
    protected $guarded = ['id'];
}
