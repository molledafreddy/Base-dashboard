<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_group_id','phone','address','image','api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function scopeSearch($query, $target)
    {
        if ($target != '') {
            return $query->
                where('name', 'like', "%$target%")
                ->orWhere('phone', 'like', "%$target%")
                ->orWhere('email', 'like', "%$target%")
                ->orWhere('address', 'like', "%$target%")
                // ->orWhere('phone', 'like', "%$target%")
                // ->orWhere('registration_ip', 'like', "%$target%")
                ;
        }
    }

    //Attributes

    public function getIsAdminAttribute()
    {
        return $this->user_group_id == 1;
    }

    public function getIsDealerAttribute()
    {
        return $this->user_group_id == 2;
    }

    public function generateToken()
    {
        $this->api_token = str_random(50);
        $this->save();

        return $this->api_token;
    }
}
