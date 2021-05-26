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
        $arrayresult = array();
        foreach ($list_order as $item) {
            array_push($arrayresult, $this->find($item['product']));
        }
        return $arrayresult;

    }
}
