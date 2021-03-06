<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Establishment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EstablishmentController extends Controller{

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(Request $request){
        $input = array_map('trim', $request->all());

        $establishment = Establishment::where(function ($query) use ($input){
                            if(!empty($input)){
                                if(isset($input['name'])){
                                    $query->where('name', 'like', "%{$input['name']}%");
                                }
                                if(isset($input['cnpj'])){
                                    $query->where('cnpj', 'like', "%{$input['cnpj']}%");
                                }
                                if(isset($input['address'])){
                                    $query->where('address', 'like', "%{$input['address']}%");
                                }
                                if(isset($input['address_number'])){
                                    $query->where('address_number', 'like', "%{$input['address_number']}%");
                                }
                                if(isset($input['address_addon'])){
                                    $query->where('address_addon', 'like', "%{$input['address_addon']}%");
                                }
                                if(isset($input['district'])){
                                    $query->where('district', 'like', "%{$input['district']}%");
                                }
                                if(isset($input['city'])){
                                    $query->where('city', 'like', "%{$input['city']}%");
                                }
                                if(isset($input['uf'])){
                                    $query->where('uf', 'like', "%{$input['uf']}%");
                                }
                                if(isset($input['cep'])){
                                    $query->where('cep', 'like', "%{$input['cep']}%");
                                }
                            }
                        });

        $countEstablishment = $establishment->get()->count();
        $establishments     = $establishment->paginate(10);

        return view('admin.establishments', compact('establishments', 'countEstablishment'));
    }

    public function store(Request $request) {
        $input = array_map('trim', $request->all());

        $rules = [
            "name"           => "required",
            "cnpj"           => "required",
            "address"        => "required",
            "address_number" => "required",
            "district"       => "required",
            "city"           => "required",
            "uf"             => "required",
            "cep"            => "required"
        ];

        $messages = [
            "name.required"           => "O campo nome ?? obrigat??rio",
            "cnpj.required"           => "O campo CNPJ ?? obrigat??rio",
            "address.required"        => "O campo endere??o ?? obrigat??rio",
            "address_number.required" => "O campo n??mero ?? obrigat??rio",
            "district.required"       => "O campo bairro ?? obrigat??rio",
            "city.required"           => "O campo cidade ?? obrigat??rio",
            "uf.required"             => "O campo UF ?? obrigat??rio",
            "cep.required"            => "O campo CEP ?? obrigat??rio"
        ];

        $validator = Validator::make($input, $rules, $messages);

        if($validator->passes()){
            unset($input['_token']);

            Establishment::create($input);

            return redirect('admin/estabelecimentos')->with(['success' => "Estabelecimento cadastrado"]);
        } else {
            return redirect('admin/estabelecimentos')->withErrors($validator)->withInput()->with(['form_error' => 'Store']);
        }
    }

    public function getEstablishment(Establishment $establishment, Request $request){
        return $establishment->findOrFail($request->id);
    }

    public function update(Request $request, Establishment $establishment){
        $establishment = $establishment->find($request->id);

        if(!$establishment){
            return redirect('admin/estabelecimentos')->with(['error' => "Estabelecimento n??o encontrado"]);
        } else {

            $input = array_map('trim', $request->all());

            $rules = [
                "name"           => "required",
                "cnpj"           => "required",
                "address"        => "required",
                "address_number" => "required",
                "district"       => "required",
                "city"           => "required",
                "uf"             => "required",
                "cep"            => "required"
            ];
    
            $messages = [
                "name.required"           => "O campo nome ?? obrigat??rio",
                "cnpj.required"           => "O campo CNPJ ?? obrigat??rio",
                "address.required"        => "O campo endere??o ?? obrigat??rio",
                "address_number.required" => "O campo n??mero ?? obrigat??rio",
                "district.required"       => "O campo bairro ?? obrigat??rio",
                "city.required"           => "O campo cidade ?? obrigat??rio",
                "uf.required"             => "O campo UF ?? obrigat??rio",
                "cep.required"            => "O campo CEP ?? obrigat??rio"
            ];

            $validator = Validator::make($input, $rules, $messages);

            if($validator->passes()){
                unset($input['_token']);

                $establishment->update($input);

                return redirect('admin/estabelecimentos')->with(['success' => "Estabelecimento editado"]);
            } else {
                return redirect('admin/estabelecimentos')->withErrors($validator)->withInput()->with(['form_error' => 'Update']);
            }
        }
    }

    public function getEstablishments(Establishment $establishments){
        return $establishments->all();
    }

    public function destroy(Request $request, Establishment $establishment){
        $establishment = $establishment->findOrFail($request->id);

        if($establishment){
            $establishment->delete();

            return redirect('admin/estabelecimentos')->with(['success' => "Estabelecimento inativado"]);
        } else {
            return redirect('admin/estabelecimentos')->with(['error' => "Estabelecimento n??o encontrado"]);
        }
    }
}