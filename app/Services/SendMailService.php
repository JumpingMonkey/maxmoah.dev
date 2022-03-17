<?php


namespace App\Services;


use App\Http\Requests\JoinPopupPostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailSetting;
use function Symfony\Component\String\b;

class SendMailService
{

    private static function config()
    {
        $emailSetting = EmailSetting::firstOrFail();
        config([
            "mail.mailers.smtp.username" => $emailSetting->email_for_send,
            "mail.mailers.smtp.password" => $emailSetting->password,
        ]);
        return $emailSetting;

    }

//    public static function sendEmailToMySpecialUserRequest($model)
//    {
//        $emailSetting = SendMailService::config();
//        $data = array('name' => $model->name, 'code' => $model->code);
//        Mail::send('email.AccessGranted', $data, function($message) use ($emailSetting,$model) {
//            $message->to($model->email, $model->name)->subject($emailSetting->name.': Access granted!');
//            $message->from($emailSetting->email_for_send,$emailSetting->name);
//        });
//    }

    public static function sendEmailToAdmin($popup,$postData, Request $request = null)
    {
        $emailSetting = SendMailService::config();

        switch ($popup){
            case 'eventRegistration':
                $email = $emailSetting->email_for_event_reg;
                $view = 'toAdminFromEventRegistration';
                break;
            case 'makeRequest':
                $email = $emailSetting->email_for_make_request;
                $postData['clientMessage'] = $postData['message'];
                $view = 'toAdminFromMakeRequest';
                break;
            case 'onlineAppointment':
                $email = $emailSetting->email_for_online_appointment;
                $view = 'toAdminFromOnlineAppointment';
                break;
            case 'privatAppointment':
                $email = $emailSetting->email_for_privat_appointment;
                $view = 'toAdminFromPrivatAppointment';
                break;
            case 'trunkShow':
                $email = $emailSetting->email_for_trunk_show;
                $view = 'toAdminFromTrunkShow';
                break;
            case 'career':
                $email = $emailSetting->email_for_career;
                $view = 'toAdminFromCareer';
                break;

        }

        Mail::send('email.'.$view, $postData, function($message) use ($emailSetting,$popup, $email, $request, $postData) {
            $message->to($email,$emailSetting->name)->subject($emailSetting->name.': New mail from the '.$popup.' popup!');
            $message->from($emailSetting->email_for_send,$emailSetting->name);

            if(isset($postData['file'])) {
                $message->attach($request->file('file')->getRealPath(), [
                    'as' => $request->file('file')->getClientOriginalName(),
                    'mime' => $request->file('file')->getMimeType()
                ]);
            }

        });
    }
}

