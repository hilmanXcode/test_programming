<?php

namespace App\Http\Controllers;

use App\Models\t_sales;
use Illuminate\Http\Request;
use App\Models\t_sales_det;

class DashboardController extends Controller
{
    public function index()
    {
        $datax = t_sales_det::all(); 
        $grandtotal = 0;
        foreach($datax as $data)
        {
            $grandtotal+=$data->total;
        }
        return view('index', [
            "page" => "dashboard",
            "datas" => t_sales_det::all(),
            "grandtotals" => $grandtotal
        ]);
    }
}
