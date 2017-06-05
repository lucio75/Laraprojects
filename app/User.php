<?php

namespace LaraCourse;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * LaraCourse\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\LaraCourse\Models\Album[] $albums
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\LaraCourse\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function albums()
    {
        return $this->hasMany('LaraCourse\Models\Album', 'user_id');
    }
}
