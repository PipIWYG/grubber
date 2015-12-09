<?php namespace App\Libraries;

use App\Exceptions\CentralException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ParseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

use App\Libraries\JsonValidate;

class JsonRequest
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
    public static function submit($uri, $data, $type = 'post')
    {
        // Check for empty URI
        if (empty($uri))
            return JsonResponse::respondToRequest(Response::HTTP_NOT_FOUND, "JsonRequest::submit() expects the first argument to be a non-empty string, and a valid API endpoint URI", 'error');
        
        // Check for null
        if (is_null($data))
            return JsonResponse::getInvalidJsonResponse();
        
        // Check data passed to request, and validate.
        if (!is_array($data) && !empty($data))
        {
            // Get a validator object to make sure that our JsonResponse contains valid data
            $validate = new JsonValidate();
            
            // Validate Data
            if ($validate->valid($data))
                // Convert Json Data into Array
                $data = json_decode($data, true);
            else
                // Return Json Error Response
                return JsonResponse::getJsonErrorResponse(Response::HTTP_UNPROCESSABLE_ENTITY, json_last_error());
        }
        
        // Create a Guzzle instance
        $client = new Client([
            'defaults' => [
                'verify' => false, // this will have Guzzle ignore invalid SSL certificate errors
            ]
        ]);
        
        // Attempt to Send the request to the given API Endpoint URI
        try
        {
            $response = $client->$type($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'body' => json_encode($data),
                'allow_redirects' => false,
                'timeout' => 60
            ]);
        }
        catch (\GuzzleHttp\Exception\ClientException $ce)
        {
            // Catch Client Exception and attempt to create response
            return JsonResponse::getResponseFromException($ce);
        }
        catch (\Exception $e)
        {
            // Catch Client Exception and attempt to create response
            return JsonResponse::getResponseFromException($e);
        }
        
        // Get JsonResponse
        $jsonResponse = $response->getBody()->getContents();
        
        // Decoded
        $jsonData = json_decode($jsonResponse, true);
        
        // Get a validator object to make sure that our JsonResponse contains valid data
        $validate = new JsonValidate();
        
        // Validate response json
        if ($validate->valid(json_encode($jsonData)))
        {
            /*****************************************************************************************************************************
             * NOTE: This is the ONLY place where a success response will be returned
             *****************************************************************************************************************************/
            
            // Success, but just to be sure, check that we have the required fields, or use default values if we don't
            $statusCode = ((isset($jsonData["code"])) ? $jsonData["code"] : Response::HTTP_INTERNAL_SERVER_ERROR);
            $details = ((isset($jsonData["details"])) ? $jsonData["details"] : "An unknown error has occurred. Your request could not be processed");
            $type = ((isset($jsonData["code"]) && isset($jsonData["details"])) ? "success" : "error");
            
            // Return Result
            return JsonResponse::respondToRequest($statusCode, $details, $type);
        }
        
        // Return Result
        return JsonResponse::respondToRequest($jsonData["code"], $jsonData["details"], 'error');
    }
    
    /**
     * Send a Json Request to the provided API endpoint
     *
     * @param string $uri The Endpoint URI
     * @param array $data The input data to send to the endpoint
     * @param string $type (Optional) The request type. Default: post
     *
     * @return string Json Encoded String response
     */
    public static function send($uri, array $data = [], $type = 'post')
    {
        if (empty($uri))
            throw new CentralException('JsonRequest::send() expects the first argument to be a non-empty string, and a valid API endpoint URI');
        
        // Create a Guzzle instance
        $client = new Client([
            'defaults' => [
                'verify' => false, // this will have Guzzle ignore invalid SSL certificate errors
            ]
        ]);
        
        // Attempt to Send the request to the given API Endpoint URI
        try {
            $response = $client->$type($uri, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ],
                'body' => json_encode($data),
                'allow_redirects' => false,
                'timeout' => 60
            ]);
        } catch (RequestException $e) {
            echo $e->getRequest()."\n";
            if ($e->hasResponse())
                echo $e->getResponse()."\n";
            
            return false;
        }
        
        // Return
        return $response->getBody()->getContents();
    }
}