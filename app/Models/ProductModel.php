<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'product';
    protected $primaryKey = 'id_product';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [];

    public function getInfoProductsListOrder($list_order)
    {
        $mdlIngredient = new IngredientModel();
        $arrayresult = array();
        foreach ($list_order as $item) {
            $consultamdl = array();
            $consultamdl = $this->find($item['product']);
            $without_ingredients = array();
            foreach($item['whitout_ingredients'] as $without){
                array_push( $without_ingredients,$mdlIngredient->find($without));
            }
            $consultamdl = array_merge($consultamdl, [
                'whitout_ingredients' => $without_ingredients,
                'quantity' => $item['quantity'],
                'id_list_order'=>$item['id']
            ]);
            array_push($arrayresult, $consultamdl);
        }
        return $arrayresult;
    }
}
