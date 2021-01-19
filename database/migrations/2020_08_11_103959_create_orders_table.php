<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('payment')->nullable(); // choose pay: cod, paypal, tranfer, tripe,..
            $table->integer('total')->nullable();
            $table->string('currency')->nullable();// loai tien
            $table->date('created')->nullable();
            $table->tinyInteger('paystatus')->nullable();

            $table->string('recept_name')->nullable();
            $table->string('recept_phone')->nullable();
            $table->string('recept_address')->nullable();
            $table->string('recept_email')->nullable();

            $table->integer('sendship')->nullable();
            $table->date('sendcreated')->nullable();
            $table->tinyInteger('sendstatus')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
