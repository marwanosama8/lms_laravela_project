<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $x = 0;
       $n = 0;
       

        $names = array(
            "Adam Alex", "Aaron Ben", "Carl Dan", "David Edward", "Fred Frank", "George Hal",
            "Hank Ike", "John Jack", "Joe Larry", "Monte Matthew");

        $emails = array(
            'trent.rutherford@price.com',
            'shaina21@yahoo.com',
            'feeney.jettie@hotmail.com',
            'misty75@schumm.com',
            'schuster.margaretta@stehr.info',
            'wehner.federico@gmail.com',
            'hudson14@hotmail.com',
            'joan.von@rau.org',
            'asia72@hotmail.com',
            'lavada.oberbrunner@thompson.info',     
        );

        $passwords = array(

            '123456789',
            '123456789',
            '123456789',
            '123456789',
            '123456789',
            '123456789',
            '123456789',
            '123456789',
            '123456789',
            '123456789',
        );
        DB::table('users')->delete();
        while ($x < 10) {
            DB::table('users')->insert([
            'name' => $names[$n],
            'email' => $emails[$n],
            'password' => $passwords[$n],
            ]);
            $x++;
            $n++;
        }
    }
}

