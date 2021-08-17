<?php

namespace App\Http\Controllers;

use App\Models\MakeRequestPageModel;
use Illuminate\Http\Request;

class MakeRequestPageModelController extends Controller
{
    public function index(){

        $data = MakeRequestPageModel::firstOrFail();
        $content = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
