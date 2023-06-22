<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class DuplicateController extends Controller
{
    public function findDuplicates(Request $request)
    {
        $arr = $request->input('arr');

        $collection = Collection::make($arr);

        $duplicates = $collection->duplicates()->values()->all();

        return response()->json($duplicates);
    }
}
