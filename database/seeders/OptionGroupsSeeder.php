<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
            ['name' => 'Not category options', 'option_group_id' => 1],
            ['name' => 'Global Option 1', 'option_group_id' => 1],
            ['name' => 'Global Option 2', 'option_group_id' => 1],
            ['name' => 'Global Option 3', 'option_group_id' => 1]
        ];

        for ($i = 0; $i <= rand(20,30); $i++) {
            array_push($options, ['name' => 'Option group ' . $i + 1, 'option_group_id' => rand(2,4)]);
        }

        DB::table('option_groups')->insert($options);
    }
}
