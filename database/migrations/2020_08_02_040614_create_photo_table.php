<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('post_id')->nullable(); 
            $table->integer('product_id')->nullable();        
            $table->string('title')->nullable();
            $table->string('keyword')->nullable();
            $table->mediumText('src')->nullable(); 
            $table->mediumText('link')->nullable(); 
            $table->mediumText('description')->nullable();    
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
        Schema::dropIfExists('photo');
    }
}
