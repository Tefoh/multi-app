<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class SearchController extends Controller
{

    protected $searchable = [
        'name', 'title'
    ];
    /**
     * @param $model
     * @return ResponseFactory|Response
     */
    public function index($model)
    {
        try {
            $className = '\App\\' . ucfirst($model);

            foreach ($this->searchable as $searchable) {
                if ($query = \request()->get($searchable)) {
                    $model = $className::where($searchable, 'LIKE', "%$query%");
                }
            }

            return $model->latest()->paginate(15);
        } catch (Exception $e) {
            return response(['an error happened!!!'], 500);
        }
    }
}
