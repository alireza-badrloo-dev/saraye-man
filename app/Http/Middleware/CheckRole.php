<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        $admin = Auth::guard('admin')->user();
        
        // اگر کاربر لاگین نکرده
        if (!$admin) {
            return redirect()->route('admin.login');
        }
        
        // بررسی نقش (اگر نقشی مشخص شده)
        if (!empty($roles) && !in_array($admin->role, $roles)) {
            abort(403, 'شما دسترسی لازم برای این بخش را ندارید.');
        }
        
        return $next($request);
    }
}