<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Models\Poll;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'ip',
        'phone',
        'country',
        'password',
        'picture'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function setPasswordAttritbute($password)
    // {
    //     $this->attributes['password'] = Hash::make($password);
    // }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function policy(){
        return $this->hasMany('App\Models\Policy');
    }

    public function policyApproval(){
        return $this->hasMany('App\Models\Policy', 'approver_id');
    }

    public function policyPublisher(){
        return $this->hasMany('App\Models\Policy', 'publisher_id');
    }

    public function discussion(){
        return $this->hasMany('App\Models\Discussion');
    }

    public function pollPublisher(){
        return $this->hasMany('App\Models\Poll');
    }

    public function pollResponder(){
        return $this->hasMany('App\Models\PollElement');
    }

    /*
    *Check if the user has a role
    *@param string $role
    *@return bool
    */

    public function hasAnyRole(string $role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /*
    *Check if the user has any given role
    *@param array $role
    *@return bool
    */

    public function hasAnyRoles(array $roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function profilePhoto()
    {
        if (File::isFile(public_path($this->picture)))
        {
            return $this->picture;
        }
        else {
            return "/images/profilepics/avartar.jpg";
        }
    }

    public function respondedToPoll($poll_id){
        $poll = Poll::findOrFail($poll_id);
        foreach($poll->questions as $question){
            if (in_array($this->id, $question->responder->pluck('id')->all())){
                return True;
            }
        }

        return false;
    }
}
