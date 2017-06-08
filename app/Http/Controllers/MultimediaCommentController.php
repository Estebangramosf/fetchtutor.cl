<?php

namespace App\Http\Controllers;

use App\MultimediaComment;
use App\Http\Requests\comments\MultimediaCommentCreateRequest;
use App\Http\Requests\comments\MultimediaCommentDestroyRequest;
use App\Multimedia;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MultimediaCommentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $id)
    {
        try
        {
            sleep(1);
            $this->multimedia = Multimedia::findOrFail($id);
            $this->multimedia->multimedia_comments()->create([
                'user_id'=>Auth::user()->id,
                'title'=>$request->title,
                'body'=>$request->body,
            ]);
            Session::flash('message', 'Comentario agregado correctamente');
            return Redirect::to('/multimedia/'.$this->multimedia->id);

        } // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
        {
            Session::flash('message-error', 'El post buscado no existe.');
            return Redirect::to('/multimedia');
            //dd($e->getMessage());
            //dd(get_class_methods($e)); // lists all available methods for exception object
            //dd($e);
        }
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

    public function destroy(Request $request)
    {
        try{
            //return $request->user()->id;
            if ( $request->ajax() ) {

                $this->comment_id=(int)base64_decode($request->comment_id);
                $this->post_id=(int)base64_decode($request->post_id);

                if(is_numeric($this->comment_id) && is_numeric($this->post_id)){
                    $this->post = Post::findOrFail($this->post_id);
                    $this->comment = MultimediaComment::findOrFail($this->comment_id);

                    if(Auth::check() &&
                      (Auth::user()->role=='editor' &&
                      $this->comment->user->role!='admin') || //si se saca esta linea se puede permitir eliminar el post del admin
                      $this->comment->user_id==Auth::user()->id ||
                      Auth::user()->role=='admin'){

                        if ($this->comment->delete() ){
                            return response()->json(json_decode(json_encode([ 'result_detail' => 'Comentario elimiando','status' => 0,])));
                        }else{
                            return response()->json(json_decode(json_encode([ 'result_detail' => 'Error al eliminar','status' => 1,])));
                        }
                    }
                }

            }
        }catch(Exception $e){return dd($e);}
    }
}
