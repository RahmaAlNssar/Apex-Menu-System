<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use Closure;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null, $guard = null,$role=null)
    {

    //     $table = request()->segment(3);
    //    $permissions = [
    //     $table.'-index',
    //     $table.'-create',
    //     $table.'-update',
    //     $table.'-destroy',
    //    ];
       $role = auth()->user()->roles->first();

    //     if($role->hasPermissionTo($permission)){
    //         return $next($request);
    //    }else{
    //     return $this->returnError('unauthorized',403);
    //    }
    if($role == 'admin'){
        return $next($request);
   }else{
    return $this->returnError('unauthorized',403);
   }

    }
}
