<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('site_name')->nullable();
            $table->string('site_keyword')->nullable();
            $table->string('site_description')->nullable();
            $table->string('site_hotline')->nullable();
            $table->string('site_logo')->nullable();
            $table->string('site_flogo')->nullable();
            $table->string('site_email')->nullable();
            $table->string('site_slogon_vn')->nullable();
            $table->string('site_slogon_en')->nullable();
            $table->string('site_address_vn')->nullable();
            $table->string('site_address_en')->nullable();
            $table->string('site_companyname_vn')->nullable();
            $table->string('site_companyname_en')->nullable();
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
        Schema::dropIfExists('config');
    }
}
