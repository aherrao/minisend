<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitiateProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('users')->count()) {
            return false;
        }

        $arrMixInsertData = [];
        $arrMixInsertData['client_id'] = 1;
        $arrMixInsertData['name'] = 'admin';
        $arrMixInsertData['email'] = 'admin@minisend.com';
        $arrMixInsertData['is_admin'] = true;
        $arrMixInsertData['password'] = bcrypt('admin');

        DB::table('users')->insert($arrMixInsertData);

        $arrMixInsertData = [];
        $arrMixInsertData['name'] = 'Minisend';
        $arrMixInsertData['sub_domain'] = 'admin';
        $arrMixInsertData['client_type_id'] = 4;
        $arrMixInsertData['secret_key'] = base64_encode(hash_hmac('sha256',Hash::make('admin'), 'secret', true));
        $arrMixInsertData['created_by'] = 1;
        $arrMixInsertData['updated_by'] = 1;

        DB::table('clients')->insert($arrMixInsertData);
    }
}
