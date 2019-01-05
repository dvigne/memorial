<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SentryContext
{
  /**
  * Handle an incoming request.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \Closure  $next
  * @return mixed
  */
  public function handle($request, Closure $next)
  {
      if (app()->bound('sentry')) {
        /** @var \Raven_Client $sentry */
        $sentry = app('sentry');

        // Add user context
        if (Auth()->check()) {
          $sentry->user_context([
            'id' => Auth::user()->id,
            'email' => Auth::user()->email,
            'First Name' => Auth::user()->first,
            'Last Name' => Auth::user()->last
          ]);
        }
        // else {
        //     $sentry->user_context(['session_id' => null]);
        // }
      }
      
      return $next($request);
  }
}
