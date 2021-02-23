<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportProvincesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $service = new App\Library\GHN\Service();
        $provinces = $service->getProvinces()['data'];

        foreach($provinces as $province) {
            $p = new App\Models\Province();
            $p->name = $province['ProvinceName'];
            $p->ghn_id = $province['ProvinceID'];
            $p->code = $province['Code'];
            $p->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App\Models\Province::truncate();
    }
}
