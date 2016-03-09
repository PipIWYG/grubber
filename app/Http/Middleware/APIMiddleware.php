<?php namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Api;

//use App\Libraries\JsonValidate;
//use App\Libraries\JsonResponse;

use App\Libraries\ApiResponse;

class APIMiddleware
{
	private $validHosts = [
		"127.0.0.1",
	];
	
	
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * 
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$route = request()->route();
		$params = $route->parameters();
		$paramNames = $route->parameterNames();
		//dd(["route" => $route, "params" => $params, "paramNames" => $paramNames]);
		
		$routePath = "";
		if (count($params) > 0)
			$routePath = $params["requestUri"];
		
		//$routePath = $route->getUri();
		//for($i = 0; $i < count($params); $i++) {
		//	$paramName = $paramNames[$i];
		//	$paramVal = $params[$paramName];
		//	$routePath = preg_replace("/\{".$paramName."\}/", $paramVal, $routePath);
		//	
		//}
		
		if (!in_array(request()->ip(), $this->validHosts))
			return ApiResponse::CreateResponse(ApiResponse::API_INVALID_HOST);
		
        return $next($request);
    }
}
