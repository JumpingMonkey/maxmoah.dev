<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact()
    {
        $data = Contact::firstOrFail();
        $content = $data->getFullData();

///*return json obj*/
        return response()->json([
            'status' => 'success',
            'data' => $content
        ]);
    }
}
