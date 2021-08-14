<?php

namespace App\Http\Controllers;

use App\Models\CareerPage;
use Illuminate\Http\Request;

class CareerPageController extends Controller
{
    public function career()
    {
        $data = CareerPage::firstOrFail();
        $content = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
