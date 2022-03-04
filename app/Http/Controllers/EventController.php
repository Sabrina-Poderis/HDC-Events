<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller{

    public function __construct(){
        $this->middleware('admin');
    }

    public function index(Request $request){
        $input          = array_map('trim', $request->all());
        $establishments = \App\Establishment::all();
        
        $event = Event::with('establishment')
                      ->where(function ($query) use ($input){
                            if(!empty($input)){
                                if(isset($input['title'])){
                                    $query->where('title', 'like', "%{$input['title']}%");
                                }
                                if(isset($input['description'])){
                                    $query->where('description', 'like', "%{$input['description']}%");
                                }
                                if(isset($input['establishment_id'])){
                                    $query->where('establishment_id', '=', $input['establishment_id']);
                                }
                                if(isset($input['event_date'])){
                                    $query->where('event_date', '=', $input['event_date']);
                                }
                                if(isset($input['type'])){
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
            if($request->hasFile('image')){
                $eventImage = $request->file('image');
            } else {
                $eventImage = null;
            }
                
            unset($input['_token']);
            unset($input['image']);

            $event = Event::create($input);

            $resultSaveImage = $this->saveEventImage($event->id, $eventImage);

            if(!$resultSaveImage){
                return redirect('admin/eventos')->with(['error' => $resultSaveImage]);
            }

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
                if($request->hasFile('image')){
                    $eventImage = $request->file('image');
                } else {
                    $eventImage = null;
                }
                
                unset($input['_token']);
                unset($input['image']);

                $event->update($input);

                $resultSaveImage = $this->saveEventImage($event->id, $eventImage);

                if(!$resultSaveImage){
                    return redirect('admin/eventos')->with(['error' => $resultSaveImage]);
                }

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

    private function saveEventImage($id, $file){
        $event = Event::find($id);

        if($file){
            $extension = strtolower($file->getClientOriginalExtension());
            
            $size = $file->getSize();
            $size = $size / 1024 / 1024;

            if($extension != 'jfif' && $extension != 'png' && $extension != 'pjp' && $extension != 'pjpeg' && $extension != 'jpg' && $extension != 'jpeg'){ 
                return "O formato da imagem é inválido, por favor envie somente jpg ou png com tamanho máximo de 10MB";
            } else if($size >= 11){
                return "O tamanho da imagem ultrapassa o limite, por favor envie somente jpg ou png com tamanho máximo de 10MB";
            } else {
                $fileNameEventImage = 'event_' . $event->id . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('uploads/img/events');
                $file->move($destinationPath, $fileNameEventImage);
            }
        } else {
            $fileNameEventImage = isset($event->image) ? $event->image : null;
        }

        $event->update(['image' => $fileNameEventImage]);

        return true;
    }

}