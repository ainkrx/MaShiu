<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index () {
        if (!Session::exists('locale')) {
            Session::put('locale', 'en');
            App::setlocale('en');
        }
        return view('index');
    }

    public function setLang ($locale) {
        Session::forget('locale');
        Session::put('locale', $locale);
        App::setlocale($locale);
        return redirect()->back();
    }
}
