<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Libraries\ApiResponse;
use App\Libraries\ApiValidateRequest;

use App\Project;
use App\Api;
//use App\Models\Consultant;

class ApiController extends Controller
{
	
	private $apiValidateRequest = null;
	private $api = null;

    public function __construct()
	{
		// Set Middleware
        $this->middleware('api.v1');
		
		$route = request()->route();
		$params = $route->parameters();
		$paramNames = $route->parameterNames();
		//dd(["route" => $route, "params" => $params, "paramNames" => $paramNames]);
		
		$routePath = "";
		if (count($params) > 0)
			$routePath = $params["requestUri"];
		
		// Get new Api Instance
		$this->api = new Api();
		
		// Return Default invalid resource response if resource lookup failed
		if (!is_null(request()->route()->getUri()) && !$this->api->isValidApiResourceSchema($routePath))
			return ApiResponse::CreateResponse(ApiResponse::API_INVALID_RESOURCE);
		
		// Api Request Validator Initialization
		$this->apiValidateRequest = new ApiValidateRequest();
    }
	
    public function requestApiResource($requestUri = null, $id = null, $subRequestUri = null, $subId = null)
	{
		$valid = (!is_null($requestUri) && $this->api->isValidApiResourceSchema($requestUri));
		if (!$valid)
			return ApiResponse::CreateResponse(ApiResponse::API_INVALID_RESOURCE);
		
		$apiModel = $this->api->validRequestResourceSchema[$requestUri]["model"];
		$model = new $apiModel;
		
		//$subData = $model->$subRequestUri();
		if ($subRequestUri != null) {
			//dd($data);
			$subModel = $this->api->validRequestResourceSchema[$subRequestUri]["model"];
			$smodel = new $subModel; 
			$subData = $model->$subRequestUri()->get();
			//$data[$subRequestUri] = $subData;
		}
		
		
		if (!$valid || is_null($requestUri))
			return ApiResponse::CreateResponse(ApiResponse::API_INVALID_RESOURCE);
		
		return $this->getApiResourceData($requestUri,$id,$subRequestUri, $subId);
    }
	
	public function getApiResourceData($requestUri, $id = null, $subRequestUri = null, $subId = null) {
		$apiMode = $this->api->validRequestResourceSchema[$requestUri]["mode"];
		$isSingle = ($apiMode == "single");
		$requestData = request()->all();
		$data = [];
		
		$apiModel = $this->api->validRequestResourceSchema[$requestUri]["model"];
		$model = new $apiModel;
		
		if ($isSingle && $id != null)
			$data = $model::find($id);
		else {
			if ((!$isSingle && $id != null) || ($isSingle && $id == null))
				return ApiResponse::CreateResponse(ApiResponse::API_NOT_FOUND);
			$data = $model::all();
		}
		
		//$subData = $model->$subRequestUri();
		if ($subRequestUri != null) {
			$subModel = $this->api->validRequestResourceSchema[$subRequestUri]["model"];
			$smodel = new $subModel; 
			//$subData = $smodel->all();
			$subData = $model->$subRequestUri();
			$data[$subRequestUri] = $subData->get();
			//dd($subData->get());
		}
		
		// Return Result
		return (($data) ? ApiResponse::CreateResponse(ApiResponse::API_OK, $data) : ApiResponse::CreateResponse(ApiResponse::API_NOT_FOUND));
	}
	
	/*
	 		//
		//$input = [
		//	"resource" => $requestUri,
		//	"params" => $requestData,
		//];
		//dd($input);
		//$schema = $this->validRequestResourceSchema[$requestUri]["schema"];
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
	*/
	
	//public function requestConsultant($requestUri, $id = null) {
	//	$data = ((request()->isMethod('post')) ? request()->all() : ["id" => $id]);
	//	
	//	$input = [
	//		"resource" => $requestUri,
	//		"params" => $data,
	//	];
	//	
	//	//$schema = $this->validRequestResourceSchema[$requestUri]["schema"];
	//	//$validated = $this->apiValidateRequest->check(json_encode($data), $schema);
	//	//
	//	//if (!$validated) {
	//	//	return [
	//	//		"request" => [
	//	//			"resource" => $input["resource"],
	//	//			"params" => $input["params"],
	//	//			"valid" => $this->apiValidateRequest->valid(json_encode($input)),
	//	//			"validated" => $validated,
	//	//			"errors" => $this->apiValidateRequest->getErrors()
	//	//		]
	//	//	];
	//	//}
	//	
	//	// Find User
	//	$consultant = Consultant::find($data["id"]);
	//	
	//	// Return Result
	//	return (($consultant) ? ApiResponse::CreateResponse(ApiResponse::API_OK, $consultant) : ApiResponse::CreateResponse(ApiResponse::API_NOT_FOUND));
	//}
	
//    public function requestUsers()
//    {
//		// Check Method
//        if (request()->isMethod('get'))
//			// Return Success Response
//			return ApiResponse::CreateResponse(ApiResponse::API_OK, Project::all());
//        
//		// Return Errpr Response
//		return ApiResponse::CreateResponse(ApiResponse::API_METHOD_NOT_ALLOWED);
//    }
//    
//    public function requestConsultants()
//    {
//		// Check Method
//        if (request()->isMethod('get'))
//			// Return Success Response
//			return ApiResponse::CreateResponse(ApiResponse::API_OK, Consultant::all());
//        
//		// Return Errpr Response
//		return ApiResponse::CreateResponse(ApiResponse::API_METHOD_NOT_ALLOWED);
//    }
	
	
}
