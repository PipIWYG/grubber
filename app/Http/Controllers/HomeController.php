<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use PipIWYG\GitFo;

class HomeController extends Controller {
	
	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$gitFo = new GitFo\GitFo();
		$params = ["repoInfo" => $gitFo->info];
		
		if (Auth::check())
			return view('dashboard',$params);
		
		return view('auth.login',$params);
	}

}
