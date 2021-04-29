<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DataHelper;
use App\Http\Controllers\Controller;
use App\Mail\SenderEmail;
use App\Models\ApiLog\ApiLog;
use App\Models\Email\Email;
use App\Models\ApiLog\EmailLog;
use App\Models\EmailStatusType\EmailStatusType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class MailerApiController extends Controller
{
    public function send(Request $objRequest)
    {
        $response = [
            'url' => $objRequest->fullUrl(),
            'request' => $objRequest->all(),
            'response' => [],
            'success' => false,
        ];

        $apiLogId = ApiLog::log($response);

        $validator = Validator::make($objRequest->all(), Email::$rules);


        if ($validator->fails()) {
            $response['is_validation_fail'] = $validator->fails();
            $response['response'] = $validator->messages()->toArray();
        } else {
            $objEmail = new Email();
            $objEmail->email_status_type_id = DataHelper::getStatusTypeId('Posted');
            $objEmail->to_email = $objRequest->input('to_email');
            $objEmail->from_email = $objRequest->input('from_email');
            $objEmail->subject = $objRequest->input('subject');
            $objEmail->body = $objRequest->input('body');
            $objEmail->save();

            Mail::to($objEmail->to_email)->send(new SenderEmail($objEmail));

            $response['success'] = true;
            $response['response'] = [
                'email_id' => $objEmail->id,
                'status' => $objEmail->statusType->name
            ];
        }

        ApiLog::log($response, $apiLogId);

        return response()->json($response);
    }

    public function checkStatus($emailId, Request $objRequest)
    {
        $response = [
            'url' => $objRequest->fullUrl(),
            'request' => $objRequest->all(),
            'response' => [],
            'success' => false,
        ];

        $apiLogId = ApiLog::log($response);

        $objEmail = Email::find($emailId);

        if($objEmail) {
            $response['response'] = $objEmail;
            $response['success'] = true;
        } else {
            $response['message'] = 'Not found.';
        }

        ApiLog::log($response, $apiLogId);

        return response()->json($response);
    }
}
