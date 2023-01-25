<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $optionsId = DB::table('options')->pluck('id');

        $productsId = DB::table('products')->pluck('id')->toArray();

        $productOption = [];
        foreach ($productsId as $productId) {
            $filteredOptionsId = $optionsId
                ->map(function ($optionId) use ($productId) {
                    if (rand(0,1)) return ['product_id' => $productId, 'option_id' => $optionId];
                })
                ->filter()
                ->toArray();

            $productOption =  array_merge($productOption, $filteredOptionsId);
        }

        DB::table('product_option')->insert($productOption);
    }
}
