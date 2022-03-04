<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(Request $request){
        $input = array_map('trim', $request->all());

        $user = User::where(function ($query) use ($input){
                            if(!empty($input)){
                                if(isset($input['name'])){
                                    $query->where('name', 'like', "%{$input['name']}%");
                                }
                                if(isset($input['email'])){
                                    $query->where('email', 'like', "%{$input['email']}%");
                                }
                            }
                        });

        $countUser = $user->get()->count();
        $users     = $user->paginate(10);

        return view('admin.users', compact('users', 'countUser'));
    }

    public function store(Request $request) {
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
                User::create([
                    'name'     => $input['name'],
                    'email'    => $input['email'],
                    'password' => bcrypt($input['password'])
                ]);

                return redirect('admin/usuarios')->with(['success' => "Usuário cadastrado"]);
            } else {
                return redirect('admin/usuarios')->with(['error' => "As senhas não combinam"]);
            }
        } else {
            return redirect('admin/usuarios')->withErrors($validator)->withInput()->with(['form_error' => 'Store']);
        }
    }

    public function getUser(User $user, Request $request){
        return $user->findOrFail($request->id);
    }

    public function update(Request $request, User $user){
        $user = $user->find($request->id);

        if(!$user){
            return redirect('admin/usuarios')->with(['error' => "Usuário não encontrado"]);
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
    
                    return redirect('admin/usuarios')->with(['success' => "Usuário editado"]);
                } else {
                    return redirect('admin/usuarios')->with(['error' => "As senhas não combinam"]);
                }

            } else {
                return redirect('admin/usuarios')->withErrors($validator)->withInput()->with(['form_error' => 'Update']);
            }
        }
    }

    public function getUsers(User $users){
        return $users->all();
    }

    public function destroy(Request $request, User $user){
        $user = $user->findOrFail($request->id);

        if($user){
            $user->delete();

            return redirect('admin/usuarios')->with(['success' => "Usuário inativado"]);
        } else {
            return redirect('admin/usuarios')->with(['error' => "Usuário não encontrado"]);
        }
    }
}