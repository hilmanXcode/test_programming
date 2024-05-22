<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_sales extends Model
{
    use HasFactory;
    protected $table = 't_sales';
    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(m_customer::class, 'cust_id', 'id');
    }
    
    public function sales_det()
    {
        return $this->hasMany(t_sales_det::class, 'sales_id', 'id');
    }
}
