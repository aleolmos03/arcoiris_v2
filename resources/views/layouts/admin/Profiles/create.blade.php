@extends('adminlte::master')

@section('adminlte_css')
    @yield('css')
@stop

@section('classes_body', 'login-page')

@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url', 'password/reset') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
    @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
    @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
    @php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif

@section('body')
    <div class="login-box">


        <div class="login-logo">

            <a href="{{ $dashboard_url }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
        </div>



            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title">
                            <i class="fas fa-key"></i>
                            &nbsp;Cambiar Contraseña
                        </h5>
                        <button ID="cancelar" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                </div>
                                <input name="OldPassword" ID="OldPassword" type="Password" Class="form-control"
                                    placeholder="Ingrese Contraseña Actual" />
                            </div>
                            <div id="strengthMessage0"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-unlock"></i></span>
                                </div>
                                <input name="NewPassword" ID="txtPassword" type="Password" Class="form-control"
                                    placeholder="Ingrese Nueva Contraseña" required />
                            </div>
                            <div id="strengthMessage"></div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                </div>
                                <input ID="txtPassword2" type="Password" Class="form-control"
                                    placeholder="Confirme Nueva Contraseña" required />
                            </div>
                            <div id="strengthMessage2"></div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button ID="cancelar" type="button" class="btn  btn-default btn-sm" data-dismiss="modal">Cancelar</button>


                        <button name="guardar2" id="guardar2" class="btn  btn-info btn-sm" value="1">
                            <i class="fas fa-check"></i> Guardar
                        </button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>

    </div>
@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
