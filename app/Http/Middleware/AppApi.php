<?php

namespace App\Http\Middleware;

use Closure;
use AuthJwt;
use Illuminate\Http\Request;

class AppApi
{
    public function handle(Request $request, Closure $next)
    {
        $acceptLanguage = $request->lang ? $request->lang : $request->header('accept-language');
		$request->request->set('language', $acceptLanguage ?? 'en');
        $auth = $request->bearerToken();
		$deviceId = $request->header('device-id');
		$request->request->set('device_id', $deviceId);
        if (ltrim($auth, 'Bearer ')) {
			$token = str_replace('Bearer ', '', $auth);
			$user = AuthJwt::decryptAuth($token);
			if ($user) {
				// if ($user->id_card) {
				// 	$request->request->set('id_card', $user->id_card);
				// 	return $next($request);
				// }
			}
		}
        return $next($request);
    }
}
