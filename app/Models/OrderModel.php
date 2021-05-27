<?php

namespace App\Models;

use App\Entities\Order;
use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'order';
    protected $primaryKey = 'id_order';
    protected $returnType     = Order::class;
    protected $useSoftDeletes = false;
    protected $allowedFields = [];

   
}
