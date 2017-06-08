<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeckEvent;
use App\Http\Requests;
use App\Event;
use App\Player;
use App\Deck;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DeckEventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*
        $evento = Eventos::find(1);
        $jugadores = Jugadores::lists('JGD_NOMBRE','JGD_ID');
        //dd($evento);
        $participantes = EventoMazo::where('EVN_ID', 1)
               ->orderBy('EVM_POSICION', 'desc')
               ->get();
        return view('backend.eventosmazos.agregar', compact('evento','participantes','jugadores'));
         * 
         */
        $evento = Event::find(1);
        $jugadores = Player::lists('JGD_NOMBRE','JGD_ID');
        return view('backend.eventosmazos.agregar', compact('evento','jugadores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        
        $idEvento = $request->EVN_ID;
        $eventomazo = new DeckEvent();
        $eventomazo->EVN_ID = $request->EVN_ID;
        $eventomazo->MAZ_ID = $request->MAZ_ID;
        $eventomazo->JGD_ID  = $request->JGD_ID;
        $eventomazo->EVM_NOMBRE_MAZO = $request->EVM_NOMBRE_MAZO;
        $eventomazo->EVM_POSICION = $request->EVM_POSICION;
        $eventomazo->save();
        
        Session::flash('message','Resultado ingresado');
        return redirect::to('/participantes/'.$idEvento);  
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $evento = Event::find($id);
        $jugadores = Player::lists('JGD_NOMBRE','JGD_ID');
        //dd($evento);
        $participantes = DeckEvent::where('EVN_ID', $id)
               ->orderBy('EVM_POSICION', 'desc')
               ->get();
        //dd($jugadores);
        //foreach($participantes as $p){
            //dd($p->ToMazos->MAZ_NOMBRE);
            //dd($p->ToEventos->EVN_NOMBRE);
        //}
        //dd($evento);
        return view('backend.eventosmazos.index', compact('evento','participantes','jugadores'));
    }

    public function createbyget($id)
    {
        $evento = Event::find($id);
        $jugadores = Player::lists('JGD_NOMBRE','JGD_ID');
        $mazos = Deck::orderBy('MAZ_NOMBRE', 'desc')->lists('MAZ_NOMBRE','MAZ_ID');
        return view('backend.eventosmazos.agregar', compact('evento','jugadores','mazos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eventomazo = DeckEvent::find($id);
        dd($eventomazo->EVM_NOMBRE_MAZO);
        $idEvento = $eventomazo->ToEventos->EVN_ID;
        $evento = Event::find($idEvento);
        
        //dd($eventomazo->ToJugadores->JGD_ID);
        
        $jugadores = Player::lists('JGD_NOMBRE','JGD_ID');
        $mazos = Deck::orderBy('MAZ_NOMBRE', 'desc')->lists('MAZ_NOMBRE','MAZ_ID');
        return view('backend.eventosmazos.editar', compact('eventomazo','evento','jugadores','mazos'));
    }

    public function editbyget($id)
    {
        //
        $eventomazo = DeckEvent::find($id);
        $idEvento = $eventomazo->EVN_ID;
        $evento = Event::find($idEvento);
        //dd($eventomazo->ToJugadores->JGD_ID);
        $jugadores = Player::lists('JGD_NOMBRE','JGD_ID');
        $mazos = Deck::orderBy('MAZ_NOMBRE', 'desc')->lists('MAZ_NOMBRE','MAZ_ID');
        return view('backend.eventosmazos.editar', compact('eventomazo','evento','jugadores','mazos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $eventomazo = DeckEvent::find($id);
        $idEvento = $eventomazo->EVN_ID;
        $eventomazo->MAZ_ID = $request->MAZ_ID;
        $eventomazo->JGD_ID  = $request->JGD_ID;
        $eventomazo->EVM_NOMBRE_MAZO = $request->EVM_NOMBRE_MAZO;
        $eventomazo->EVM_POSICION = $request->EVM_POSICION;
        $eventomazo->save();
        Session::flash('message','Resultado actualizado');
        return redirect::to('/participantes/'.$idEvento); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($request->all());
        $idEvn = $request->EVN_ID;
        $idEvm = $request->EVM_ID;
        
        $eventomazo = DeckEvent::destroy($idEvm);
        Session::flash('message','Registro eliminado correctamente');
        return redirect::to('/participantes/'.$idEvn); 
    }
}
