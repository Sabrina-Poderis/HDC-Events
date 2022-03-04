<?php

namespace App\Http\Controllers\UserAuth;

use App\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    use AuthenticatesUsers;

    public $redirectTo = '/';

    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    protected function guard(){
        return Auth::guard('user');
    }

    public function login(Request $request){  
        $inputVal = $request->all();
        
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
       
        if(auth()->attempt(array('email' => $inputVal['email'], 'password' => $inputVal['password']))){
            if (auth()->user()->is_admin == 1) {
                return redirect('/admin')->with('success','Administrador logado com sucesso');
            }else{
                return redirect('/')->with('success','Usuário logado com sucesso');
            }
        }else{
            return redirect('/')->with('error','E-mail e/ou senha incorretos');
        }     
    }

    public function logout(Request $request){
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/')->with('success',"Usuário deslogado");
    }
}
