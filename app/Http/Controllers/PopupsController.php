<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegistration;
use App\Models\EventRegistrationMessage;
use Illuminate\Http\Request;

class PopupsController extends Controller
{
    public function eventRegistrationPopupSend(EventRegistration $request){

        $postData = $request->input();

        $newClientMessage = new EventRegistrationMessage($postData);
        $newClientMessage->save();

//        SendMailService::sendEmailToAdmin('sayHi',$postData);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }
}
