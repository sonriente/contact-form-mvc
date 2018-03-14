<?php

namespace models;

use components\Model;

/**
 * Class Comment
 * @package models
 */
class Comment extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string
     */
    protected $table = 'comments';

    /**
     * @var array
     */
    protected $attributes = [
        'id' => null,
        'user_name' => null,
        'comment' => null,
        'created_at' => null,
        'updated_at' => null
    ];
}
