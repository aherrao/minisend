<?php

namespace App\Models\ApiLog;

use App\Models\BaseModel;

class ApiLog extends BaseModel {

    public static function log(array $response, $apiLogId = null)
    {
        if(!is_null($apiLogId)) {
           $objApiLog = self::find($apiLogId);
        } else {
            $objApiLog =  new self();
        }

        if(!empty($response['url'])) {
            $objApiLog->url = $response['url'];
        }

        if(!empty($response['request'])) {
            $objApiLog->request = json_encode($response['request']);
        }

        if(!empty($response['response'])) {
            $objApiLog->response = json_encode($response['response']);
        }

        $objApiLog->is_validation_fail = $response['is_validation_fail'] ?? false;
        $objApiLog->is_success = $response['success'] ?? false;
        $objApiLog->save();

        return $objApiLog->id;
    }
}
