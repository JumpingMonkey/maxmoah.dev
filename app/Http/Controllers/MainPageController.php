<?php

namespace App\Http\Controllers;

use App\Models\MainPageModel;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function main()
    {
        $data = MainPageModel::firstOrFail();

        $content = $data->getFullData();

        /*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
