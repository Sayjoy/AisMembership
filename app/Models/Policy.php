<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Policy extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'details',
        'name',
        'email',
        'phone',
        'user_id',
        'approval',
        'approver_id',
        'comment',
        'policy_id',
        'publisher_id',
        'published_at'
    ];

    public function shortDetails()
    {
        return Str::limit($this->details, 255);
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function approver(){
        return $this->belongsTo('App\Models\User', 'approver_id');
    }

    public function incrementPolicyViews() {
        $this->views++;
        return $this->save();
    }

    public function discussion(){
        return $this->hasMany('App\Models\Discussion');
    }

    public function publisher(){
        return $this->belongsTo('App\Models\User', 'publisher_id');
    }

}
