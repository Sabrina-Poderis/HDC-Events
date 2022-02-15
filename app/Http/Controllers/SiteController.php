<?php

namespace App\Http\Controllers;

use App\Establishment;
use App\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SiteController extends Controller{

    public function index(){
        $topEvents    = Event::with('establishment')->orderBy('created_at', "desc")->limit(3)->get()->toArray();
        $liveEvents   = Event::with('establishment')->orderBy('created_at', "desc")->where('type', 'presencial')->limit(8)->get()->toArray();
        $onlineEvents = Event::with('establishment')->orderBy('created_at', "desc")->where('type', 'online')->limit(8)->get()->toArray();

        return view('index', compact('topEvents', 'liveEvents', 'onlineEvents'));
    }

    public function contact(){
        return view('contact');
    }

    public function events(Request $request){
        $events = Event::with('establishment')
                       ->where(function ($query) use ($request){
                            if($request->has('nome')){
                               $query->where('nome', 'like', "%$request->nome%");
                            }
                            if($request->has('tipo')){
                                $query->where('tipo', '=', "$request->tipo");
                            }  
                            if($request->has('status')){
                                $query->where('status', '=', "$request->status");
                            }
                       })
                       ->orderBy('created_at', "desc")
                       ->paginate(10);

        return view('events', compact('events'));
    }

    public function event($id){
        $event = Event::with('establishment')->findOrFail($id);

        return view('event', compact('event'));
    }

}