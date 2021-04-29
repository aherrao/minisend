<?php

namespace Database\Seeders;

use App\Helpers\DataHelper;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailStatusTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('email_status_types')->count()) {
            return false;
        }

        $arrStrNames = DataHelper::statusTypes();

        $intOrder = 1;

        foreach ($arrStrNames as $key => $strName) {

            $arrMixInsertData = [];
            $arrMixInsertData['name'] = $strName;
            $arrMixInsertData['icon'] = DataHelper::getStatusTypeColor($key);
            $arrMixInsertData['description'] = $strName;
            $arrMixInsertData['is_published'] = true;
            $arrMixInsertData['order'] = $intOrder++;

            DB::table('email_status_types')->insert($arrMixInsertData);
        }
    }
}
