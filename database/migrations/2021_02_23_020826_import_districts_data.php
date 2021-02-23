<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportDistrictsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $service = new App\Library\GHN\Service();
        $provinces = App\Models\Province::all();

        foreach ($provinces as $province) {
            echo "Importing {$province->name} \n";

            $districts = $service->getDistricts($province->ghn_id)['data'];

            foreach($districts as $district) {
                $d = new App\Models\District();
                $d->province_id = $province->id;
                $d->name = $district['DistrictName'];
                $d->ghn_id = $district['DistrictID'];
                $d->code = $district['Code'];
                $d->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App\Models\District::truncate();
    }
}
