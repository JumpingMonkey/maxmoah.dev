<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function about()
    {
        $data = About::firstOrFail();
        $content = $data->getFullData();

/*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
