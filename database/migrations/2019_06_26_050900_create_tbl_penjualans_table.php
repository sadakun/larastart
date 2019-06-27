<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblPenjualansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_penjualans', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_user')->unsigned()->nullable()->index('id_user');
			$table->integer('id_outlet')->unsigned()->nullable()->index('id_outlet');
			$table->date('tgl_penjualan')->nullable();
			$table->integer('total')->nullable();
			$table->integer('bayar')->nullable();
			$table->integer('kembalian')->nullable();
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
		Schema::drop('tbl_penjualans');
	}

}
