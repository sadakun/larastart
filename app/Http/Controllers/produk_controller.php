<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tbl_produk;
use Illuminate\Support\Facades\DB;
use App\tbl_jenisBarang;

class produk_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tbl_produk = DB::table('tbl_jenisbarangs')
            ->join('tbl_produks', 'tbl_jenisbarangs.id', '=', 'tbl_produks.id_jenisBarang')
            ->select('tbl_jenisbarangs.*', 'tbl_produks.*')
            ->get();
        return response()->json([
            'nama_produk' => $tbl_produk,

        ], 200);
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
            'nama_produk' => 'required|string|max:191|unique:tbl_produks',
            'id_jenisBarang' => 'required|integer',
            'harga_produk' => 'required|integer'
            
        ]);
        
            return tbl_produk::create([
            'nama_produk' => $request['nama_produk'],
            'id_jenisBarang' => $request['id_jenisBarang'],
            'harga_produk' => $request['harga_produk']
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
        $produk = tbl_produk::findOrFail($id);
        $this->validate($request, [
            'nama_produk' => 'required|string|max:191',
            'id_jenisBarang' => 'required|integer',
            'harga_produk' => 'required|integer'
           
        ]);
        $produk->update($request->all());
        return ['message' => 'Updated produk'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = tbl_produk::findOrFail($id);
        //delete outlet
        $produk->forceDelete();
        return ['message' => 'data terhapuus'];
    }
}
