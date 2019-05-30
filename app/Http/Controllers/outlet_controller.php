<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tbl_outlet;

class outlet_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tbl_outlet::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_outlet' => 'required|string|max:191|unique:tbl_outlets',
            'alamat_outlet' => 'required|string|max:255',
            'telp_outlet' => 'required|string|max:12'
        ]);
        return tbl_outlet::create([
            'nama_outlet' => $request['nama_outlet'],
            'alamat_outlet' => $request['alamat_outlet'],
            'telp_outlet' => $request['telp_outlet'],
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $outlet = tbl_outlet::findOrFail($id);
        $this->validate($request, [
            'nama_outlet' => 'required|string|max:191|unique:tbl_outlets',
            'alamat_outlet' => 'required|string|max:255',
            'telp_outlet' => 'required|string|max:12'
        ]);
        $outlet->update($request->all());
        return ['message' => 'Updated outlet'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $outlet = tbl_outlet::findOrFail($id);
        //delete outlet
        $outlet->forceDelete();
        return ['message' => 'data terhapuus'];
    }
}
