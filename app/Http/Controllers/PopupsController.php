<?php

namespace App\Http\Controllers;

use App\Http\Requests\Career;
use App\Http\Requests\EventRegistration;
use App\Http\Requests\MakeRequest;
use App\Http\Requests\OnlineAppointment;
use App\Http\Requests\PrivatAppointment;
use App\Http\Requests\TrunkShow;
use App\Models\CareerPopupMessage;
use App\Models\EventRegistrationMessage;
use App\Models\MakeRequestMessage;
use App\Models\OnlineApointmentMessage;
use App\Models\PrivatAppointmentMessage;
use App\Models\TrunkShowMessage;
use App\Services\SendMailService;
use ClassicO\NovaMediaLibrary\API;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopupsController extends Controller
{
    public function eventRegistrationPopupSend(EventRegistration $request){


        $postData = $request->post();

        $newClientMessage = new EventRegistrationMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('eventRegistration',$postData, $request);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }

    public function makeRequestPopupSend(MakeRequest $request){


        $postData = $request->post();

        $newClientMessage = new MakeRequestMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('makeRequest',$postData);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }

    public function onlineAppointmentPopupSend(OnlineAppointment $request){


        $postData = $request->post();

        $newClientMessage = new OnlineApointmentMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('onlineAppointment',$postData);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }

    public function privatAppointmentPopupSend(PrivatAppointment $request){


        $postData = $request->post();

        $newClientMessage = new PrivatAppointmentMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('privatAppointment',$postData);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }

    public function trunkShowPopupSend(TrunkShow $request){


        $postData = $request->post();

        $newClientMessage = new TrunkShowMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('trunkShow',$postData);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }

    public function careerPopupSend(Career $request){


        $postData = $request->post();

        if($request->files !== null) {
            $files = $request->allFiles();
            $filesIds = [];
            foreach ($files as $file){
                $storeFile = $file->store('/');
                $mediaLibFileData = API::upload(Storage::path($storeFile));
                Storage::delete($storeFile);
                $filesIds[] = $mediaLibFileData->id;
            }
            $postData['files'] = $filesIds;
//            $postData['files']=$request->file->store('/');
        }else{
            $postData['files']=null;
        }

        $newClientMessage = new CareerPopupMessage($postData);
        $newClientMessage->save();

        SendMailService::sendEmailToAdmin('career',$postData, $request);
        return response()->json([
            'status' => 'success',
            'massage' => 'Request will be send!'
        ]);
    }
}
