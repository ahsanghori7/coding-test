<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Services\GroupByOwnersService;
class DuplicateController extends Controller
{
    public function findDuplicates(Request $request)
    {
        $arr = $request->input('arr');

        $collection = Collection::make($arr);

        $duplicates = $collection->duplicates()->values()->all();

        return response()->json($duplicates);
    }

    public function groupByOwer(GroupByOwnersService $groupByOwnersService)
    {
        $files = [
            "insurance.txt" => "Company A",
            "letter.docx" => "Company A",
            "Contract.docx" => "Company B",
            "test.docx" => "Company C",
            "test1.docx" => "Company C",
        ];

        $result = $groupByOwnersService->groupByOwners($files);

        return response()->json($result);
    }
}
