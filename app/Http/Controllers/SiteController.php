<?php

namespace App\Http\Controllers;

use App\Establishment;
use App\Event;
use App\EventsParticipants;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller{

    public function index(){
        $liveEvents   = Event::with('establishment')->orderBy('created_at', "desc")->where('type', 'presencial')->limit(8)->get();
        $onlineEvents = Event::with('establishment')->orderBy('created_at', "desc")->where('type', 'online')->limit(8)->get();

        return view('index', compact('liveEvents', 'onlineEvents'));
    }

    public function contact(){
        return view('contact');
    }

    public function events(Request $request){
        $input = array_map('trim', $request->all());
        
        $events = Event::select('events.*')
                       ->with('establishment')
                       ->join('establishment', 'events.establishment_id', '=', 'establishment.id')
                       ->where(function ($query) use ($input){
                            if(!empty($input)){
                                if(isset($input['title'])){
                                    $query->where('title', 'like', "%{$input['title']}%");
                                }
    
                                if(isset($input['type'])){
                                    $query->where('type', '=', $input['type']);
                                }
    
                                if(isset($input['date_from']) && isset($input['date_to'])){
                                    $query->whereBetween('event_date', [$input['date_from'], $input['date_to']]);
                                } else if(isset($input['date_from']) && !isset($input['date_to'])){
                                    $query->whereDate('event_date', '>=', $input['date_from']);
                                } else if(!isset($input['date_from']) && isset($input['date_to'])){
                                    $query->whereDate('event_date', '<=', $input['date_to']);
                                }

                                if(isset($input['time_from']) && isset($input['time_to'])){
                                    $query->whereTime('event_date', '>=', $input['time_from']);
                                    $query->whereTime('event_date', '<=', $input['time_to']);
                                } else if(isset($input['time_from']) && !isset($input['time_to'])){
                                    $query->whereTime('event_date', '>=', $input['time_from']);
                                } else if(!isset($input['time_from']) && isset($input['time_to'])){
                                    $query->whereTime('event_date', '<=', $input['time_to']);
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
                       })
                       ->orderBy('events.created_at', "desc")
                       ->paginate(10);

        return view('events', compact('events'));
    }

    public function event($id){
        $event = Event::with('establishment')->findOrFail($id);
        $userParticipating = EventsParticipants::where('event_id', $id)->where('user_id', Auth::id())->first();

        return view('event', compact('event', 'userParticipating'));
    }

    public function confirmParticipation(Request $request){
        $input = array_map('trim', $request->all());
        $input['user_id'] = Auth::id();
        
        $userParticipating = EventsParticipants::where('event_id', $input['event_id'])->where('user_id', $input['user_id'])->first();

        if($userParticipating){
            return back()->with(['error' => "Você já está participando deste evento"]);
        } else {
            unset($input['_token']);

            $confirmAttendance = EventsParticipants::create($input);

            return back()->with(['success' => "Participação confirmada com sucesso!"]);
        }
    }

    public function cancelParticipation(Request $request){
        $input = array_map('trim', $request->all());
        $input['user_id'] = Auth::id();
        
        $userParticipating = EventsParticipants::where('event_id', $input['event_id'])->where('user_id', $input['user_id'])->first();

        if($userParticipating){
            if($userParticipating->delete()){
                return back()->with(['success' => "Participação desmarcada com sucesso!"]);
            } else {
                return back()->with(['error' => "Ocorreu um erro ao desmarcar a sua participação"]);
            }

        } else {
            return back()->with(['error' => "Você não está participando deste evento"]);
        }
    }

    public function searchEvents(Request $request){
        $input = array_map('trim', $request->all());
        
        $events = Event::select('events.*')
                       ->with('establishment')
                       ->join('establishment', 'events.establishment_id', '=', 'establishment.id')
                       ->where(function ($query) use ($input){
                            if(!empty($input)){
                                if(isset($input['title'])){
                                    $query->where('title', 'like', "%{$input['title']}%");
                                }
                            }
                       })
                       ->orderBy('events.created_at', "desc")
                       ->paginate(10);

        return view('events', compact('events'));
    }

}