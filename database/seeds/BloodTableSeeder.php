<?php

use App\Models\Type_blood;
use Illuminate\Database\Seeder;

class BloodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_bloods')->delete();

        $tags = ['O-','O+','A+','A-','B+','B-','AB+','AB-'];
        foreach ($tags as $tag) {
            Type_blood::create(['Name' => $tag]);
        }
    }
}


