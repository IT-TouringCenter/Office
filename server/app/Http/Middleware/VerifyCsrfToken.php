<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */

	public function handle($request, Closure $next)
	{
		return parent::handle($request, $next);
	}

	// protected $excludeRoutes = ['charge'];

	// public function handle($request, Closure $next){
    //     foreach($this -> excludeRoutes as $route){
    //         if($request -> is($route)) return $next($request);
    //     }
    //     return parent::handle($request, $next);
    // }
}
