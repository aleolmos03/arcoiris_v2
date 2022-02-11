<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Login;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function edit()
    {
        $id= auth()->id();

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

        $perfil = User::where('users.id', $id)
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
            'addresses.address',
            'addresses.city_id as city_id',
            'cities.name as city_name',
            'cities.province_id as province_id',
            'provinces.name as province_name'
        )
        ->first();


        return view('layouts.admin.Profiles.edit', compact('perfil', 'log_date'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //carga los Id de cada tabla a actualizar
        $join_perfil = User::where('users.id', auth()->id())
        ->join('roles', 'users.role_id', 'roles.id')
        ->join('people','users.person_id','people.id')
        ->join('blood_types', 'people.blood_type_id', 'blood_types.id')
        ->join('addresses', 'people.address_id', 'addresses.id')
        ->join('cities', 'addresses.city_id', 'cities.id')
        ->join('provinces', 'cities.province_id', 'provinces.id')
        ->select(
                'users.id',
                'users.person_id',
                'people.created_by as log_id', // info de quien modifica / crea
                'people.address_id',
                'addresses.city_id',
                'cities.province_id'
            )
            ->first();

        /*if ($request->pass == '1')
         {
         dd(Hash::check('plain-text', $hashedPassword));
        }*/

        //Finalizar voluntariado 0->Finaliza
        if ($request->fin == '0') {

            //Edita la persona
            $person = Person::find($join_perfil->person_id);
            $person->state = 'I';
            $person->created_by = auth()->id();
            $person->save();

            //Edita info Usuario
            $user = User::find($join_perfil->id);
            $user->end_activitiest = now();
            $user->save();

            //Session::flash('message', 'Modificado');
        }

        //Cambiar de contraseña 1
        if ($request->cambiar == '1') {

            if(Hash::check($request->OldPassword, auth()->user()->password))
            {
                $person = Person::find($join_perfil->person_id);
                $person->state = "O";// ok contraseña
                $person->save();
            }
            else
            {
                $person = Person::find($join_perfil->person_id);
                $person->state = "E";// error de contraseña
                $person->save();

                //Session::flash('message', 'ErrorP');
            }

            return redirect('/perfil'); //anda*/
        }

        //Actualizar - Guardo Nueva Contraseña
        if ($request->actualizar == '1') {

            //Edita persona
            $person = Person::find($join_perfil->person_id);
            $person->state = "A";
            $person->save();

            //Edita info Usuario
            $user = User::find($join_perfil->id);
            $user->password = bcrypt($request->NewPassword);
            $user->save();

            return redirect('/perfil'); //anda*/
        }

        if ($request->guardar == '1') {

            // Edita la dirreccion
            $address = Address::find($join_perfil->address_id);
            $address->address = $request->address;
            $address->city_id = $request->city;
            $address->save();

            //Edita la persona
            $person = Person::find($join_perfil->person_id);
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
            $person->save();

            //Edita info Usuario
            $user = User::find($join_perfil->id);
            //$user->email = $request->email;
            $user->phone1 = $request->phone1;
            $user->phone2 = $request->phone2;
            $user->mobile1 = $request->mobile1;
            $user->mobile2 = $request->mobile2;
            $user->occupation = $request->occupation;
            $user->curriculum_vitae = $request->curriculum_vitae;
            $user->start_activitiest = $request->start_activitiest;
            $user->save();

            //Edita info Usuario
            //$user = User::find($join_perfil->user_id);
            //$user->name = $request->dni;
            //$user->email = $request->email;
            //dd(Hash::check('561-Arcoiris',  $user->password));
            //$user->save();*/

            //Session::flash('message', 'Editado');
            $url = substr(URL::previous(), 0, strlen(URL::previous()) - 5);

            return redirect('/perfil'); //anda*/
        }

        return redirect('/perfil')->withInput(); // anda retora si encutra dni
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
