<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollElement extends Model
{
    protected $fillable = [
        'title',
        'poll_id',
        'user_id'
    ];

    use HasFactory;

    public function poll()
    {
        return $this->belongsTo('App\Models\Poll');
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function responder()
    {
        return $this->belongsToMany('App\Models\user');
    }

    public function percentageResponse()
    {
        if ($this->poll->totalVote() >0){
            $percentage = $this->responder->count() * 100 / $this->poll->totalVote();
        }
        else{
            $percentage = 0;
        }

        return $percentage;
    }
}
