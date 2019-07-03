<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index($model)
    {
        $className = '\App\\' . ucfirst($model);

        if ($query = \request()->get('search')) {
            return $className::where('name', 'LIKE', "%$query%")
                                ->orWhere('email', 'LIKE', "%$query%")
                                ->paginate(15);
        }

        return $className::latest()->paginate(15);
    }
}
