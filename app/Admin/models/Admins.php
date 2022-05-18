<?php

namespace App\Admin\Models;

use Phalcon\Mvc\Model;

class Admins extends Model {
    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;

    /*public function initialize()
    {
        $this->setSource('admins');
    }*/
}