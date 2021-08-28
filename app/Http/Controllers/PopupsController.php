<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegistration;
use App\Http\Requests\MakeRequest;
use App\Http\Requests\OnlineAppointment;
use App\Http\Requests\PrivatAppointment;
use App\Http\Requests\TrunkShow;
use App\Models\EventRegistrationMessage;
use App\Models\MakeRequestMessage;
use App\Models\OnlineApointmentMessage;
use App\Models\PrivatAppointmentMessage;
use App\Models\TrunkShowMessage;
use App\Services\SendMailService;
use Illuminate\Http\Request;

class PopupsController extends Controller
{
    public function eventRegistrationPopupSend(EventRegistration $request){


        $postData = $request->input();

        $newClientMessage = new EventRegistrationMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('eventRegistration',$postData, $request);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }

    public function makeRequestPopupSend(MakeRequest $request){


        $postData = $request->input();

        $newClientMessage = new MakeRequestMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('makeRequest',$postData);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }

    public function onlineAppointmentPopupSend(OnlineAppointment $request){


        $postData = $request->input();

        $newClientMessage = new OnlineApointmentMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('onlineAppointment',$postData);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }

    public function privatAppointmentPopupSend(PrivatAppointment $request){


        $postData = $request->input();

        $newClientMessage = new PrivatAppointmentMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('privatAppointment',$postData);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }

    public function trunkShowPopupSend(TrunkShow $request){


        $postData = $request->input();

        $newClientMessage = new TrunkShowMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('trunkShow',$postData);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }
}
