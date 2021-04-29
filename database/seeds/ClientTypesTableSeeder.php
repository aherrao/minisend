<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\DataHelper;

class ClientTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('client_types')->count()) {
            return false;
        }

        $arrStrNames = DataHelper::clientTypes();

        $intOrder = 1;

        foreach ($arrStrNames as $strName) {

            $arrMixInsertData = [];
            $arrMixInsertData['name'] = $strName;
            $arrMixInsertData['description'] = $strName;
            $arrMixInsertData['is_published'] = true;
            $arrMixInsertData['order'] = $intOrder++;

            DB::table('client_types')->insert($arrMixInsertData);
        }
    }
}
