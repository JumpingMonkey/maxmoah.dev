<?php

namespace App\Http\Controllers;

use App\Models\OnlineAppointment;
use Illuminate\Http\Request;

class OnlineAppointmentController extends Controller
{
    public function index(){

        $data = OnlineAppointment::firstOrFail();
        $content = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
