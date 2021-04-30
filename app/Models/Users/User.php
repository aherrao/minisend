<?php

namespace App\Models\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable,
        Gateway,
        Relation;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function saveUser($objRequest, $intId = 0) {

        $objUser = self::with('profile')->find($intId) ?? new self();

        $objUser->name = $objRequest->name;
        $objUser->email = $objRequest->email;
        $objUser->is_admin = ($objRequest->is_admin) ? true : false;
        $objUser->password = Hash::make($objRequest->password);
        $objUser->client_id = 1;

        $objUser->save();

        return $objUser;
    }
}
