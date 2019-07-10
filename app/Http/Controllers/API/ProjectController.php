<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        try {
            $columns = ['title', 'budget', 'created_at'];

            $length = $request->input('length');
            $column = $request->input('column');
            $dir = $request->input('dir');

            $query = Project::whereIsOpen(1)->orderBy($columns[$column], $dir);

            if ($searchValue = $request->input('search')) {
                $query->where(function($query) use ($searchValue) {
                    $query->where('title', 'like', '%' . $searchValue . '%');
                });
            }

            $projects = $query->paginate($length);
            return response()->json(
                ['data' => $projects, 'draw' => $request->input('draw')],
                200);
        } catch (\Exception $e) {
            return response()->json(['an error happened!!!'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return Response
     */
    public function store(ProjectRequest $request)
    {
        try {
            $project_data = $request->only(['title', 'budget', 'body']);
            $project_data['user_id'] = auth('api')->id();

            $project = Project::create($project_data);
            foreach (\request('categories') as $category) {
                $categories[] = Category::firstOrCreate(['name' => $category['value']]);
            }

            $project->categories()->sync(collect($categories)->pluck('id')->toArray());

            return response()->json(['ok'], 200);
        } catch (\Exception $e) {
            return response()->json(['an error happened!!!'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return Response
     */
    public function show(Project $project)
    {
        return response()->json($project->load(['user', 'categories', 'proposals.users', 'proposal.users']), 200);
    }
}
