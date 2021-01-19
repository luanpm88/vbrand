<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->mediumText('description')->nullable();
            $table->longtext('content')->nullable();
            $table->mediumText('keyword')->nullable();
            $table->date('created')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('del')->nullable();
            $table->date('created_at')->nullable();
            $table->date('updated_at')->nullable();            
            $table->tinyInteger('home')->nullable();             
            $table->integer('parent')->nullable();
            $table->string('tag')->nullable();
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
        Schema::dropIfExists('_category');
    }
}
