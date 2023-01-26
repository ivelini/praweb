<?php


namespace App\Repositories;

use App\Models\Product as Model;


class ProductsRepository extends CoreRepository
{


    public function getModelClass()
    {
        return Model::class;
    }

    public function getOptionsForProductId($id)
    {
        $options = $this->startConditions()
            ->where('id', $id)
            ->with('options')
            ->get();

        return $options;
    }
}
