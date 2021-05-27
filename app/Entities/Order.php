<?php

namespace App\Entities;

use CodeIgniter\Entity;

class Order extends Entity
{
    public function setTypeshipping_id_typeshipping()
    {
        $this->attributes['typeshipping_id_typeshipping'] = password_hash($this->attributes['typeshipping_id_typeshipping'], PASSWORD_BCRYPT);
        return $this;
    }
}
