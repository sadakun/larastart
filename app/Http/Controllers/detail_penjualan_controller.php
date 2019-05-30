<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tbl_detail_penjualan;
use App\tbl_produk;
use Illuminate\Support\Facades\DB;


class detail_penjualan_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tbl_detail_penjualan = DB::table('tbl_produks')
            ->join('tbl_detail_penjualans', 'tbl_produks.id', '=', 'tbl_detail_penjualans.id_produk')
            ->join('tbl_jenisBarangs', 'tbl_jenisBarangs.id', '=', 'tbl_produks.id_jenisBarang')
            ->select('tbl_jenisBarangs.jenisBarang','tbl_produks.nama_produk', 'tbl_produks.harga_produk','tbl_detail_penjualans.*')
            ->get();
        return response()->json([
            'sub_total' => $tbl_detail_penjualan,

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
        return tbl_detail_penjualan::create([
            'nama_produk' => $request['nama_produk'],
            'id_jenisBarang' => $request['id_jenisBarang'],
            'harga_produk' => $request['harga_produk'],
            'jumlah_barang' => $request['jumlah_barang'],
            'sub_total' => $request['sub_total'],
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail_penjualan = tbl_detail_penjualan::findOrFail($id);
        //delete outlet
        $detail_penjualan->forceDelete();
        return ['message' => 'data terhapuus'];
    }

    public function search()
    {
        if ($search = \Request::get('q')){
            $produk = tbl_produk::where(function($query) use ($search){
                $query->where('nama_produk','LIKE',"%$search%");
            })->paginate(20);
        }else
        {
            $produk = DB::table('tbl_produks')->paginate(20);
        }
        return $produk;
    }
    
}
