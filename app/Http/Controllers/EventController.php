<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Format;
use App\Store;
use App\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
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
        $eventos = Event::orderBy('EVN_ID','desc')->paginate(10);
       
        return view('backend.eventos.index', compact('eventos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eventos = array();
        $formatos = Format::lists('FTO_NOMBRE', 'FTO_ID');
        $tiendas = Store::lists('TND_NOMBRE', 'TND_ID');
        //$fecha  = date("d/m/Y");
        return view('backend.eventos.agregar', compact('eventos','formatos','tiendas','fecha'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $fecha = $request->FECHA;
       list($dia, $mes, $año) = explode('/', $fecha);
       $fecha = $año.$mes.$dia;
       
       $evento = new Event();
       $evento->EVN_NOMBRE  = $request->EVN_NOMBRE; 
       $evento->EVN_FECHA = $fecha;
       $evento->FTO_ID = $request->FTO_ID; 
       $evento->TND_ID = $request->TND_ID; 
       $evento->save();
       Session::flash('message','Evento '.$request->EVN_NOMBRE.'agregado con exito.');
        return redirect::to('/eventos');
       //dd($evento);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evento = Event::find($id);
        $formatos = Format::lists('FTO_NOMBRE', 'FTO_ID');
        $tiendas = Store::lists('TND_NOMBRE', 'TND_ID');
        
        $fecha = $evento->EVN_FECHA;
        //dd($evento->EVN_FECHA);
        list($año, $mes, $dia) = explode('-', $fecha);
        $fecha = $dia.'/'.$mes.'/'.$año;
        return view('backend.eventos.editar', compact('evento','formatos','tiendas','fecha'));
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
        
        $fecha = $request->FECHA;
        list($dia, $mes, $año) = explode('/', $fecha);
        $fecha = $año.$mes.$dia;
        $evento = Event::find($id);
        $evento->EVN_NOMBRE = $request->EVN_NOMBRE;
        $evento->FTO_ID  = $request->FTO_ID;
        $evento->TND_ID =  $request->TND_ID;
        $evento->EVN_FECHA = $fecha;
        
        $evento->save();
        Session::flash('message','Evento '.$request->EVN_NOMBRE.'actualizado con exito.');
        return redirect::to('/eventos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jugador = Event::destroy($id);
        Session::flash('message','Evento a sido borrado con exito.');
        return redirect::to('/eventos'); 
    }
}
