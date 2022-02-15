<?php

namespace App\Http\Controllers\UserAuth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller{

    use RegistersUsers;

    protected $redirectTo = '/eventos';

    public function __construct(){
        $this->middleware('user.guest');
    }

    protected function guard(){
        return Auth::guard('user');
    }

    public function register(Request $request){
        $data = $request->toArray();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        if($user){
            event(new Registered($user));
            $this->guard()->login($user);

            return $this->registered($request, $user) ?: redirect($this->redirectPath());
        } else{
            return back()->with(["error" => "Ocorreu um erro durante o cadastro. Por favor tente novamente mais tarde"]);
        } 
    }


}
