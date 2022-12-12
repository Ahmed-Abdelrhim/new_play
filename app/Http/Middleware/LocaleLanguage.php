<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
class LocaleLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //We have two solutions => first the user didn't set locale yet . second => the user already set locale to his preferred language

        //If Request Doesn't have locale lang set => session to the value in database
        if (Auth::guard('author')->check() && !Session::has('locale')) {
            // $locale = $request->user()->locale;
            $locale = Auth::guard('author')->user()->locale;
            Session::put('locale',$locale);
        }

        //If Request has locale lang set => session to user preferred language
        if ($request->has('locale')) {
            $locale = $request->get('locale');
            Session::put('locale',$locale);
        }

        //set language to the value in the session
        $locale = Session::get('locale');
        App::setLocale($locale);
        return $next($request);

    }
}
