<?php

namespace CodeDelivery\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class User extends Model implements Transformable, AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use TransformableTrait, Authenticatable, Authorizable, CanResetPassword;

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function client(){
        return $this->hasOne(Client::class);
    }

}
