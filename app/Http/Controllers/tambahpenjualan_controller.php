<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tbl_penjualan;
use App\tbl_produk;

class tambahpenjualan_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tbl_penjualan = DB::table('tbl_penjualans')
            ->join('Users', 'Users.id', '=', 'tbl_penjualans.id_user')
            ->join('tbl_outlets', 'tbl_outlets.id', '=', 'tbl_penjualans.id_outlet')
            ->select('Users.id', 'tbl_outlets.nama_outlet', 'tbl_penjualans.*')
            ->get();
        return response()->json([
            'detail_penjualan' => $tbl_penjualan,
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
        return tbl_penjualan::create([
            'id' => $request['id'],
        ]);
    }
    public function loadLastransaction(Request $request)
    {
        $id = DB::table('tbl_penjualans')
            ->orderBy('created_at', 'desc')
            ->first();
        return response()->json([
            'id' => $id,
        ], 200);
    }

    public function addToCart(Request $request)
    {
        //validasi data yang diterima
        //dari ajax request addToCart mengirimkan product_id dan qty
        $this->validate($request, [
            'id' => 'required|exists:tbl_produks,id',
            'qty' => 'required|integer'
        ]);

        //mengambil data product berdasarkan id
        $product = tbl_produk::findOrFail($request->id);
        //mengambil cookie cart dengan $request->cookie('cart')
        $getCart = json_decode($request->cookie('cart'), true);
        //jika datanya ada
        if ($getCart) {
            //jika key nya exists berdasarkan product_id
            if (array_key_exists($request->id, $getCart)) {
                //jumlahkan qty barangnya
                $getCart[$request->id]['qty'] += $request->qty;
                //dikirim kembali untuk disimpan ke cookie
                return response()->json($getCart, 200)
                    ->cookie('cart', json_encode($getCart), 120);
            }
        }

        //jika cart kosong, maka tambahkan cart baru
        $getCart[$request->id] = [
            'nama_produk' => $product->nama_produk,
            'harga_produk' => $product->harga_produk,
            'qty' => $request->qty
        ];
        //kirim responsenya kemudian simpan ke cookie
        return response()->json($getCart, 200)
            ->cookie('cart', json_encode($getCart), 120);
    }

    public function getCart()
    {
        //mengambil cart dari cookie
        $cart = json_decode(request()->cookie('cart'), true);
        //mengirimkan kembali dalam bentuk json untuk ditampilkan dengan vuejs
        return response()->json($cart, 200);
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
        //
    }
}
