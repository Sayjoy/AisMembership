<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'status'
    ];

    public function author()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function questions()
    {
        return $this->hasMany('App\Models\PollElement');
    }

    public function state()
    {
        if ($this->status)
            return "Active";
        else
            return "Inactive";
    }

    public function totalVote()
    {
        $total = 0;

        foreach($this->questions as $question)
        {
            $total += $question->responder->count();
        }

        return $total;
    }
}
