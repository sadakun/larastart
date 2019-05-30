<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblDetailPenjualansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_detail_penjualans', function(Blueprint $table)
		{
			$table->foreign('id_penjualan', 'tbl_detail_penjualans_ibfk_1')->references('id')->on('tbl_penjualans')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_produk', 'tbl_detail_penjualans_ibfk_2')->references('id')->on('tbl_produks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_jenisBarang', 'tbl_detail_penjualans_ibfk_3')->references('id')->on('tbl_jenisbarangs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_detail_penjualans', function(Blueprint $table)
		{
			$table->dropForeign('tbl_detail_penjualans_ibfk_1');
			$table->dropForeign('tbl_detail_penjualans_ibfk_2');
			$table->dropForeign('tbl_detail_penjualans_ibfk_3');
		});
	}

}
