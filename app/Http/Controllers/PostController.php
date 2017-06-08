<?php

namespace App\Http\Controllers;

use App\PostImage;
use Exception;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests;
#use App\Http\Requests\posts\PostCreateRequest;
#use App\Http\Requests\posts\PostUpdateRequest;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class PostController extends Controller
{
    private $post, $posts, $post_image;
    public function __construct()
    {
        #$this->middleware('auth');
        /*
            $this->middleware('log',['only'=>
                '',''
            ]);
            $this->middleware('role',['only'=>
                '',''
            ]);
        */
    }
    public function index(Request $request)
    {
        try{
            if($request->wantsJson() || $request->ajax()){
                $this->posts = Post::orderBy('created_at', 'desc')->get();
                return response()->json($this->posts);
            }
            $this->posts = Post::orderBy('created_at', 'desc')->paginate(12);
            return view('posts.index',['posts'=>$this->posts]);
        }catch(Exception $ex){return dd($ex);}
    }

    public function create()
    {
        try{
            if(Auth::user()->role=="user" /*|| Auth::user()->role=="admin"*/){
              Session::flash('message-error', 'No tiene los permisos para crear contenido.');
              return $this->index();
            }
            return view('posts.create');
        }catch(Exception $ex){return dd($ex);}
    }

    public function store(Request $request)
    {
        try{
            $this->post = $request->user()->posts()->create($request->all());
            /*
            $result = $this->validate($request, [
                'title'=>'required',
                'body'=>'required',
                'image' => 'required|image|image-size:>900,>300|image-size:<1280,<720',
            ]);
            */
            PostImage::create([
              'image'=>$request->image,
              'user_id'=>$this->post->user_id,
              'post_id'=>$this->post->id,
            ]);
            Session::flash('message', 'Post creado correctamente');
            return Redirect::to('/posts/create');
        }catch(Exception $ex){return dd($ex);}
    }

    public function show($id)
    {
        try{
            $this->post = Post::findOrFail($id);
            return view('posts.show',
                ['post'=>$this->post, 'comments'=>$this->post->post_comments]);
        }catch(ModelNotFoundException $ex){
            Session::flash('message-error', 'El contenido buscado no existe.');
            return Redirect::to('/posts');
            return dd($ex);
        }
    }

    public function edit($id)
    {
        try{
            $this->post = Post::findOrFail($id);
            if(!Auth::check() || $this->post->user_id != Auth::user()->id){
                Session::flash('message-error', 'No tiene los permisos para modificar este contenido.');
                return view('posts.show', ['post'=>$this->post, 'comments'=>$this->post->comments]);
            }
            return view('posts.edit', ['post' => $this->post]);
        }catch(ModelNotFoundException $ex){
            Session::flash('message-error', 'El contenido no existe.');
            return Redirect::to('/posts');
            return dd($ex);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $this->post = Post::findOrFail($id);
            $this->post->fill($request->all());

            $this->postImage = PostImage::where('post_id', $this->post->id)->first();

            if($this->postImage){
              $this->postImage->image = $request->image;
              $this->postImage->save();
            }else{
              PostImage::create([
                'image'=>$request->image,
                'user_id'=>$this->post->user_id,
                'post_id'=>$this->post->id,
              ]);
            }


            $this->post->save();
            Session::flash('message', 'Post editado correctamente');
            return Redirect::to('/posts');
        }catch(ModelNotFoundException $ex){
            Session::flash('message-error', 'Contenido a modificar no existe.');
            return Redirect::to('/posts');
            return dd($ex);
        }
    }

    public function destroy($id)
    {
        try{
            $this->post = Post::findOrFail($id);
            $this->post->delete();
            Session::flash('message', 'Post eliminado correctamente');
            return Redirect::to('/posts');
        }catch(ModelNotFoundException $ex){
            Session::flash('message-error', 'El contenido especificado no existe.');
            return Redirect::to('/posts');
            return dd($ex);
        }
    }
}
