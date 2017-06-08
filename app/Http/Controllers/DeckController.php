<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Deck;
use App\Format;
use Redirect;
#use App\Http\Requests\MazosCreateRequest;
#use App\Http\Requests\MazosUpdateRequest;
use Illuminate\Support\Facades\Session;


class DeckController extends Controller
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
        $mazos = Deck::paginate(10);
        return view('backend.mazos.index', compact('mazos'));
    }


    public function backendIndex(){
        $mazos = Deck::paginate(10);
        return view('backend.mazos.index', compact('mazos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mazos = Deck::paginate(10);
        $formatos = Format::lists('FTO_NOMBRE', 'FTO_ID');
        return view('backend.mazos.agregar', compact('mazos','formatos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $newMazo = new Deck();
            $newMazo->MAZ_NOMBRE = $request['MAZ_NOMBRE'];
            $newMazo->FTO_ID = $request['FTO_ID'];
            $error = '';
            try {
                $newMazo->save();
                $error = false;
            } catch (Exception $ex) {
                $error = true;
                return $ex;
            }
            Session::flash('message','Mazo agregado con exito.');
            return redirect::to('/mazos');  
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
        $mazo = Deck::find($id);
        $formatos = Format::lists('FTO_NOMBRE', 'FTO_ID');
        return view('backend.mazos.editar', compact('mazo','formatos'));
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
        $mazo = Deck::find($id);
        $mazo->MAZ_NOMBRE = $request['MAZ_NOMBRE'];
        $mazo->FTO_ID = $request['FTO_ID'];
        $mazo->save();
        return redirect::to('/mazos');
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
