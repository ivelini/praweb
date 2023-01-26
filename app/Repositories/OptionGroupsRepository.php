<?php


namespace App\Repositories;

use App\Models\OptionGroup as Model;


class OptionGroupsRepository extends CoreRepository
{

    public function getModelClass()
    {
        return Model::class;
    }

    public function getOptionsForProductId($id)
    {
        $options = $this->startConditions()
            ->where('option_group_id', 1)
            ->with(
                'optionGroup',
                function($query) use ($id) {
                    $query->with(
                        'options',
                        function($query) use ($id) {
                            $query->with(
                                'products',
                                function ($query) use ($id) {
                                    $query->where('product_id', $id);
                                }
                            );
                        }
                    );
                }
            )
//            ->with('optionGroup.options.products')
            ->get();



//        $options = $this->startConditions()
//            ->whereHas(
//                'options',
//                function ($query) use ($id) {
//                    $query->whereHas(
//                        'products',
//                        function($query) use ($id){
//                            $query->where('product_id', $id);
//                        }
//                    );
//                }
//            )
//            ->with('options.products')
//            ->get();

        return $options;
    }
}
