<?php

namespace App\Admin\Models;

use Phalcon\Mvc\Model;

class Admin extends Model {
    public $id;
    public $name;
    public $email;
    public $password;
    public $logo;
    public $created_at;

    /*public function initialize()
    {
        $this->setSource('admins');
    }*/
}