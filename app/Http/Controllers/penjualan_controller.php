<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\tbl_penjualan;
use App\tbl_outlet;
use App\User;
use Illuminate\Support\Facades\DB;

class penjualan_controller extends Controller
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
            'total' => $tbl_penjualan,
        ], 200);
    }

    public function daftar_item()
    { }
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
            'id_user' => $request['id_user'],
            'id_outlet' => $request['id_outlet'],
            'tgl_penjualan' => $request['tgl_penjualan'],
            'total' => $request['total'],
            'bayar' => $request['bayar'],
            'kembalian' => $request['kembalian'],
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
        $penjualan = tbl_penjualan::findOrFail($id);
        //delete outlet
        $penjualan->forceDelete();
        return ['message' => 'data terhapus'];
    }
    public function search()
    {
        if ($search = \Request::get('q')) {
            $penjualan = tbl_penjualan::where(function ($query) use ($search) {
                $query->where('id', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $penjualan = DB::table('tbl_penjualans')->paginate(20);
        }
        return $penjualan;
    }
}
