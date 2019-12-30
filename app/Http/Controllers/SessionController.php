<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function getSessionAndDelete()
    {
        $nameSession = config('const.session.defaultName');
        $sessionFlash = request()->session()->get($nameSession);
        request()->session()->forget($nameSession);
        return $sessionFlash;
    }

    public function createSession($sessionType, $sessionMessage)
    {
        request()->session()->put(config('const.session.defaultName'), array(
            'type'  => $sessionType,
            'message' => $sessionMessage
        ));
    }
}
