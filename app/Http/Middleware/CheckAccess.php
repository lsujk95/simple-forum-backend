<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccess
{
    const APP_CONTROLLERS_DIR = 'App\\Http\\Controllers\\';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $actionName = null;
        if ($request->route()->getActionName() != "Closure") {
            $actionName = str_replace(self::APP_CONTROLLERS_DIR, "", $request->route()->getActionName());
        } else if ($request->route()->getName()) {
            $actionName = $request->route()->getName();
        } else {
            $actionName = $request->route()->uri();
        }

        if (!$actionName) {
            return response()->json('Internal Server Error', 500);
        }

        if ($request->user() == null) {
            if (config('app.debug')) {
                return response()->json('Unauthenticated (' . $actionName .')', 401);
            } else {
                return response()->json('Unauthenticated', 401);
            }
        }

        if (!$request->user()->hasAction($actionName)) {
            if (config('app.debug')) {
                return response()->json('Unauthorized (' . $actionName . ')', 403);
            } else {
                return response()->json('Unauthorized', 403);
            }
        }

        return $next($request);
    }
}
