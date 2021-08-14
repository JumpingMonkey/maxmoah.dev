<?php

namespace App\Http\Controllers;

use App\Models\CustomerServicePage;
use Illuminate\Http\Request;

class CustomerServicePageController extends Controller
{
    public function custServ()
    {
        $data = CustomerServicePage::firstOrFail();
        $content = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
