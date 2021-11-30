@extends('adminlte::page')

@section('title', 'Controles')

@section('title_table', 'Controles')


@section('content')
<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">Nueva Asistencia a Controles</h3>
    </div>
    <form role="form">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Hoy</h3>
                                        <div class="card-tools">
                                            <div class="input-group input-group-sm">
                                                <input type="date" name="table_search" class="form-control float-right" placeholder="Buscar" value="{{ \Carbon\Carbon::Now()->format('Y-m-d')}}">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-0">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="20%">Nombre</th>
                                                    <th width="10%">Día</th>
                                                    <th width="10%">Fecha</th>
                                                    <th width="10%">Hora</th>
                                                    <th width="45%">Descripción</th>
                                                    <th width="5%">Asist.</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>John Doe</td>
                                                    <td>Lunes</td>
                                                    <td>11-7-2014</td>
                                                    <td>10:30</td>
                                                    <td>Descripcion...</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" checked="">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Alexander Pierce</td>
                                                    <td>Martes</td>
                                                    <td>11-7-2014</td>
                                                    <td>10:30</td>
                                                    <td>Descripcion...</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" checked="">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Bob Doe</td>
                                                    <td>Miércoles</td>
                                                    <td>11-7-2014</td>
                                                    <td>10:30</td>
                                                    <td>Descripcion...</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" checked="">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Mike Doe</td>
                                                    <td>Jueves</td>
                                                    <td>11-7-2014</td>
                                                    <td>10:30</td>
                                                    <td>Descripcion...</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" checked="">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jim Doe</td>
                                                    <td>Lunes</td>
                                                    <td>11-7-2014</td>
                                                    <td>10:30</td>
                                                    <td>Descripcion...</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" checked="">
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Victoria Doe</td>
                                                    <td>Martes</td>
                                                    <td>11-7-2014</td>
                                                    <td>10:30</td>
                                                    <td>Descripcion...</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" checked="">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-block btn-primary btn-sm"><i class="fas fa-check"></i> Guardar</button>
            </div>
            <div class="col-sm-4"></div>
        </div>
        </form>
    </div>
    @stop
