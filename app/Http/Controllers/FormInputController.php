<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_sales;
use App\Models\m_customer;
use App\Models\m_barang;

class FormInputController extends Controller
{
    public function index()
    {
        $kode = "";
        $lastData = t_sales::orderBy('id', 'DESC')->first();
        if ($lastData === null) {
            $kode = date('Ym-0001');
        } else {
            $data = $lastData->kode;
            $getLastNum = substr($data, 7);
            $kode = date("Ym") . "-" . sprintf("%04d", $getLastNum + 1);
        }
        return view('forminput.index', [
            "page" => "forminput",
            "kode_transaksi" => $kode,
            "data_customer" => m_customer::all(),
            "barang" => m_barang::all()
        ]);
    }

    public function getcustomer(Request $request)
    {
        $customer = m_customer::all()->where('kode', '=', $request->kode)->firstOrFail();
        return response()->json(['name' => $customer->name, 'telp' => $customer->telp]);
    }

    public function getbarang(Request $request)
    {
        $barang = m_barang::all()->where('kode', '=', $request->kode)->firstOrFail();
        $harga_bandrol = number_format($barang->harga, 2);
        return response()->json(['data' => "<tr id='$barang->kode'><td class='d-flex gap-2'><button class='btn btn-warning'>Ubah</button><button onclick=hapus_barang('$barang->kode') class='btn btn-danger'>Hapus</button></td> <td class='border-bottom-0'> <p class='mb-0 fw-normal'>$request->no</p> </td> <td class='border-bottom-0'> <p class='mb-0 fw-normal'>$barang->kode</p> </td> <td class='border-bottom-0'> <h6 class='fw-semibold'>$barang->nama</h6> </td> <td class='border-bottom-0'> <input type='number'> </td> <td class='border-bottom-0'> <p class='mb-0 fw-normal'>$harga_bandrol</p> </td> <td class='border-bottom-0'> <input type='number'>% </td> <td class='border-bottom-0'> <p class='mb-0 fw-normal'>-</p> </td> <td class='border-bottom-0'> <p class='mb-0 fw-normal'>$harga_bandrol</p> </td><td>$harga_bandrol</td> </tr>"]);
    }
}
