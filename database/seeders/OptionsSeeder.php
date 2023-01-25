<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $optionGroupsId = DB::table('option_groups')
            ->where('option_group_id', '>', 1)
            ->pluck('id');

        $options = [];
        $i = 1;
        while($i <= rand(30, 50)) {
            array_push($options, ['name' => 'Option ' . $i, 'option_group_id' => $optionGroupsId->random()]);
            $i++;
        }

        DB::table('options')->insert($options);
    }
}
