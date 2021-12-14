<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
    public function index(Request $request)
    {
        $hoy = now()->format('d/m/Y H:i:s'); // fecha actual 2020-10-29
        //--------Filtros--------
        $f_buscar = $request->get('buscar');
        $f_tblood = $request->get('tblood');
        $f_orden = $request->get('orden');
        $f_rol = $request->get('rol');
        $f_estado = $request->get('estado');
        $total = 0;
        $exportar = $request->get('exportar');

        $titulo = "Usuarios";

        $join_users = User::where('users.id', auth()->id())
        ->join('roles', 'users.role_id', 'roles.id')
        ->join('people','users.person_id','people.id')
        ->join('blood_types', 'people.blood_type_id', 'blood_types.id')
        ->join('addresses', 'people.address_id', 'addresses.id')
        ->join('cities', 'addresses.city_id', 'cities.id')
        ->join('provinces', 'cities.province_id', 'provinces.id');

        /*if (is_numeric($f_buscar)) { // si es numero
            if ($f_buscar < 999999) { // busca por ID
                $join_users->where('person_users.id', '=', "$f_buscar");
            } else { // busca por DNI
                $usuario = PersonUser::where('person_id', current_DNI_info($f_buscar)->id)->first(); //busca el Id de paciente a aprtir del DNI

                if ($usuario == null) {
                    $usuario_id = 0;
                } else {
                    $usuario_id = $usuario->user_id;
                }

                $join_users->where('users.id', '=', "$usuario_id");
            }
        } else {

            $join_users->xNombre($f_buscar);
        }

        if ($f_estado != '') // muestra activos inactrio segun select estado
        {
            if ($f_estado == 1) {
                $join_users->whereNull('person_users.end_activitiest');
            }
            if ($f_estado == 2) {
                $join_users->whereNotNull('person_users.end_activitiest');
            }
        }*/

        $join_users->select(
                'users.id as id',
                'users.start_activitiest as start_activitiest',
                'users.end_activitiest as end_activitiest',
                'users.created_at as created_at',
                'people.file as file',
                'people.name as name',
                'people.last_name as last_name',
                'users.email as email',
                'people.blood_type_id as tblood_id',
                'blood_types.name as tblood_name',
                'users.role_id as role_id',
                'roles.name as role_name',
                'addresses.address as address',
                'cities.name as city',
                'provinces.name as province'
            );

        //dd(now()->subDay(15));
        $total = $join_users->count(); // cuenta los resultados encontrados

        switch ($f_orden) { // ordena segun columna
            case "F_asc":
                $join_users->orderBy('people.created_at', 'DESC');
                break;
            case "F_desc":
                $join_users->orderBy('people.created_at', 'ASC');
                break;
            case "N_asc":
                $join_users->orderBy('name', 'DESC');
                break;
            case "N_desc":
                $join_users->orderBy('name', 'ASC');
                break;
            default:
                $join_users->orderBy('people.created_at', 'DESC');
        }

        if ($exportar == 'pdf' || $exportar == 'xls') {

            $person_users = $join_users->get();

            $pdf = \PDF::loadView('layouts.web.Users.indexPdf', compact('person_users', 'titulo', 'f_buscar', 'f_tblood', 'f_orden', 'f_rol', 'total', 'exportar', 'f_estado'));

            //return $pdf->download('ejemplo.pdf');
            return $pdf->stream($titulo . '__' . $hoy . '.pdf');
        } else {

            $person_users = $join_users->paginate(7);

            return view('layouts.web.Users.index', compact('person_users', 'titulo', 'f_buscar', 'f_tblood', 'f_orden', 'f_rol', 'total', 'exportar', 'f_estado'));
           // return view('vendor.web.Volunteers.index', compact('person_users', 'titulo', 'f_buscar', 'f_tblood', 'f_orden', 'f_rol', 'total', 'exportar', 'f_estado'));
            //return view('vendor.web.Volunteers.index',["person_users" => $person_users,"f_orden" => $f_orden]);
        }
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
