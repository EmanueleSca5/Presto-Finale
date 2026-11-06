<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
/**
* Handle an incoming request.
*
* @param  Closure(Request): (Response)  $next
*/
public function handle(Request $request, Closure $next, User $user): Response
{
  if(! $request->user()?->isAdmin()){
      abort(403);
  }
  return $next($request);
}
}
