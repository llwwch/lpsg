<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('posts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title', 64)->comment('title');
            $table->string('second', 128)->nullable()->comment('title second');
            $table->string('alias', 128)->nullable()->comment('title alias');
            $table->text('content')->comment('content');
            $table->string('tags', 255)->nullable()->comment('tags');
            $table->integer('image_id')->default(0)->comment('image id');
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
        Schema::drop('posts');
    }

}
