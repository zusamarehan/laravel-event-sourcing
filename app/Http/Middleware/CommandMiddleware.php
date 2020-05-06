<?php

namespace App\Http\Middleware;

use App\Command;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CommandMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->isMethod('post') || $request->isMethod('patch') || $request->isMethod('delete')) {
            //
            $command = new Command;
            $command->uuid = Str::uuid();
            $command->module = $request->get('module');
            $command->action = $request->method();
            $command->attributes = $request->except(['module', '_token', '_method']);
            $command->save();

            $request->request->add(['_pudding_command' => $command]);
        }
        return $next($request);
    }
}
