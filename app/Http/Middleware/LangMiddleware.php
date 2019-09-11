<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\ Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = optional(Auth::user())->lang ?? 'en';
        App::setLocale($lang);
//        if(Session::has('locale')){
//            App::setLocale($lang);
//        }
        $lang = App::getLocale();
//        View::share('lang',$lang);
        View::share('page_dir',$lang == 'ar' ? 'rtl' : '');
        return $next($request);
    }
}
