<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;
#use App\Http\Requests\JugadoresCreateRequest;
#use App\Http\Requests\JugadoresUpdateRequest;
use Redirect;

class PlayerController extends Controller
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
        $jugadores = Player::paginate(10);
        return view('backend.jugadores.index', compact('jugadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.jugadores.agregar', compact(''));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jugador = new Player();
        $jugador->JGD_NOMBRE = $request['JGD_NOMBRE'];
        $jugador->JGD_DCI = $request['JGD_DCI'];
        $jugador->save();
        Session::flash('message','Jugaor agregado con exito.');
        return redirect::to('/jugadores');  
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
        $jugador = Player::find($id);
        return view('backend.jugadores.editar', compact('jugador'));
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
        $jugador = Player::find($id);
        $jugador->JGD_NOMBRE = $request['JGD_NOMBRE'];
        $jugador->JGD_DCI = $request['JGD_DCI'];
        $jugador->save();
        Session::flash('message','Jugador editado con exito.');
        return redirect::to('/jugadores'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jugador = Player::destroy($id);
        Session::flash('message','Jugador Borrado con exito.');
        return redirect::to('/jugadores'); 
        
    }

    public function getjugadoresbydci(Request $request){
        
        $dci = $request->DCI;
        //$jugadores = Jugadores::where('JGD_DCI', 'like', '%'.$dci.'%')->get();
        $arrayjugadores = array();
        if($dci != ""){
            $jugadores = Player::where('JGD_DCI', 'like', '%'.$dci.'%')->get();
            foreach($jugadores as $p){
                        array_push($arrayjugadores, array( 'id' =>$p->JGD_ID,
                            'nombre' => $p->JGD_NOMBRE) );
            }
        }else{
            $jugadores  = Player::all()->sortBy('JGD_NOMBRE');
            foreach($jugadores as $p){
                        array_push($arrayjugadores, array( 'id' =>$p->JGD_ID,
                            'nombre' => $p->JGD_NOMBRE) );
            }
        }
        /*
        $jugadores = jugadores::where('reference', 'like', '%'.$nombre.'%')->get();
        foreach($jugadores as $p){
                        array_push($arrayjugadores, array( 'id' =>$p->JGD_ID,'nombre' => $p->JGD_NOMBRE) );
        }*/
        return response()->json($arrayjugadores);
        
    }
}
