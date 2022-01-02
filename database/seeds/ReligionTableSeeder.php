<?php

use App\Models\Religion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->delete();

        $religions = [

            [
                'en'=> 'Muslim',
                'ar'=> 'ﻣﺴﻠﻢ'
            ],
            [
                'en'=> 'Christian',
                'ar'=> 'ﻣﺴﻴﺤﻲ'
            ],
            [
                'en'=> 'Other',
                'ar'=> 'ﻏﻴﺮﺫﻟﻚ'
            ],

        ];

        foreach ($religions as $R) {
            Religion::create(['Name' => $R]);
        }
    }
}