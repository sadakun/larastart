<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblDetailPenjualansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_detail_penjualans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_penjualan')->unsigned()->nullable()->index('id_penjualan');
			$table->integer('id_produk')->unsigned()->nullable()->index('id_produk');
			$table->integer('id_jenisBarang')->unsigned()->nullable()->index('id_jenisBarang');
			$table->integer('sub_total');
			$table->integer('harga_lama');
			$table->integer('diskon');
			$table->integer('jumlah_barang')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tbl_detail_penjualans');
	}

}
