<?php namespace App\Libraries;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ApiResponse extends ApiResponseBase
{
	
	/**
	 * CreateResponse - Response handler to handle API Requests
	 * 
	 * @param int $statusCode The HTTP Status Code
	 * @param string $statusDescription Custom description returned in response
	 * @param string $type Response type, error or success
	 * 
	 * @return ApiResponse
	 * 
	 * @author Quintin Stoltz
	 */
	public static function CreateResponse($apiStatusCode, $data = [])
    {
        $statusType = ApiResponse::$statusMessages[$apiStatusCode]["status_type"];
        $successStatus = ($statusType == "success") ? true : false;
        $statusCode = ApiResponse::$statusMessages[$apiStatusCode]["status_code"];
        
        $response = [
            "statuscode" => $statusCode,
            "message" => Response::$statusTexts[$statusCode],
            "description" => ApiResponse::$statusCodeMessages[$statusCode],
            "reason" => ApiResponse::$statusMessages[$apiStatusCode]["status_text"],
            "apistatuscode" => $apiStatusCode,
        ];
        
        $result = [];
        if ($statusType == "success") {
            $result = [
                "data" => $data,
                "records" => count($data),
                "date" => date("Y-m-d"),
                "time" => date("H:i:s"),
            ];
        }
        
        $return = [
            "success" => $successStatus
        ];
        
		if ($statusType == "success") {
			$return["response"] = $response;
		} elseif ($statusType == "error") {
			$return["error"] = $response;
		}
        if (!empty($result))
            $return["result"] = $result;
        
        return $return;
	}
}