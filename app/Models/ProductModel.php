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

  /*   public function getEmployeeLogin(string $column,string $value){
        return $this->db->table('employee e')
            ->select('*')
            ->join('position p', 'e.id_position_employee = p.id_position')
            ->where("e.$column", $value)
            ->get()->getFirstRow();
        //return $this->where($column,$value)->first();
    } */


}