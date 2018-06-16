<?php

namespace App;

use App\Exceptions\CMPResponseException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    public static $password;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function person() {
        return $this->morphTo();
    }

    public function scopeAdmin($query) {
        return $query->wherePersonType("App\Admin");
    }

    public static function authenticate($username, $password){
        $user = static::whereUsername($username)->first();

        if($user && Hash::check($password, $user->password)) {
            return $user;
        }
        throw new CMPResponseException("validation_failure", ["username" => ["Username and password combination not valid."]]);
    }

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getFullNameAttribute() {
        return $this->person->full_name;
    }
}
