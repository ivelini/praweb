<?php


namespace App\Repositories;

use App\Models\Option as Model;


class OptionsRepository extends CoreRepository
{


    public function getModelClass()
    {
        return Model::class;
    }

    public function getOptionsForProductId($id)
    {
        $options = $this->startConditions()
            ->whereHas('products', function ($query) use ($id) {
                $query->where('product_id', $id);
            })
            ->with('optionGroup.optionGroup')
            ->get();

        $options = $options->map(function ($itemOption) {
            return [
                'id' => $itemOption->id,
                'name' => $itemOption->name,
                'group_id' =>$itemOption->optionGroup->id,
                'group_name' => $itemOption->optionGroup->name,
                'parent_id' =>$itemOption->optionGroup->optionGroup->id,
                'parent_name' => $itemOption->optionGroup->optionGroup->name,
            ];
        });

        $options = $options->groupBy(
            [
                function($item) {
                    return $item['parent_name'];
                },
                function($item) {
                    return $item['group_name'];
                },
            ])->toArray();

        return $options;
    }
}
