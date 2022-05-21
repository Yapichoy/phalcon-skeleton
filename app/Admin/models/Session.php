<?php

namespace App\Admin\Models;

use Phalcon\Mvc\Model\Behavior\Timestampable;
use Phalcon\Mvc\Model;
use App\Admin\Models\Admin;
class Session extends Model {
    public $session_id;
    public $admin_id;
    public $is_log_in;
    public $flag_remember;
    public $created_at;
    public $updated_at;

    public function initialize()
    {
        $this->setSource('admin_sessions');

        $this->addBehavior(
            new Timestampable(
                [
                    'onUpdate' => [
                        'field'  => 'created_at',
                        'format' => 'Y-m-d H:i:s',
                    ],
                ]
            )
        );

        $this->belongsTo(
            'admin_id',
            Admin::class,
            'id'
        )
    }
}