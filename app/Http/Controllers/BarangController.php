<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_barang;

class BarangController extends Controller
{
    public function index()
    {
        return view('barang.index', [
            "page" => "barang",
            "barang" => m_barang::all()
        ]);
    }

    public function insert()
    {
        return view('barang.add', [
            "page" => "barang"
        ]);
    }

    public function store(Request $request)
    {

        m_barang::create($request->validate([
            "kode" => "required|unique:m_barang,kode",
            "nama" => "required",
            "harga" => "required|integer"
        ]));

        return redirect()->intended('barang')->with('success', 'Berhasil menambah barang');
    }

    public function edit($id)
    {
        if (m_barang::find($id) === null)
            return redirect('barang')->withErrors([
                'error' => 'The provided id do not match our records.',
            ]);
        return view('barang.edit', [
            "page" => "barang",
            "data" => m_barang::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $barang = m_barang::find($id);

        if (m_barang::find($id) === null)
            return redirect('barang')->withErrors([
                'error' => 'The provided id do not match our records.',
            ]);

        $request->validate([
            "kode" => "required|unique:m_barang,kode,$barang->id",
            "nama" => "required",
            "harga" => "required|integer"
        ]);

        $barang->kode = $request->kode;
        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->save();

        return redirect()->intended('barang')->with('success', 'Berhasil mengedit barang');
    }

    public function delete($id)
    {
        if (m_barang::find($id) === null)
            return redirect('barang')->withErrors([
                'error' => 'The provided id do not match our records.',
            ]);

        $barang = m_barang::find($id);
        $barang->delete();

        return redirect()->intended('barang')->with('success', 'Berhasil menghapus barang');
    }
}
