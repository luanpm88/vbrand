<?php

namespace App;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserConnection;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    public function userConnections()
    {
    	return $this->hasmany('App\Models\UserConnection');
    }

    public function getUserConnection($type)
    {
        $connection = $this->userConnections()
            ->where('type', '=', $type)
            ->first();

        if (!$connection) {
            $connection = new UserConnection();
            $connection->user_id = $this->id;
            $connection->type = $type;
        }

        return $connection;
    }
}
