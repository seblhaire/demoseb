<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tablecontent;

class TabledataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tablecontent::factory()
          ->count(67)
          ->create();
    }
}
