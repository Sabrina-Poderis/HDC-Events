<?php

namespace App\Http\Controllers;

use App\Event;
use App\Establishment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller{

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $event = Event::with('establishment');

        $countEvent          = $event->get()->count();
        $countEstablishment  = Establishment::get()->count();
        $countUser           = User::get()->count();

        $events = $event->paginate(10);

        return view('admin.index', compact('events', 'countEvent', 'countEstablishment', 'countUser'));
    }

    public function updateProfile(Request $request, User $user){
        $user = $user->find($request->id);

        if(!$user){
            return redirect('admin/')->with(['error' => "Usuário não encontrado"]);
        } else {

            $input = array_map('trim', $request->all());

            $rules = [
                "name"             => "required",
                "email"            => "required",
                "password"         => "required",
                "confirm_password" => "required"
            ];
    
            $messages = [
                "name.required"             => "O campo nome é obrigatório",
                "email.required"            => "O campo E-Mail é obrigatório",
                "password.required"         => "O campo senha é obrigatório",
                "confirm_password.required" => "O campo de confirmação de senha é obrigatório"
            ];

            $validator = Validator::make($input, $rules, $messages);

            if($validator->passes()){
                unset($input['_token']);

                if($input['password'] == $input['confirm_password']){
                    $user->update([
                        'name'     => $input['name'],
                        'email'    => $input['email'],
                        'password' => bcrypt($input['password'])
                    ]);
    
                    return redirect('admin/')->with(['success' => "Usuário editado"]);
                } else {
                    return redirect('admin/')->with(['error' => "As senhas não combinam"]);
                }

            } else {
                return redirect('admin/')->withErrors($validator)->withInput()->with(['form_error' => 'Update']);
            }
        }
    }
}