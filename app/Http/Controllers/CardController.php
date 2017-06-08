<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Card;

class CardController extends Controller
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

    public function getcartasbyid(Request $request){
        $nombrecarta = $request->nombrecarta;
        //$jugadores = Player::where('JGD_DCI', 'like', '%'.$dci.'%')->get();
        $arraycartas = array();
        if($nombrecarta != ""){
            $cartas = Card::where('CRT_NOMBRE', 'like', ''.$nombrecarta.'%')->get();
            foreach($cartas as $c){
                        array_push($arraycartas, array( 'id' =>$c->CRT_ID,
                            'nombre' => "(".$c->EDN_COD_INTERNO.")".$c->CRT_NOMBRE) );
            }
        }else{
            
        }
        /*
        $jugadores = jugadores::where('reference', 'like', '%'.$nombre.'%')->get();
        foreach($jugadores as $p){
                        array_push($arrayjugadores, array( 'id' =>$p->JGD_ID,'nombre' => $p->JGD_NOMBRE) );
        }*/
        return response()->json($arraycartas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }
}
