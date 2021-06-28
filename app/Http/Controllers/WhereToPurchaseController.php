<?php

namespace App\Http\Controllers;

use App\Models\WhereToPurchase;
use Illuminate\Http\Request;

class WhereToPurchaseController extends Controller
{
    public function where()
    {
        $data = WhereToPurchase::firstOrFail();
        $data = $this->translateModelWithoutIdAndTime($data);

///*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }
}
