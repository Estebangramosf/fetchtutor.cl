<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FrontController extends Controller
{
    public function index()
    {
        try{
            $eventos = Event::orderBy('EVN_ID','desc')->paginate(10);
             foreach ($eventos as $e){
                list($año,$mes,$dia) = explode('-', $e->EVN_FECHA);
                $fecha = $dia.'/'.$mes.'/'.$año;
                $e->EVN_FECHA = $fecha;
            }
            return view('front.index', compact('eventos'));
        }catch(Exception $ex){}
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
