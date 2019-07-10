<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'offer', 'deadline', 'description'
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'bids');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'bids');
    }
}
