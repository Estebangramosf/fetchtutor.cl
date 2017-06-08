<?php

namespace App\Http\Controllers;

#use App\Http\Requests\multimedia\MultimediaCreateRequest;
#use App\Http\Requests\multimedia\MultimediaUpdateRequest;
use App\Multimedia;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\BinaryOp\Mul;

class MultimediaController extends Controller
{
    private $multimedia;
    private $multimedias;

    public function __construct()
    {

    }

    public function index()
    {
        try{
            $this->multimedias = Multimedia::orderBy('created_at','desc')->paginate(12);
            return view('multimedia.index', ['multimedias' => $this->multimedias]);
        }catch(Exception $ex){return dd($ex);}
    }

    public function create()
    {
        try{
            return view('multimedia.create');
        }catch(Exception $ex){return dd($ex);}
    }

    public function store(Request $request)
    {
        try{
            $this->multimedia = $request->user()->multimedia()->create($request->all());
            Session::flash('message', 'Contenido multimedia creado correctamente');
            return Redirect::to('/multimedia/'.$this->multimedia->id);
        }catch(Exception $ex){return dd($ex);}
    }

    public function show($id)
    {
        try{
            $this->multimedia = Multimedia::findOrFail($id);
            return view('multimedia.show', ['multimedia'=>$this->multimedia,'comments'=>$this->multimedia->multimedia_comments]);
        }catch(ModelNotFoundException $ex){
            Session::flash('message-error', 'El contenido multimedia buscado no existe.');
            return Redirect::to('/multimedia');
            return dd($ex);
        }
    }

    public function edit($id)
    {
        try{
            $this->multimedia = Multimedia::findOrFail($id);
            return view('multimedia.edit', ['multimedia' => $this->multimedia]);
        }catch(ModelNotFoundException $ex){
            Session::flash('message-error', 'El contenido multimedia no existe.');
            return Redirect::to('/multimedia');
            return dd($ex);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $this->multimedia = Multimedia::findOrFail($id);
            $this->multimedia->fill($request->all());
            $this->multimedia->save();
            Session::flash('message', 'Contenido multimedia editado correctamente');
            return Redirect::to('/multimedia');
        }catch(ModelNotFoundException $ex){
            Session::flash('message-error', 'Contenido multimedia a modificar no existe.');
            return Redirect::to('/multimedia');
            return dd($ex);
        }
    }

    public function destroy($id)
    {
        try{
            $this->multimedia = Multimedia::findOrFail($id);
            $this->multimedia->delete();
            Session::flash('message', 'Contenido multimedia eliminado correctamente');
            return Redirect::to('/multimedia');
        }catch(ModelNotFoundException $ex){
            Session::flash('message-error', 'El contenido multimedia especificado no existe.');
            return Redirect::to('/multimedia');
            return dd($ex);
        }
    }
}
