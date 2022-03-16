<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CareerPopupPage extends Controller
{
    public function index() {
        $data = \App\Models\CareerPopupPage::firstOrFail();
        $data = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }
}
