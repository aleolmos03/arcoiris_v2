<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session; // agreagado hoy 29/09/2020

use WithPagination;

use Carbon\Carbon;

use DB;
use URL;
use View;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$filtro)
    {
        // fecha actual
        $hoy = new Carbon('now');
        //--------Filtros--------
        $f_buscar=$request->get('buscar');
        $f_fecha=$request->get('fecha');
        $f_desde=$request->get('desde');
        $f_hasta=$request->get('hasta');
        $total=0;
        $exportar=$request->get('exportar');

        $titulo="Historial";

        // establece fecha actual por defecto
        if (!$f_fecha)
        {
            $f_fecha = $hoy->format('Y-m-d');
        }

        // establece fecha actual por defecto
        if (!$f_desde)
        {
            $f_desde = $hoy->format('Y-m-d');
        }

        if (!$f_hasta)
        {
            $f_hasta =  $hoy->addWeek()->format('Y-m-d');
        }

        $join_history = User::join('logins', 'users.id', '=', 'logins.created_by')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->join('people', 'users.person_id', '=', 'people.id');

            /*if (is_numeric($f_buscar)) { // si es numero
                if ($f_buscar < 999999) { // busca por ID
                    $join_history->where('person_users.id', '=', "$f_buscar");
                } else { // busca por DNI
                    $usuario = PersonUser::where('person_id', current_DNI_info($f_buscar)->id)->first(); //busca el Id de paciente a aprtir del DNI

                    if ($usuario == null) {
                        $usuario_id = 0;
                    } else {
                        $usuario_id = $usuario->user_id;
                    }

                    $join_history->where('users.id', '=', "$usuario_id");
                }
            } else {

                $join_history->where('people.name','like',"%$f_buscar%");
                //$join_history->orwhere('people.last_name','like',"$f_buscar%");
            }*/


        if ($filtro == 'Fecha')
        {
            $join_history->where('logins.created_at', 'like', "$f_fecha%");
        }

        if ($filtro == 'Rango')
        {
            $join_history->whereBetween('logins.created_at', ["$f_desde. 00:00:00", "$f_hasta. 00:00:00"]);

        }

        /*if ($filtro == 'Todo')
        {
            $join_history->where('logins.id', '>', "0");
        }*/

        $join_history->select(
                'users.id as user_id',
                'people.file as file',
                'users.email as email',
                'roles.name as role_name',
                'people.name as name',
                'people.last_name as last_name',
                'logins.id',
                'logins.created_at'
            )
            ->orderBy('logins.id', 'DESC');

            $total=$join_history->count();// cuenta los resultados encontrados

            $history=$join_history->paginate(7);

            return view('layouts.admin.Records.index',compact('history','titulo','f_fecha','f_desde','f_hasta','f_buscar','filtro','total','exportar'));
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
