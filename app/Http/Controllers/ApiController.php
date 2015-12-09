<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidateRequest;

//use App\Models\User;
//use App\Models\Consultant;

class ApiController extends Controller
{
	
	private $apiValidateRequest = null;
	
	/**
	 * @var array A list of valid API resources
	 */
	private $validRequestResources = [
		"user" => [
			"schema" => "user_request",
		],
		"consultant" => [
			"schema" => "user_request",
		],
		"users" => [
			"schema" => "",
		],
		"consultants" => [
			"schema" => "",
		],
	];
	
    public function __construct()
	{
		// Set Middleware
        $this->middleware('api.v1');
		
		$this->apiValidateRequest = new ApiValidateRequest();
    }
	
    public function requestDefaultResource($requestUri = null, $id = null)
	{
		if (!is_null($requestUri) && !$this->isValidApiResource($requestUri))
			// Return Default invalid resource response
			return ApiResponse::CreateResponse(ApiResponse::API_INVALID_RESOURCE);
		
		if (!is_null($requestUri)) {
			switch($requestUri) {
				case "user":
					return $this->requestUser($requestUri,$id);
					break;
				
				case "consultant":
					return $this->requestConsultant($requestUri,$id);
					break;
				
				case "users":
					return $this->requestUsers();
					break;
				
				case "consultants":
					return $this->requestConsultants();
					break;
			}
		}
		
		// Return Default invalid resource response
		return ApiResponse::CreateResponse(ApiResponse::API_INVALID_RESOURCE);
    }
	
	public function requestUser($requestUri, $id = null) {
		$data = ((request()->isMethod('post')) ? request()->all() : ["id" => $id]);
		
		$input = [
			"resource" => $requestUri,
			"params" => $data,
		];
		
		//$schema = $this->validRequestResources[$requestUri]["schema"];
		//$validated = $this->apiValidateRequest->check(json_encode($data), $schema);
		//
		//if (!$validated) {
		//	return [
		//		"request" => [
		//			"resource" => $input["resource"],
		//			"params" => $input["params"],
		//			"valid" => $this->apiValidateRequest->valid(json_encode($input)),
		//			"validated" => $validated,
		//			"errors" => $this->apiValidateRequest->getErrors()
		//		]
		//	];
		//}
		
		// Find User
		$user = User::find($data["id"]);
		
		// Return Result
		return (($user) ? ApiResponse::CreateResponse(ApiResponse::API_OK, $user) : ApiResponse::CreateResponse(ApiResponse::API_NOT_FOUND));
	}
	
	public function requestConsultant($requestUri, $id = null) {
		$data = ((request()->isMethod('post')) ? request()->all() : ["id" => $id]);
		
		$input = [
			"resource" => $requestUri,
			"params" => $data,
		];
		
		//$schema = $this->validRequestResources[$requestUri]["schema"];
		//$validated = $this->apiValidateRequest->check(json_encode($data), $schema);
		//
		//if (!$validated) {
		//	return [
		//		"request" => [
		//			"resource" => $input["resource"],
		//			"params" => $input["params"],
		//			"valid" => $this->apiValidateRequest->valid(json_encode($input)),
		//			"validated" => $validated,
		//			"errors" => $this->apiValidateRequest->getErrors()
		//		]
		//	];
		//}
		
		// Find User
		$consultant = Consultant::find($data["id"]);
		
		// Return Result
		return (($consultant) ? ApiResponse::CreateResponse(ApiResponse::API_OK, $consultant) : ApiResponse::CreateResponse(ApiResponse::API_NOT_FOUND));
	}
	
    public function requestUsers()
    {
		// Check Method
        if (request()->isMethod('get'))
			// Return Success Response
			return ApiResponse::CreateResponse(ApiResponse::API_OK, User::all());
        
		// Return Errpr Response
		return ApiResponse::CreateResponse(ApiResponse::API_METHOD_NOT_ALLOWED);
    }
    
    public function requestConsultants()
    {
		// Check Method
        if (request()->isMethod('get'))
			// Return Success Response
			return ApiResponse::CreateResponse(ApiResponse::API_OK, Consultant::all());
        
		// Return Errpr Response
		return ApiResponse::CreateResponse(ApiResponse::API_METHOD_NOT_ALLOWED);
    }
	
	
	private function isValidApiResource($resource) {
		return array_key_exists($resource, $this->validRequestResources);
	}
}
