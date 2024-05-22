<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_sales_det extends Model
{
    use HasFactory;
    protected $table = 't_sales_det';
    protected $guarded = [];

    public function sales()
    {
        return $this->belongsTo(t_sales::class, 'sales_id', 'id');
    }
    
    public function barang()
    {
        return $this->belongsTo(m_barang::class, 'barang_id', 'id');
    }
}
