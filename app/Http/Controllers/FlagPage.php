<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlagPage extends Controller
{
    public function index() {

        $data = \App\Models\FlagPage::firstOrFail();
        $data = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
