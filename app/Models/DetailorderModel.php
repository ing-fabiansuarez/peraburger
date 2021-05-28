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
}
