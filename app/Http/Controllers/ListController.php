<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DeckEvent;
use App\CardType;
use App\List;

class ListController extends Controller
{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //LLEGA PETICION POR AJAX
        if($request->ajax()){
            
            //echo $request->CANTIDAD.$request->EVM_ID.$request->NOMBRE. $request->TCR_ID;
            
            $lista = new List();
            $lista->LST_CANTIDAD  =  $request->CANTIDAD;
            $lista->EVM_ID = $request->EVM_ID;
            $lista->LST_NOMBRE_CARTA = $request->NOMBRE ;
            $lista->TCR_ID = $request->TCR_ID;
            $lista->CRT_ID = $request->ID_CARTA;
            $lista->save();
            $arrayCartas  = array();
            $arrayCartas = $this->getListadoCartas($lista->EVM_ID);
            return response()->json($arrayCartas);
        }
    }

    public static function getListadoCartas($id){
        $listaCartas = List::where('EVM_ID','=',$id)->orderBy('TCR_ID', 'DESC')->get();
        $arrayCartas  = array();
        foreach($listaCartas as $c){
                array_push($arrayCartas, array( 
                    'id' =>$c->LST_ID,
                    'nombre' => $c->ToCartas->CRT_NOMBRE,
                    'tipocarta' => $c->ToTipoCarta->TCR_NOMBRE,
                    'cantidad' => $c->LST_CANTIDAD
                    ) 
                );
        }          
        return $arrayCartas;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tiposcarta = CardType::lists('TCR_NOMBRE','TCR_ID');
        $eventoMazo = DeckEvent::find($id);
        $listaCartas = List::where('EVM_ID','=',$id)->orderBy('TCR_ID', 'DESC')->get();
        //dd($eventoMazo);
             return view('backend.lista.index', compact('eventoMazo','tiposcarta','listaCartas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carta = List::find($id);
        //echo "<img src='".$carta->ToCartas->CRT_IMAGEN."' border='0' />";
        return view('backend.lista.carta', compact('carta'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lista  = List::find($id);
        List::destroy($id);
        $arrayCartas  = array();
        $arrayCartas = $this->getListadoCartas($lista->EVM_ID);
        return response()->json($arrayCartas);
        //Lista::destroy($id);
    }
}
