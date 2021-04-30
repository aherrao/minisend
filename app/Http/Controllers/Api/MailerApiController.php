<?php

namespace App\Http\Controllers\Api;

use App\Helpers\DataHelper;
use App\Http\Controllers\Controller;
use App\Mail\SenderEmail;
use App\Models\ApiLog\ApiLog;
use App\Models\Email\Email;
use App\Models\ApiLog\EmailLog;
use App\Models\EmailAttachment\EmailAttachment;
use App\Models\EmailStatusType\EmailStatusType;
use App\Models\File\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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
            //try {
                $objEmail = new Email();
                $objEmail->email_status_type_id = DataHelper::getStatusTypeId('Posted');
                $objEmail->to_email = $objRequest->input('to_email');
                $objEmail->from_email = $objRequest->input('from_email');
                $objEmail->subject = $objRequest->input('subject');
                $objEmail->body = $objRequest->input('body');
                $objEmail->save();

                if(count($objRequest->attachment)) {
                    $objFile = new File();
                    $objFile->client_id = 1;

                    $emailAttachment =  new EmailAttachment();
                    $emailAttachment->client_id = 1;

                    foreach($objRequest->attachment as $attachment) {
                        $emailAttachment->client_id = 1;
                        $objFile->name = $attachment->getClientOriginalName();
                        $objFile->ext = $attachment->getClientOriginalExtension();
                        $objFile->path = Storage::disk('public')->putFile('/attachments/' . $objEmail->id, $attachment);
                        $objFile->url = Storage::disk('public')->url($objFile->path);
                        $objFile->save();

                        $emailAttachment->email_id = $objEmail->id;
                        $emailAttachment->file_id = $objFile->id;
                        $emailAttachment->save();
                    }
                }

                Mail::to($objEmail->to_email)->send(new SenderEmail($objEmail));

//            } catch (\Exception $e) {
//                $objEmail->email_status_type_id = DataHelper::getStatusTypeId('Fail');
//            }

            $objEmail->save();

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
