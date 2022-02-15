<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller{

    // public function __construct(){
    //     return $this->middleware('auth:admin');
    // }

    public function index(Request $request){
        $input          = array_map('trim', $request->all());
        $establishments = \App\Establishment::all();
        // dd($input);
        $event = Event::with('establishment')
                      ->where(function ($query) use ($input){
                            if(!empty($input)){
                                if($input['title']){
                                    $query->where('title', 'like', "%{$input['title']}%");
                                }
                                if($input['description']){
                                    $query->where('description', 'like', "%{$input['description']}%");
                                }
                                if($input['establishment_id']){
                                    $query->where('establishment_id', '=', $input['establishment_id']);
                                }
                                if($input['event_date']){
                                    $query->where('event_date', '=', $input['event_date']);
                                }
                                if($input['type']){
                                    $query->where('type', '=', $input['type']);
                                }
                            }
                        });

        $countEvent = $event->get()->count();
        $events     = $event->paginate(10);

        return view('admin.events', compact('events', 'countEvent', 'establishments'));
    }

    public function store(Request $request) {
        $input = array_map('trim', $request->all());

        $rules = [
            "title"            => "required",
            "description"      => "required",
            "establishment_id" => "required",
            "event_date"       => "required",
            "type"             => "required"
        ];
        
        $messages = [
            "title.required"            => "O campo título é obrigatório",
            "description.required"      => "O campo descrição é obrigatório",
            "establishment_id.required" => "O campo estabelecimento é obrigatório",
            "event_date.required"       => "O campo data do evento é obrigatório",
            "type.required"             => "O campo título é obrigatório"
        ];

        $validator = Validator::make($input, $rules, $messages);

        if($validator->passes()){
            unset($input['_token']);

            Event::create($input);

            return redirect('admin/eventos')->with(['success' => "Evento cadastrado"]);
        } else {
            return redirect('admin/eventos')->withErrors($validator)->withInput()->with(['form_error' => 'Store']);
        }
    }

    public function getEvent(Event $event, Request $request){
        return $event->findOrFail($request->id);
    }

    public function update(Request $request, Event $event){
        $event = $event->find($request->id);

        if(!$event){
            return redirect('admin/eventos')->with(['error' => "Evento não encontrado"]);
        } else {

            $input = array_map('trim', $request->all());

            $rules = [
                "title"            => "required",
                "description"      => "required",
                "establishment_id" => "required",
                "event_date"       => "required",
                "type"             => "required"
            ];
            
            $messages = [
                "title.required"            => "O campo título é obrigatório",
                "description.required"      => "O campo descrição é obrigatório",
                "establishment_id.required" => "O campo estabelecimento é obrigatório",
                "event_date.required"       => "O campo data do evento é obrigatório",
                "type.required"             => "O campo título é obrigatório"
            ];

            $validator = Validator::make($input, $rules, $messages);

            if($validator->passes()){
                unset($input['_token']);

                $event->update($input);

                return redirect('admin/eventos')->with(['success' => "Evento editado"]);
            } else {
                return redirect('admin/eventos')->withErrors($validator)->withInput()->with(['form_error' => 'Update']);
            }
        }
    }

    public function getEvents(Event $events){
        return $events->all();
    }

    public function destroy(Request $request, Event $event){
        $event = $event->findOrFail($request->id);

        if($event){
            $event->delete();

            return redirect('admin/eventos')->with(['success' => "Evento inativado"]);
        } else {
            return redirect('admin/eventos')->with(['error' => "Evento não encontrado"]);
        }
    }
}