<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albums', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->comment('belongs to');
            $table->string('title')->comment('album title');
            $table->text('brief')->nullable()->comment('brief');
            $table->string('tags')->nullable()->comment('tags');
            $table->text('permissions')->comment('permissions');
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
		Schema::drop('albums');
	}

}
