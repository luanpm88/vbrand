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
    public function template()
    {
        return $this->belongsTo(Template::class,'template_id');
    }
    public function package()
    {
        return $this->belongsTo(Package::class,'package_id');
    }

    /**
     * Get data.
     *
     * @var object | collect
     */
    public function getData()
    {
        if (!$this['data']) {
            return json_decode('{}', true);
        }

        return json_decode($this['data'], true);
    }

    /**
     * Update data.
     *
     * @var object | collect
     */
    public function updateData($data)
    {
        $data = (object) array_merge((array) $this->getData(), $data);
        $this['data'] = json_encode($data);

        $this->save();
    }
}
