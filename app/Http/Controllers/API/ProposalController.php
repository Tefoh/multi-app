<?php

namespace App\Http\Controllers\API;

use App\Bid;
use App\Http\Requests\ProposalRequest;
use App\Project;
use App\Proposal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProposalController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param ProposalRequest $request
     * @param Project $project
     * @return void
     */
    public function store(ProposalRequest $request, Project $project)
    {
        try {
            $proposal = Proposal::create($request->only(['offer', 'deadline', 'description']));

            Bid::savingByModels($project, $proposal);

            return response()->json(['stored'], 200);
        } catch (\Exception $e) {
            return response()->json(['an error happened!!!'], 500);
        }
    }

}
