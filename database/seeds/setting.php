<?php

namespace Database\Seeders;

use App\Models\setting as ModelsSetting;
use Illuminate\Database\Seeder;

class setting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelsSetting::create([

            "school_name"=>"default",
            "address"=>"default",
            "number"=>"0947643753",
            "logo"=>"logo.png",
            "email"=>"ali@gmail.com",
            "lowest_subject"=>"4"




        ]);
    }
}
