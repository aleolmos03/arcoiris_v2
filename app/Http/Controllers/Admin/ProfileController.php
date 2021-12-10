<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

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
        $perfil = User::where('users.id', auth()->id())
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

        return view('layouts.admin.Profiles.edit', compact('perfil'));
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
