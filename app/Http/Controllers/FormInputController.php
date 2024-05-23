<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_sales;
use App\Models\t_sales_det;
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
        return response()->json(['data' => "<tr id='$barang->kode'><td class='d-flex gap-2'><button class='btn btn-warning' onclick=ubah_barang('$request->no') type='button'>Ubah</button><button onclick=hapus_barang('$barang->kode') class='btn btn-danger' type='button'>Hapus</button></td> <td class='border-bottom-0'> <p class='mb-0 fw-normal'>$request->no</p> </td> <td class='border-bottom-0'> <input type='text' value='$barang->kode' name='kode_barang[]' readonly /> </td> <td class='border-bottom-0'> <h6 class='fw-semibold'>$barang->nama</h6> </td> <td class='border-bottom-0'> <input type='number' id='qty$request->no' value='1' name='qty[]'> </td> <td class='border-bottom-0'> <input type='decimal' step='any' id='harga_bandrol$request->no' value='$barang->harga' name='harga_bandrol[]' readonly> </td> <td class='border-bottom-0'> <input type='number' id='persen$request->no' name='diskon_pct[]' value='0'>% </td> <td class='border-bottom-0'> <input type='number' readonly id='rupiahpersen$request->no' name='diskon_nilai[]'> </td> <td class='border-bottom-0'> <input type='number' readonly id='hargadiskon$request->no' name='harga_diskon[]'> </td><td><input type='number' readonly id='total$request->no' name='total[]' readonly></td> </tr>"]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            "kode_transaksi" => "required",
            "tgl" => "required",
            "customer_code" => "required",
            "sub_total" => "required",
            "ongkirs" => "required",
            "total_bayar" => "required",
            "kode_barang" => "required",
            "qty" => "required",
            "diskon_pct" => "required",
            "diskon_nilai" => "required",
            "harga_diskon" => "required",
            "total" => "required"
        ]);
        
        $customer =  m_customer::all()->where('kode', '=', $request->customer_code)->firstOrFail();
        

        $sales = t_sales::create([
            "kode" => $request->kode_transaksi,
            "tgl" => $request->tgl,
            "cust_id" => $customer->id,
            "sub_total" => $request->sub_total,
            "diskon" => $request->diskons,
            "ongkir" => $request->ongkirs,
            "total_bayar" => $request->total_bayar,
        ]);

    
        if(count($data['kode_barang']) > 0){
            for($i = 0; $i < count($data['kode_barang']); $i++){
                t_sales_det::create([
                    'sales_id' => $sales->id,
                    'barang_id' => m_barang::all()->where('kode', '=', $request->kode_barang[$i])->firstOrFail()->id,
                    'harga_bandrol' => m_barang::all()->where('kode', '=', $request->kode_barang[$i])->firstOrFail()->harga,
                    'qty' => $request->qty[$i],
                    'diskon_pct' => $request->diskon_pct[$i],
                    'diskon_nilai' => $request->diskon_nilai[$i],
                    'harga_diskon' => $request->harga_diskon[$i],
                    'total' => $request->total[$i]
                ]);
            }
        }
        else {
            $barang = m_barang::all()->where('kode', '=', $request->kode_barang)->firstOrFail();
            t_sales_det::create([
                'sales_id' => $sales->id,
                'barang_id' => $barang->id,
                'harga_bandrol' => $barang->harga,
                'qty' => $request->qty,
                'diskon_pct' => $request->diskon_pct,
                'diskon_nilai' => $request->diskon_nilai,
                'harga_diskon' => $request->harga_diskon,
                'total' => $request->total
            ]);
        }



        return redirect()->intended('dashboard')->with('success', 'Berhasil menginput data');
    }
}
