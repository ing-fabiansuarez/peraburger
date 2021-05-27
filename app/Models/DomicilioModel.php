<?php

namespace App\Models;

use CodeIgniter\Model;

class DomicilioModel extends Model
{
    protected $table      = 'domicilio';
    protected $primaryKey = 'id_domicilio';
    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [];

}
