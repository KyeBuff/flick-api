<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;

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

    public static function createUser($data) 
    {
        $email = $data['email'];
        $exists = User::where("email", $email)->first();

        if(!$exists) {
            $user = new User($data);
            $user->save();    
        } else {
            $email_body = "TODO";
            $headers = [
                'From' => 'noreply@flick.com',
                'Reply-To' => 'accounts@flick.com',
                'X-Mailer' => 'PHP/' . phpversion(),
                'Content-type' => 'text/html; charset=iso-8859-1',
                'MIME-Version' => '1.0'
            ];
        }
    }

    public function apps()
    {
        return $this->belongsToMany(App::class);
    }

    public function setApps($apps)
    {
        $this->apps()->sync($apps->pluck("id")->all());
        return $this;
    }
    public function getApps()
    {
        return $this->apps;
    }
}
