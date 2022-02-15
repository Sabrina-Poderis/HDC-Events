<?php

namespace App\Http\Controllers\UserAuth;

use App\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hesto\MultiAuth\Traits\LogsoutGuard;

class LoginController extends Controller{
    use AuthenticatesUsers, LogsoutGuard {
        LogsoutGuard::logout insteadof AuthenticatesUsers;
    }

    public $redirectTo = '/eventos';

    public function __construct()
    {
        $this->middleware('user.guest', ['except' => 'logout']);
    }

    protected function guard()
    {
        return Auth::guard('user');
    }
}
