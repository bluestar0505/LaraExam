<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Redirector;
use Illuminate\Foundation\Applicaion;
use Illuminate\Http\Request;

class CheckForMaintenanceMode implements Middleware
{

    protected $request;
    protected $app;

    public function __construct(Application $app, Request $request)
    {
        $this->app = $app;
        $this->request = $request;
    }

    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance() &&
            !in_array($this->request->getClientIp(), ['182.185.207.57'])
        ) {
            return response('Be right back!', 503);
        }

        return $next($request);
    }

}