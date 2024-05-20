<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\m_customer;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.index', [
            "page" => "customer",
            "customer" => m_customer::all()
        ]);
    }

    public function insert()
    {
        return view('customer.add', [
            "page" => "customer"
        ]);
    }

    public function store(Request $request)
    {
        m_customer::create($request->validate([
            "kode" => "required|unique:m_customer,kode",
            "name" => "required",
            "telp" => "required|numeric"
        ]));

        return redirect()->intended('customer')->with('success', 'Berhasil menambahkan customer');
    }

    public function edit($id)
    {
        if (m_customer::find($id) === null)
            return redirect('customer')->withErrors([
                'error' => 'The provided id do not match our records.'
            ]);

        return view('customer.edit', [
            "page" => "customer",
            "data" => m_customer::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        if (m_customer::find($id) === null)
            return redirect('customer')->withErrors([
                'error' => 'The provided id do not match our records.'
            ]);
        $customer = m_customer::find($id);

        $customer->update($request->validate([
            "kode" => "required|unique:m_customer,kode,$customer->id",
            "name" => "required",
            "telp" => "required|numeric"
        ]));

        return redirect()->intended('customer')->with('success', 'Berhasil mengedit customer');
    }

    public function delete($id)
    {
        if (m_customer::find($id) === null)
            return redirect('customer')->withErrors([
                'error' => 'The provided id do not match our records.'
            ]);

        $customer = m_customer::find($id);
        $customer->delete();

        return redirect()->intended('customer')->with('success', 'Berhasil menghapus customer');
    }
}
