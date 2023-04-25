<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = [
        'policy_id',
        'user_id',
        'parent_id',
        'reply'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function policy()
    {
        return $this->belongsTo('App\Models\Policy');
    }

    public function parent()
    {
        return $this->belongsTo('Discussion', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('Discussion', 'parent_id');
    }
}
