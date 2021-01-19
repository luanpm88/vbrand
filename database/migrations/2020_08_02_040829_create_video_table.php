<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('post_id')->nullable(); 
            $table->integer('product_id')->nullable();
            $table->mediumText('src')->nullable();
            $table->mediumText('code')->nullable();
            $table->string('title')->nullable(); 
            $table->mediumText('description')->nullable();
            $table->mediumText('keyword')->nullable();
            $table->date('created')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('del')->nullable();
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
        Schema::dropIfExists('video');
    }
}
