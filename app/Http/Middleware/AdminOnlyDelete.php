<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnlyDelete
{
    public function handle(Request $request, Closure $next)
    {
        // Restrict DELETE requests old actual code
        // if ($request->isMethod('delete')) {
        //     if (!Auth::check() || !Auth::user()->hasRole('Admin')) {
        //         abort(403, 'Unauthorized action. You do not have permission to delete.');
        //     }
        // }

        // modifiyed 21-01-2026 start
        if ($request->isMethod('delete')) {
            $user = Auth::user();
            if (!$user || !$user->hasRole('Admin')) {
                // Allow if it's a task delete and user is the creator
                if ($request->route() && $request->route()->getName() === 'tasks.destroy') {
                    $task = $request->route('task');
                    if ($task && $task->created_by === $user->id) {
                        return $next($request);
                    }
                }
                // Allow if it's a leave request delete and user is the owner
                if ($request->route() && $request->route()->getName() === 'leave-requests.destroy') {
                    return $next($request);
                }
                 if ($request->route() && $request->route()->getName() === 'leave-requests.delete-attachment') {
                    return $next($request);
                }
                
                abort(403, 'Unauthorized action. You do not have permission to delete.');
            }
        }
         // modifiyed 21-01-2026 end

        return $next($request);
    }
}
