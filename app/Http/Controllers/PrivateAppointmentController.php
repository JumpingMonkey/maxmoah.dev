<?php

namespace App\Http\Controllers;

use App\Models\PrivateAppointment;
use Illuminate\Http\Request;

class PrivateAppointmentController extends Controller
{
    public function index(){

        $data = PrivateAppointment::firstOrFail();
        $content = $data->getFullData();

        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
