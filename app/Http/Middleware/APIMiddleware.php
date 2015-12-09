<?php namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
		if (!in_array(request()->ip(), $this->validHosts))
			return ApiResponse::CreateResponse(ApiResponse::API_INVALID_HOST);
		
        return $next($request);
    }
}
