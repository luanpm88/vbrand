<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTable extends Migration
{
    /**
     * Run the migrations.
     *  y nghia, tao bang tam de thuc hien giao dich
     * @return void
     */
    public function up()
    {
        Schema::create('cart', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('type')->nullable();         // 1: package_id , 2: template_id, 3: domain , 4: discount
            $table->string('name')->nullable();
            $table->integer('relation_id')->nullable();
            $table->mediumText('description')->nullable();
            $table->date('created')->nullable();
            $table->integer('price')->nullable();
            $table->Integer('month')->nullable(); 
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
        Schema::dropIfExists('cart');
    }
}
