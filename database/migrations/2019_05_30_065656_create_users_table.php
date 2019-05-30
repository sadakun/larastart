<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('id_outlet')->unsigned()->nullable()->index('id_outlet');
			$table->string('name', 191)->nullable();
			$table->string('email', 191)->nullable()->unique();
			$table->string('photo', 191)->nullable()->default('profile.png');
			$table->string('role', 191)->nullable();
			$table->string('alamat', 191)->nullable();
			$table->string('no_telp', 191)->nullable();
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password', 191);
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('users');
	}

}
