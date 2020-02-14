<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Usuario;
use App\User;

class UsuarioController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        $argumentos = array();
        $argumentos['usuarios'] = $usuarios;
        return view('admin.usuario.index',
        $argumentos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $verificacion = User::where('email', $request->input('txtCorreo'))->first();
        if($verificacion)
        {
            return redirect()->route('usuarios.create')->with('failure', 'El Usuario ' . $request->input('txtCorreo') . ' ya existe');
        }
        $usuario = new Usuario();
        $usuario->name = 
            $request->input('txtNombre');
        $usuario->email =
            $request->input('txtCorreo');
        $usuario->password =
            bcrypt($request->input('txtContraseña'));
        if($usuario->save()) {
            //Si pude guardar la noticia
            return redirect()->
                route('usuarios.index')->
                with('exito',
                'La noticia fue guardada correctamente');
        }
        //Aquí no se pudo guardar
        return redirect()->
            route('usuarios.index')->
            with('error',
            'No se pudo agregar un usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            $argumentos = array();
            $argumentos['usuario'] = $usuario;
            return view('admin.usuario.show', 
                $argumentos);
        }
        return redirect()->
                route('usuarios.index')->
                with('error','No se encontró el usuario');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            $argumentos = array();
            $argumentos['usuario'] = $usuario;
            return view('admin.usuario.edit', 
                $argumentos);
        }
        return redirect()->
                route('usuarios.index')->
                with('error','No se encontró el usuario');
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
        $usuario = Usuario::find($id); 
        if ($usuario) {
            $usuario->name = 
                $request->input('txtNombre');
            $usuario->email =
                $request->input('txtCorreo');
            $usuario->password =
                bcrypt($request->input('txtContraseña'));
            if ($usuario->save()) {
                return redirect()->
                    route('usuarios.edit',$id)->
                    with('exito',
                    'El usuario se actualizó exitosamente');
            }
            return redirect()->
                route('usuarios.edit',$id)->
                with('error',
                    'No se pudo actualizar el usuario');
        }
        return redirect()->
            route('usuarios.index')->
            with('error',
                'No se encontró al usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario) {
            if($usuario->delete()) {
                return redirect()->
                        route('usuarios.index')->
                        with('exito','Usuario eliminada exitosamente');
            }
            return redirect()->
                    route('usaurio.index')->
                    with('error','No se pudo eliminar usuario');
        }
        return redirect()->
                route('usuarios.index')->
                with('error','No se encotró al usuario');
    }
}
