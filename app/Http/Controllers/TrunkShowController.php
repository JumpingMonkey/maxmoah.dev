<?php

namespace App\Http\Controllers;

use App\Models\TrunkShow;
use Illuminate\Http\Request;

class TrunkShowController extends Controller
{
    public function index(){

        $data = TrunkShow::firstOrFail();
        $content = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
