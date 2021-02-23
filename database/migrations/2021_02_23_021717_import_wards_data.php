<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImportWardsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $service = new App\Library\GHN\Service();
        $districts = App\Models\District::all();

        foreach ($districts as $district) {
            echo "Importing {$district->name} \n";

            $wards = $service->getWards($district->ghn_id)['data'];

            if ($wards != null) {
                foreach($wards as $ward) {
                    $w = new App\Models\Ward();
                    $w->district_id = $district->id;
                    $w->name = $ward['WardName'];
                    $w->ghn_id = $ward['WardCode'];
                    $w->code = $ward['WardCode'];
                    $w->save();
                }
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
        App\Models\Ward::truncate();
    }
}
