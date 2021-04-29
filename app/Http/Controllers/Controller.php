<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    const HTTP_STATUS_CODE_UNPROCESSABLE_ENTITY = 422;

    public static function failedResponse(array $arrStrErrors = [])
    {
        return response([
            'message' => 'Something went wrong.',
            'errors' => [
                'error' => $arrStrErrors
            ]
        ], self::HTTP_STATUS_CODE_UNPROCESSABLE_ENTITY);
    }

    public static function passResponse(string $strMessage)
    {
        Session::flash('flash_message', $strMessage);

        return response(['message' => $strMessage]);
    }
}
