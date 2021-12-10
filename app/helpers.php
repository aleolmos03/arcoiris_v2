<?php

use App\Models\BloodType;
use App\Models\City;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;

//function role($id) {
    //$rol=Role::find($id);
    //return $rol->name;
//}

if (!function_exists('current_roles')) {
    //id y name rol
    function current_roles()
    {
        $rol = Role::get();
        return $rol;
    }
}

if (!function_exists('current_tbloods')) {
    //id y name type blood
    function current_tbloods()
    {
        $blood = BloodType::get();
        return $blood;
    }
}

if (!function_exists('current_ID_name_City')) {
    //id y name Localidad
    function current_ID_name_City($id_prov)
    {
        $cities = City::where('cities.province_id', $id_prov)->get();
        return $cities;
    }
}

if (!function_exists('current_ID_name_Province')) {
    //id y name provincia
    function current_ID_name_Province()
    {
        $provinces = Province::get();
        return $provinces;
    }
}


if (!function_exists('current_infoUser')) {
    //infotmacion competa del usuario de usuario activo
    function current_infoUser($id)
    {
        $info=User::where('users.id', $id)
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

        if ($info) {
            return $info;
        } else {
            return 1;
        }
    }
}
