<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailorderModel extends Model
{
    protected $table      = 'detailorder';
    protected $primaryKey = 'id_detailorder';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'id_detailorder',
        'product_id_product',
        'order_id_order',
        'quantity_detailorder',
        'priceunit_detailorder'
    ];

    public function getListOrderByReference($reference)
    {
        $mdlWhiout = new WhitoutingredientModel();
        $listOfOrder = $this->db->table('detailorder d')
            ->select('*')
            ->join('product p', 'd.product_id_product = p.id_product')
            ->where('d.order_id_order', $reference)
            ->get()->getResultArray();

        $newListOfOrder = array();
        foreach ($listOfOrder as $item) {
            $newItem = array();
            $without_ingredients = $mdlWhiout->getIngredients($item['id_detailorder']);
            $newItem = array_merge($item, ['whitout' => $without_ingredients]);
            array_push($newListOfOrder, $newItem);
        }
        return $newListOfOrder;
    }
}
