<?php

namespace App\Http\Middleware;

use App\Country;
use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class Locator
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
        if($request->route('country')){
            $phoneCode = Country::where('iso', strtoupper($request->route('country')))->first();
            if($phoneCode){
                Session::put([
                    'flag' => strtolower($phoneCode->iso),
                    'country' => ucfirst($phoneCode->name),
                    'iso'=>strtoupper($request->route('country')),
                    'city' => null,
                    'phonecode' => $phoneCode->phonecode,
                ]);
                return $next($request);
            }


        }
        if (!Session::has('country')) {
            $x = geoip('77.87.22.154');

            if (isset($x['iso_code']) && $x['iso_code']) {
                if (isset(Config::get('countries.' . strtolower($x['iso_code']))[0])) {
                    $lang = Config::get('countries.' . strtolower($x['iso_code']))[0];
                } else {
                    $lang = 'en';
                }

                $phoneCode = Country::where('iso', strtoupper($x['iso_code']))->first()->phonecode;
                Session::put([
                    'flag' => strtolower($x['iso_code']),
                    'country' => strtolower($x['country']),
                    'iso'=>strtoupper($x['iso_code']),
                    'city' => strtolower($x['city']),
                    'phonecode' => $phoneCode,
                ]);
            } else {
                Session::put([
                    'flag' => 'sa',
                    'country' => 'Saudi Arabia',
                    'iso'=>'sa',
                    'city' => 'الرياض',
                    'phonecode' => '966',
                ]);
            }
        }
        return $next($request);
    }
}
