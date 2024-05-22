<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_barang extends Model
{
    use HasFactory;
    protected $table = 'm_barang';
    protected $guarded = ['id'];

    public function sales_det()
    {
        return $this->hasMany(t_sales_det::class, 'barang_id', 'id');
    }
}
