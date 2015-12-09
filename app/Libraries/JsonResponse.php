<?php namespace App\Libraries;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class JsonResponse
{
    /**
     * getResponse: A wrapper method to retrieve a response object formatted in json
     *
     * @param int $statusCode A valid HTTP Status Code used in the response
     * @param string $message A message used as details for the request
     * @param string $template (Optional) The view to use to output the response
     */
    public static function getResponse($statusCode, $message, $template = 'default-error')
    {
        // Instantiate a new Illuminate\Http\Response object
        $response = new Response();
        
        // Set the Response Status Code
        $response->setStatusCode($statusCode);
        
        // Retrun a json formatted response object, and set object variables from parameters
        return response()->json(
            view('json.'.$template, [
                'message' => Response::$statusTexts[$response->getStatusCode()],
                'details' => $message,
                'code' => $response->getStatusCode()
            ])->getData(),
            $response->getStatusCode()
        );
    }
    
	/**
	 * Get the defailt Invalid Json Response
	 *
	 * @return JsonResponse The Json Response Object
	 */
    public static function getInvalidJsonResponse() {
        return JsonResponse::getJsonErrorResponse(Response::HTTP_UNPROCESSABLE_ENTITY, 4);
    }
    
	/**
	 * Get JSon Error Response
	 *
	 * @param int $statusCode The HTTP Status Code to use for the Response
	 * @param int $json_error_code The Json Error code to look up the error text
	 * 
	 * @return JsonResponse The Json Response Object
	 */
    public static function getJsonErrorResponse($statusCode, $json_error_code) {
        return JsonResponse::respondToRequest($statusCode, JsonResponse::getJsonErrorByCode($json_error_code), 'error');
    }
	
    /**
     * Retrieve response details from exception object
     *
     * @param object $exception The exception object to get response details from
     *
     * @return JsonResponse A Json Encoded Response Object
     */
    public static function getResponseFromException($exception)
    {
        // Only attempt to query the exception object if it contains an actual response
        if ($exception->hasResponse())
        {
            // Get the Json response data from the body of the failed response object, which is passed through the Exception object
            $responseJsonData = $exception->getResponse()->getBody();
            
            // Get a validator object to make sure that our JsonResponse contains valid data
            $validate = new JsonValidate();
            
            // Decode the Json data, into an array
            $responseJson = json_decode($responseJsonData, true);
            
            // Validate response json
            if ($validate->valid(json_encode($responseJson)))
            {
                // Success, but just to be sure, check that we have the required fields, or use default values if we don't
                $statusCode = ((isset($responseJson["code"])) ? $responseJson["code"] : Response::HTTP_INTERNAL_SERVER_ERROR);
                $details = ((isset($responseJson["details"])) ? $responseJson["details"] : "An unknown error has occurred. Your request could not be processed");
                
                // Return Result
                return JsonResponse::respondToRequest($statusCode, $details, 'error');
            } else
                return JsonResponse::getInvalidJsonResponse();
        }
        
        // Return default error response
        return JsonResponse::respondToRequest(Response::HTTP_INTERNAL_SERVER_ERROR, "An unknown error has occurred. Your request could not be processed", 'error');
    }
    
	/**
	 * respondToRequest - Custom response handler to handle HTTP Status Codes for API Calls
	 *
	 * @param int $statusCode The HTTP Status Code
	 * @param string $statusDescription Custom description returned in response
	 * @param string $type Response type, error or success
	 *
	 * @return JsonResponse
	 *
	 * @author Quintin Stoltz
	 */
	public static function respondToRequest($statusCode, $statusDescription, $type = 'success')
    {
		// Create a new instance of a Response Object (Symfony)
		$response = new Response();
        
        // Get status text by passing Response object a status code.
		$statusText = Response::$statusTexts[$statusCode];
        
        // Get the view, and output data onto it.
        $view = view("json.default-".$type, [
            'message' => $statusText,
            'details' => $statusDescription,
            'code' => $statusCode
        ]);
        
		// Return Response
		return response()->json($view->getData(), $statusCode)->setData($view->getData())->setStatusCode($statusCode);
	}
    
	/**
     * Get the Json Error message from Json Error Code
     *
     * @param int $errorCode The Json Error Code
     *
     * @return string An error message based on error code
     *
     * @see http://php.net/manual/en/function.json-last-error.php
     */
    public static function getJsonErrorByCode($errorCode)
    {
        // Return var
        $result = "No Errors";
        
        // Swtich between error codes
        switch ($errorCode)
        {
            case JSON_ERROR_NONE:
                $result = 'No errors';
                break;
            
            case JSON_ERROR_DEPTH:
                $result = 'Maximum stack depth exceeded';
                break;
            
            case JSON_ERROR_STATE_MISMATCH:
                $result = 'Underflow or the modes mismatch';
                break;
            
            case JSON_ERROR_CTRL_CHAR:
                $result = 'Unexpected control character found';
                break;
            
            case JSON_ERROR_SYNTAX:
                $result = 'Syntax error, malformed JSON';
                break;
            
            case JSON_ERROR_UTF8:
                $result = 'Malformed UTF-8 characters, possibly incorrectly encoded';
                break;
            
            default:
                $result = 'Unknown error';
                break;
        }
        
        // Return Result
        return $result;
    }
	
    public static function success($message, $details, $code = 200, $template = 'orca.default-success')
    {
        return response()->json(
            view('json.'.$template, [
                'message' => $message,
                'details' => $details,
                'code' => $code
            ])->getData(),
            $code
        )->header('Content-Type', 'application/json')->getContent();
    }
    
    public static function error($message, $details, $code=500, $template='orca.default-error')
    {
        return response()->json(
                    view('json.'.$template, [
                            'message' => $message,
                            'details' => $details,
                            'code' => $code]
                    )->getData(),
                    $code
                )->header('Content-Type', 'application/json')->getContent();
    }
}

