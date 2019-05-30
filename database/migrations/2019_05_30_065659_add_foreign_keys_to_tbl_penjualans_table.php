<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblPenjualansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_penjualans', function(Blueprint $table)
		{
			$table->foreign('id_user', 'tbl_penjualans_ibfk_1')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_outlet', 'tbl_penjualans_ibfk_2')->references('id')->on('tbl_outlets')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_penjualans', function(Blueprint $table)
		{
			$table->dropForeign('tbl_penjualans_ibfk_1');
			$table->dropForeign('tbl_penjualans_ibfk_2');
		});
	}

}
