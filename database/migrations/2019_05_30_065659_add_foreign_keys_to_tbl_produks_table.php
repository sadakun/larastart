<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTblProduksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tbl_produks', function(Blueprint $table)
		{
			$table->foreign('id_jenisBarang', 'tbl_produks_ibfk_1')->references('id')->on('tbl_jenisbarangs')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tbl_produks', function(Blueprint $table)
		{
			$table->dropForeign('tbl_produks_ibfk_1');
		});
	}

}
