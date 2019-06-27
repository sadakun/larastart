<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblOutletsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_outlets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nama_outlet', 191);
			$table->string('alamat_outlet', 191);
			$table->string('telp_outlet', 191);
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
		Schema::drop('tbl_outlets');
	}

}
