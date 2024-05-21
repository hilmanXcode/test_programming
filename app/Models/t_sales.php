<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_sales extends Model
{
    use HasFactory;
    protected $table = 't_sales';
    protected $guarded = ['id'];
}
