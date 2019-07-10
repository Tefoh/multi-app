<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{

    protected $fillable = [
        'user_id', 'project_id', 'proposal_id'
    ];

    public $timestamps = false;

    public static function savingByModels( Project $project, Proposal $proposal, $user_id = null)
    {
        static::create([
            'user_id' => $user_id ?? auth('api')->id(),
            'project_id' => $project->id,
            'proposal_id' => $proposal->id,
        ]);
    }

    public function project()
    {
        return $this->hasOne(Project::class);
    }
}
