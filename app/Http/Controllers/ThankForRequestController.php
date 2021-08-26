<?php

namespace App\Http\Controllers;

use App\Models\ThankForRequest;
use Illuminate\Http\Request;

class ThankForRequestController extends Controller
{
    public function index(){

        $data = ThankForRequest::firstOrFail();
        $content = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
