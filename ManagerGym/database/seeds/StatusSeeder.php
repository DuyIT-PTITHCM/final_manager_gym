<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Status::create([
            'name'=>'Using'
        ]);
        Status::create([
            'name'=>'Maintenance'
        ]);
        Status::create([
            'name'=>'Broken'
        ]);
       
    }
}
