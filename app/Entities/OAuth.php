<?php

namespace CodeDelivery\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OAuth extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id',
        'secret',
        'name'
    ];

    protected $table = 'oauth_clients';
}
