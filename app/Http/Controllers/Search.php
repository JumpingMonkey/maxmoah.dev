<?php

namespace App\Http\Controllers;

use App\Models\SearchNoResult;
use App\Models\SearchResult;
use Illuminate\Http\Request;

class Search extends Controller
{
    public function searchResultPage() {
        $data = SearchResult::firstOrFail();
        $data = $data->getFullData();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function searchNoResultPage() {
        $data = SearchNoResult::firstOrFail();
        $data = $data->getFullData();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
