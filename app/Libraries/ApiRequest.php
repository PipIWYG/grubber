<?php namespace App\Libraries;

use Illuminate\Http\Response;

use App\Libraries\ApiResponse;;

class ApiRequest
{
    /**
     * Submit a Json Request to the provided API endpoint
     * 
     * @param string $uri The Endpoint URI
     * @param array $data The input data to send to the endpoint
     * @param string $type (Optional) The request type. Default: post
     *
     * @return JsonResponse A Json Encoded Response Object
     */
    public static function SendRequest($uri, $data, $type = 'post')
    {
        return ApiResponse::CreateResponse(
            Response::HTTP_INTERNAL_SERVER_ERROR,
            "Invalid API Resource",
            'error'
        );
    }
}
