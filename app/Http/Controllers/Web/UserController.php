<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Login;
use App\Models\Person;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

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
        // fecha actual
        $hoy = now()->format('d/m/Y H:i:s');

        //--------Filtros--------
        $f_buscar = $request->get('buscar');
        $f_tblood = $request->get('tblood');
        $f_orden = $request->get('orden');
        $f_rol = $request->get('rol');
        $f_estado = $request->get('estado');
        $total = 0;
        $exportar = $request->get('exportar');

        //dd($f_buscar,$f_tblood,$f_estado,$f_orden );

        $titulo = "Usuarios";

        $join_users = User::join('roles', 'users.role_id', 'roles.id')
        ->join('people','users.person_id','people.id')
        ->join('blood_types', 'people.blood_type_id', 'blood_types.id')
        ->join('addresses', 'people.address_id', 'addresses.id')
        ->join('cities', 'addresses.city_id', 'cities.id')
        ->join('provinces', 'cities.province_id', 'provinces.id');

        //FILTRO BUSCAR
        if ($f_buscar)
        {
            if (is_numeric($f_buscar)) {// si es numero

                if ($f_buscar < 999999) {// busca por ID

                    $join_users->where('users.id', '=', "$f_buscar");
                }
                else { // busca por DNI

                    $join_users->where('people.DNI','=',"$f_buscar");
                }

            }
            else {

                $join_users->where(DB::raw("CONCAT(people.name,' ',people.last_name)"), 'LIKE', '%'.$f_buscar.'%');
            }
        }

        // FILTRO POR GRUPO SANGUINEO
        if ($f_tblood != '')
        {
            $join_users->where('people.blood_type_id', '=', $f_tblood);
        }

        // FILTRO POR ROL
        if ($f_rol != '')
        {
            $join_users->where('users.role_id', '=', "$f_rol");
        }

        // FILTRO POR ESTADO - muestra activos inactivo segun select estado
        if ($f_estado != '')
        {
            if ($f_estado == 1) {
                $join_users->whereNull('users.end_activitiest');
            }
            if ($f_estado == 2) {
                $join_users->whereNotNull('users.end_activitiest');
            }
        }


        $join_users->select(
            'users.id as id',
            'users.start_activitiest as start_activitiest',
            'users.end_activitiest as end_activitiest',
            'users.created_at as created_at',
            'users.mobile1 as mobile1',
            'people.file as file',
            'people.name as name',
            'people.state',
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

        // cuenta los resultados encontrados
        $total = $join_users->count();

        // ordena segun columna
        switch ($f_orden) {
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
        }
        else {

            $person_users = $join_users->paginate(7);

            return view('layouts.web.Users.index', compact('person_users', 'titulo', 'f_buscar', 'f_tblood', 'f_orden', 'f_rol', 'total', 'exportar', 'f_estado'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.web.Users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->guardar== '1') {
            // Crea la dirreccion
            $address = new Address();
            $address->address = $request->address;
            $address->city_id = $request->city;
            $address->save();
            //obtiene el id del ultimo elemto de address
            $address_id = Address::orderBy('id', 'DESC')->first()->id;

            //Crea la persona
            $person = new Person();
            $person->name = $request->name;
            $person->last_name = $request->last_name;
            $person->nick_name = $request->nick_name;
            $person->DNI = $request->dni;
            $person->date_of_birth = $request->date_of_birth;
            $person->sex = $request->sex;
            $person->blood_type_id = $request->tblood;
            $person->state = 'N';//para solicitar contraseña
            if ($request->sex == 'M') {
                $person->file = "vendor/adminlte/dist/img/user1.jpg";
            } else {
                $person->file = "vendor/adminlte/dist/img/user2.jpg";
            }
            $person->address_id= $address_id;
            $person->created_by = auth()->id();
            $person->save();
            //obtiene el id del ultimo elemto de People
            $person_id = Person::orderBy('id', 'DESC')->first()->id;

            //Crea el Usuario
            $user = new User;
            $user->email = $request->email;
            $user->password = bcrypt('561-Arcoiris');//ver deponder el DNI
            $user->role_id = $request->role;
            $user->phone1 = $request->phone1;
            $user->phone2 = $request->phone2;
            $user->mobile1 = $request->mobile1;
            $user->mobile2 = $request->mobile2;
            $user->occupation = $request->occupation;
            $user->curriculum_vitae = $request->curriculum_vitae;
            $user->start_activitiest = $request->start_activitiest;
            $user->person_id = $person_id;
            $user->save();
            //obtiene el id del ultimo elemto de users
            $user_id = User::orderBy('id', 'DESC')->first();

            //Session::flash('message', 'Creado');
            //Arma la URL para ver resumen de lo cargado
            $url = '/usuario/' . $user_id->id ;

            return redirect($url); //anda*/
        }
        return redirect('/usuario')->withInput(); // anda
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $hoy = now()->format('d/m/Y H:i:s'); // fecha actual 2020-10-29

        //--------Filtros--------
        $exportar = $request->get('exportar');
        $fin = $request->get('fin');
        $guardar = $request->get('guardar');

        //metdodo pagina anterior
        $end = strlen($id) + 1;
        $url_anterior = substr(URL::current(), 0, strlen(URL::current()) - $end).'s';

        $voluntary = User::where('users.id', $id)
        ->join('roles', 'users.role_id', 'roles.id')
        ->join('people','users.person_id','people.id')
        ->join('blood_types', 'people.blood_type_id', 'blood_types.id')
        ->join('addresses', 'people.address_id', 'addresses.id')
        ->join('cities', 'addresses.city_id', 'cities.id')
        ->join('provinces', 'cities.province_id', 'provinces.id')
        ->select(
            'users.id',
            'users.email',
            'users.password',
            'users.phone1',
            'users.phone2',
            'users.mobile1',
            'users.mobile2',
            'users.occupation',
            'users.curriculum_vitae',
            'users.start_activitiest',
            'users.end_activitiest',
            'users.role_id',
            'roles.name as role_name',
            'people.id as person_id',
            'people.DNI',
            'people.name as name',
            'people.last_name',
            'people.nick_name',
            'people.date_of_birth',
            'people.sex',
            'people.blood_type_id',
            'blood_types.name as tblood_name',
            'people.state',
            'people.file',
            'people.updated_at',
            'people.created_by',
            'addresses.address',
            'addresses.city_id as city_id',
            'cities.name as city_name',
            'cities.province_id as province_id',
            'provinces.name as province_name'
        )
        ->first();

        //Ultimo acceso
        if (Login::where('created_by', $id)->first())
        {
            $log_date = Login::where('created_by', $id)
            ->orderBy('id', 'DESC')
            ->first()
            ->created_at;
        }
        else
        {
            $log_date = null;
        }

        if ($exportar == 'pdf' || $exportar == 'xls') {

            $pdf = \PDF::loadView('layouts.web.Users.showPdf', compact('voluntary', 'url_anterior', 'exportar','log_date'));

            //return $pdf->download('ejemplo.pdf');
            return $pdf->stream($voluntary->last_name . '_' . $voluntary->name . '__' . $hoy . '.pdf');
        } else {

            return view('layouts.web.Users.show', compact('voluntary', 'url_anterior', 'exportar', 'guardar','log_date'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $hoy = now()->format('d/m/Y H:i:s'); // fecha actual 2020-10-29
        //--------Filtros--------
        $exportar = $request->get('exportar');

        //metdodo pagina anterior
        $end = strlen('/editar');
        $url_anterior = substr(URL::current(), 0, strlen(URL::current()) - $end);

        $voluntary = User::where('users.id', $id)
        ->join('roles', 'users.role_id', 'roles.id')
        ->join('people','users.person_id','people.id')
        ->join('blood_types', 'people.blood_type_id', 'blood_types.id')
        ->join('addresses', 'people.address_id', 'addresses.id')
        ->join('cities', 'addresses.city_id', 'cities.id')
        ->join('provinces', 'cities.province_id', 'provinces.id')
        ->select(
            'users.id',
            'users.email',
            'users.password',
            'users.phone1',
            'users.phone2',
            'users.mobile1',
            'users.mobile2',
            'users.occupation',
            'users.curriculum_vitae',
            'users.start_activitiest',
            'users.updated_at',
            'users.role_id',
            'roles.name as role_name',
            'people.id as person_id',
            'people.DNI',
            'people.name as name',
            'people.last_name',
            'people.nick_name',
            'people.date_of_birth',
            'people.sex',
            'people.blood_type_id',
            'blood_types.name as tblood_name',
            'people.state',
            'people.file',
            'people.created_by',
            'addresses.address',
            'addresses.city_id as city_id',
            'cities.name as city_name',
            'cities.province_id as province_id',
            'provinces.name as province_name'
        )
        ->first();

        //Ultimo acceso
        if (Login::where('created_by', $id)->first())
        {
            $log_date = Login::where('created_by', $id)
            ->orderBy('id', 'DESC')
            ->first()
            ->created_at;
        }
        else
        {
            $log_date = null;
        }

        return view('layouts.web.Users.edit', compact('voluntary', 'url_anterior', 'exportar','log_date'));

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
        // fecha actual
        $hoy = now();

        //carga los Id de cada tabla a actualizar
        $join_voluntary = User::where('users.id', $id)
        ->join('roles', 'users.role_id', 'roles.id')
        ->join('people','users.person_id','people.id')
        ->join('blood_types', 'people.blood_type_id', 'blood_types.id')
        ->join('addresses', 'people.address_id', 'addresses.id')
        ->join('cities', 'addresses.city_id', 'cities.id')
        ->join('provinces', 'cities.province_id', 'provinces.id')
        ->select(
                'users.id',
                'users.person_id',
                'people.DNI',
                'people.created_by', // info de quien modifica / crea
                'people.address_id',
                'addresses.city_id',
                'cities.province_id'
            )
            ->first();

        //Restablecer contraseña
        if ($request->reestablecer == '1')
        {
            $user = User::find($join_voluntary->id);
            $user->password = bcrypt($join_voluntary->DNI);
            $user->updated_at = $hoy;
            $user->save();

            $per = Person::find($join_voluntary->person_id);
            $per->state='R';
            $per->updated_at = $hoy;
            $per->save();

            //Session::flash('message', 'ExitoP');
        }

        if ($request->guardar == '1')
        {
            // Edita la dirreccion
            $address = Address::find($join_voluntary->address_id);
            $address->address = $request->address;
            $address->city_id = $request->city;
            $address->save();

            //Edita la persona
            $person = Person::find($join_voluntary->person_id);
            $person->name = $request->name;
            $person->last_name = $request->last_name;
            $person->nick_name = $request->nick_name;
            $person->DNI = $request->dni;
            $person->date_of_birth = $request->date_of_birth;
            $person->sex = $request->sex;
            $person->blood_type_id = $request->tblood;
            if ($request->sex == 'M') {
                $person->file = "vendor/adminlte/dist/img/user1.jpg";
            } else {
                $person->file = "vendor/adminlte/dist/img/user2.jpg";
            }
            $person->created_by = auth()->id();
            $person->updated_at = $hoy;
            $person->save();

            //Edita info Usuario
            $user = User::find($join_voluntary->id);
            $user->email = $request->email;
            $user->role_id = $request->role;
            $user->phone1 = $request->phone1;
            $user->phone2 = $request->phone2;
            $user->mobile1 = $request->mobile1;
            $user->mobile2 = $request->mobile2;
            $user->occupation = $request->occupation;
            $user->curriculum_vitae = $request->curriculum_vitae;
            $user->start_activitiest = $request->start_activitiest;
            $user->updated_at = $hoy;
            $user->save();

            //Session::flash('message', 'Modificado');

            //metdodo pagina anterior
            $end = strlen('/actualizar');
            $url = substr(URL::current(), 0, strlen(URL::current()) - $end);

            return redirect($url); //anda*/
        }

        return redirect('/usuario/' . $id . '/editar')->withInput(); // anda retora si encutra dni
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

    /**
     * Display a listing PDF of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_pdf(Request $request,$estado,$rol,$orden,$tblood,$buscar)
    {
        $hoy = now()->format('d/m/Y H:i:s'); // fecha actual 2020-10-29
        //--------Filtros--------

        $exportar = $request->get('exportar');

        if(trim($buscar) == "N0")
        {
            $f_buscar = '';
        }
        else
        {
            $f_buscar = trim($buscar);
        }

        if(trim($tblood) == 'N0')
        {
            $f_tblood  = '';
        }
        else
        {
            $f_tblood = trim($tblood);
        }

        if(trim($orden) == 'N0')
        {
            $f_orden = '';
        }
        else
        {
            $f_orden = trim($orden);
        }

        if(trim($rol) == 'N0')
        {
            $f_rol = '';
        }
        else
        {
            $f_rol = trim($rol);
        }

        if(trim($estado) == "N0")
        {
            $f_estado = '';
        }
        else
        {
            $f_estado = trim($estado);
        }

        $total = 0;


        $titulo = "Usuarios";

        $join_users = User::join('roles', 'users.role_id', 'roles.id')
        ->join('people','users.person_id','people.id')
        ->join('blood_types', 'people.blood_type_id', 'blood_types.id')
        ->join('addresses', 'people.address_id', 'addresses.id')
        ->join('cities', 'addresses.city_id', 'cities.id')
        ->join('provinces', 'cities.province_id', 'provinces.id');

        //FILTRO BUSCAR
        if ($f_buscar)
        {
            if (is_numeric($f_buscar)) {// si es numero

                if ($f_buscar < 999999) {// busca por ID

                    $join_users->where('users.id', '=', "$f_buscar");
                }
                else { // busca por DNI

                    $join_users->where('people.DNI','=',"$f_buscar");
                }

            }
            else {

                $join_users->where(DB::raw("CONCAT(people.name,' ',people.last_name)"), 'LIKE', '%'.$f_buscar.'%');
            }
        }

        // FILTRO POR GRUPO SANGUINEO
        if ($f_tblood != '')
        {
            $join_users->where('people.blood_type_id', '=', "$f_tblood");
        }

        // FILTRO POR ROL
        if ($f_rol != '')
        {
            $join_users->where('users.role_id', '=', "$f_rol");
        }

        // FILTRO POR ESTADO - muestra activos inactivo segun select estado
        if ($f_estado != '')
        {
            if ($f_estado == 1) {
                $join_users->whereNull('users.end_activitiest');
            }
            if ($f_estado == 2) {
                $join_users->whereNotNull('users.end_activitiest');
            }
        }

        $join_users->select(
            'users.id as id',
            'users.start_activitiest as start_activitiest',
            'users.end_activitiest as end_activitiest',
            'users.created_at as created_at',
            'users.mobile1 as mobile1',
            'people.file as file',
            'people.name as name',
            'people.state',
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

        // cuenta los resultados encontrados
        $total = $join_users->count();

        // ordena segun columna
        switch ($f_orden) {
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

        $person_users = $join_users->get();

        $pdf = \PDF::loadView('layouts.web.Users.indexPdf', compact('person_users', 'titulo', 'f_buscar', 'f_tblood', 'f_orden', 'f_rol', 'total', 'exportar', 'f_estado'));

        //return $pdf->download('ejemplo.pdf');
        return $pdf->stream($titulo . '__' . $hoy . '.pdf');
    }

     /**
     * Update end voluntary the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_end(Request $request, $id)
    {
        // fecha actual
        $hoy = now();

        //carga los Id de cada tabla a actualizar
        $join_voluntary = User::where('users.id', $id)
        ->join('people','users.person_id','people.id')
        ->select(
            'users.id',
            'users.person_id',
            'people.DNI'
        )
        ->first();

        //Finalizar voluntariado 0->Finaliza / 1->Reeincorpora
        if ($request->fin == '0') {

            //Edita la persona
            $person = Person::find($join_voluntary->person_id);
            $person->state = 'I';
            $person->created_by = auth()->id();
            $person->updated_at = $hoy;
            $person->save();

            //Edita info Usuario
            $user = User::find($join_voluntary->id);
            $user->end_activitiest = $request->end_activitiest;
            $user->updated_at = $hoy;
            $user->save();

            //Session::flash('message', 'Modificado');
        }
        else {

            //Edita la persona
            $person = Person::find($join_voluntary->person_id);
            $person->state = 'N';
            $person->created_by = auth()->id();
            $person->updated_at = $hoy;
            $person->save();

            //Edita info Usuario
            $user = User::find($join_voluntary->id);
            $user->password = bcrypt($join_voluntary->DNI);
            $user->end_activitiest = Null;
            $user->start_activitiest = $request->start_activitiest_r;
            $user->updated_at = $hoy;
            $user->save();

            //Session::flash('message', 'Modificado');
        }

        //metdodo pagina anterior
        $end = strlen('/fin');
        $url = substr(URL::current(), 0, strlen(URL::current()) - $end);

        return redirect($url); //anda*/
    }
}
