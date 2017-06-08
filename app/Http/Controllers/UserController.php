<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{

    private $user;
    public function __construct(){
    }

    # method all() to return users via ajax-vue request
    public function all(Request $request){
        try{
            if($this->user = Auth::user()){
                if($this->user->role=='admin'){
                    if ($request->ajax() || $request->wantsJson()) {
                        $users = User::orderBy('created_at','desc')->paginate(20);
                        return response()->json($users);
                        #return response()->json(['RC'=>'0','RD'=>'Success']);#json($users);
                    }
                }else{
                    Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                    return Redirect::to('/posts');
                }
            }else{
                Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                return Redirect::to('/posts');
            }           
        }catch(Exception $e){return Redirect::to('/posts');}
    }

    public function index()
    {
        try{
            if($this->user = Auth::user()){
                if($this->user->role=='admin'){
                    return view('users.index', ['users'=>count(User::all())]);
                }else{
                    Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                    return Redirect::to('/posts');
                }
            }else{
                Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                return Redirect::to('/posts');
            }
      }catch(Exception $e){
        return Redirect::to('/posts');
      }
    }

    public function create()
    {
        try{
            if($this->user = Auth::user()){
                if($this->user->role=='admin'){
                    return view('users.create');
                }else{
                    Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                    return Redirect::to('/posts');
                }
            }else{
                Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                return Redirect::to('/posts');
            }
        }catch(Exception $e){
            return Redirect::to('/posts');
        }
    }

    public function store(Request $request)
    {
        try{
            //Valido que sea un usuario autenticado
            if($this->user = Auth::user()){
                //Valido si es admin o que sea el mismo usuario quien se edite
                if($this->user->role=='admin'){
                    //Primero tomo al usuario en base al id
                    $this->user = $request->all();
                    //Si estoy editando mediante ajax
                    if ($request->wantsJson() || $request->ajax()) {
                        //Guardo mediante ajax
                        $newuser = User::create([
                            'name' => $this->user['user']['name'],
                            'email' => $this->user['user']['email'],
                            'role' => $this->user['user']['role'],
                            'password' => bcrypt($this->user['user']['password']),
                        ]);
                        return response()->json(['rc'=>'00','rd'=>'User created','rid'=>$newuser]);
                    }
                    //Si estoy editando por la vista
                    else{
                        //Guardo normalmente
                        $this->user->fill($request->all());
                        $this->user->save();
                        Session::flash('message', 'Usuario editado correctamente');
                        return Redirect::to('/users/'.$this->user->id.'/edit');
                    }
                }else{
                    Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                    return Redirect::to('/posts');
                }
            }else{
                Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                return Redirect::to('/posts');
            }
        } // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
        {
            Session::flash('message-error', 'El rol a modificar no existe.');
            return Redirect::to('/users');
            //dd($e->getMessage());
            //dd(get_class_methods($e)); // lists all available methods for exception object
            //dd($e);
        }
    }

    public function show($id)
    {
        return view('users.show', ['user'=>Auth::user()]);
    }

    public function profile(){
        return $this->show(Auth::user()->id);
    }

    /* For vue request to edit */
    public function allEdit($id, Request $request){
        try{
            if($this->user = Auth::user()){
                if($this->user->role=='admin' || $this->user->id == $id){
                    $this->user = User::findOrFail($id);
                    if($request->wantsJson() || $request->ajax()){
                        return response()->json(['user' => $this->user]);
                    }else{return response()->json(['rc'=>'01','rd'=>'error petición ajax']);}
                }else{return response()->json(['rc'=>'02','rd'=>'error']);}
            }else{return response()->json(['rc'=>'03','rd'=>'error de permisos']);}
        }catch(Exception $e){return response()->json(['rc'=>'04','rd'=>'error de autenticación']);}
    }

    public function edit($id, Request $request)
    {
        try{
            if($this->user = Auth::user()){
                if($this->user->role=='admin' || $this->user->id == $id){
                    $this->user = User::findOrFail($id);
                    return view('users.edit',
                        ['user' => $this->user]
                    );
                }else{
                    Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                    return Redirect::to('/posts');
                }
            }else{
                Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                return Redirect::to('/posts');
            }
        }catch(NotFoundHttpException $e){return Redirect::to('/posts');}
    }

    public function update(Request $request, $id)
    {
        try{
            //Valido que sea un usuario autenticado
            if($this->user = Auth::user()){
                //Valido si es admin o que sea el mismo usuario quien se edite
                if($this->user->role=='admin' || $this->user->id == $id){
                    //Primero tomo al usuario en base al id
                    $this->user = User::findOrFail($id);
                    //Si estoy editando mediante ajax
                    if ($request->wantsJson() || $request->ajax()) {
                        //Guardo mediante ajax       
                        $userRequest = $request->all();
                        $this->user->fill($userRequest['user']);
                        $this->user->save();
                        return response()->json(['rc'=>'00','rd'=>'User updated']);
                    }
                    //Si estoy editando por la vista                    
                    else{
                        //Guardo normalmente
                        $this->user->fill($request->all());
                        $this->user->save();                    
                        Session::flash('message', 'Usuario editado correctamente');
                        return Redirect::to('/users/'.$this->user->id.'/edit');
                    }               
                }else{
                    Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                    return Redirect::to('/posts');
                }
            }else{
                Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                return Redirect::to('/posts');
            }
        } // catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
        {
            Session::flash('message-error', 'El rol a modificar no existe.');
            return Redirect::to('/users');
            //dd($e->getMessage());
            //dd(get_class_methods($e)); // lists all available methods for exception object
            //dd($e);
        }
    }

    public function destroy($id)
    {
        try{
            if($this->user = Auth::user()){
                if($this->user->role=='admin' || $this->user->id == $id){
                    $this->user = User::findOrFail($id);
                    $this->user->delete();
                    return response()->json(['rc'=>'00','rd'=>'User deleted']);
                }else{
                    Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                    return Redirect::to('/users');
                }
            }else{
                Session::flash('message-error', 'Usted no tiene privilegios para acceder a esta sección.');
                return Redirect::to('/users');
            }
        }catch(Exception $e){return Redirect::to('/users');}
    }

    public function dashboard(){
        return view('users.dashboard');
    }
}
