<?php

namespace App;

use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Get all of the tasks for the user.
     */
    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
    public function unfinishedtasks(){
        return User::tasks()->where('state','Unfinished');
    }
    public function assignments(){
        return $this->belongsToMany('App\Assignment')->withPivot('state')->withTimestamps();
    }


    public function isSuperUser(){

        $user = Auth::user();
        $email = $user->email;
        if($email == "assistant@agenciaumbrella.com"){
            return true;
        }
        else{
            return false;
        }
    }

    public function hasUnreadNotifications(){

        $user = Auth::user();
        $notifications = User::notifications()->where('user_id',$user->id)
            ->where('state','Unread')->count();
        if($notifications>0){
            return true;
        }else {
            return false;
        }
    }
    public function countUnreadNotifications(){

        $user = Auth::user();
        return User::notifications()->where('user_id',$user->id)
            ->where('state','Unread')->count();
    }

    use Messagable;

}

