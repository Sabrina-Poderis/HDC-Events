<?php

namespace App\Http\Controllers;

use App\Establishment;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

        return view('event', compact('event'));
    }

}