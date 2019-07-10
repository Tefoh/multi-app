<?php

namespace App\Http\Controllers\API;

use App\Bid;
use App\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\AcceptedProposalRequest;

class AcceptProposalController extends Controller
{
    /**
     * @param AcceptedProposalRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AcceptedProposalRequest $request)
    {
        try {
            if (Bid::where('project_id', $request->project)->where('proposal_id', $request->proposal)->count() === 1) {

                Project::find($request->project)->update(['accepted_proposal' => $request->proposal]);
                return response()->json(['updated'], 201);
            }
            return response()->json(['not found!!!'], 404);
        } catch (\Exception $e) {
            return response()->json(['an error happened!!!'], 500);
        }
    }

    /**
     * @param Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Project $project)
    {
        try {
            $project->update(['accepted_proposal' => null]);
            return response()->json(['deleted!!!'], 200);
        } catch (\Exception $e) {
            return response()->json(['an error happened!!!'], 500);
        }
    }
}
