<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblProduksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_produks', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_jenisBarang')->unsigned()->nullable()->index('id_jenisBarang');
			$table->string('nama_produk', 191)->nullable();
			$table->integer('harga_produk')->nullable();
			$table->string('gambar_produk', 191);
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
		Schema::drop('tbl_produks');
	}

}
