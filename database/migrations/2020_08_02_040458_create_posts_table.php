<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->tinyInteger('category_id')->nullable();
            $table->tinyInteger('user_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->mediumText('description')->nullable();
            $table->longtext('content')->nullable();
            $table->mediumText('keyword')->nullable();
            $table->date('created')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->string('photo')->nullable();
            $table->integer('del')->nullable(); 
            $table->tinyInteger('view')->nullable();
            $table->tinyInteger('hot')->nullable();
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
        Schema::dropIfExists('_post');
    }
}
