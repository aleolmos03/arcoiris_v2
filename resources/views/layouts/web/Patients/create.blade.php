    @extends('adminlte::page')

    @section('title', 'Nuevo Niño')

    @section('title_table', 'Nuevo Niño')

    @section('content')
        <form method="POST" action="/ninio/crear">
            {!! csrf_field() !!}
            <div class="card card-red">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="far fa-heart"></i>&nbsp;
                        Nuevo Niños
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <!-- /.col (left) -->
                            <div class="card card-red card-outline">
                                <div class="card-body p-2">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <img class="user-img img-fluid img-circle"
                                                src="vendor/adminlte/dist/img/userPDF.png" alt="User profile picture">
                                        </div>
                                    </div>
                                    <div class="col-sm-3 ">
                                       <br>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                            <p class="text-warning text-xl">
                                                <i class="ion ion-ios-cart-outline"></i>
                                            </p>
                                            <p class="d-flex flex-column text-right">
                                                <span class="text-muted">
                                                    Talles:
                                                </span>
                                            </p>
                                        </div>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-baby"></i>
                                                </span>
                                            </div>
                                            <input name="diaper_size" type="text" class="form-control float-right"
                                                name="diaper_size" placeholder="Marca y Talle Pañal"
                                                value="{{ old('diaper_size') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-tshirt"></i></span>
                                            </div>
                                            <input name="upper_indumetary_size" title="Indumentaria Superior" type="text"
                                                class="form-control float-right" id="reservationtime"
                                                placeholder="Talle Ind. Superior"
                                                value="{{ old('upper_indumetary_size') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-archway"></i>
                                                </span>
                                            </div>
                                            <input name="alower_indumetary_size" title="Indumentaria Inferior" type="text"
                                                class="form-control float-right" id="reservation"
                                                placeholder="Talle Ind. Inferior"
                                                value="{{ old('alower_indumetary_size') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-socks"></i></span>
                                            </div>
                                            <input name="shoe_size" title="Calzado" type="text"
                                                class="form-control float-right" id="reservationtime"
                                                placeholder="Nº Calzado" value="{{ old('shoe_size') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <!-- /.col Izquierda -->
                            <div class="card card-red card-outline">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                Nombres:
                                                <input name="name" type="text" class="form-control" placeholder="Nombres"
                                                    title="Nombres" required value="{{ old('name') }}">
                                            </div>
                                            <div class="col-sm-4">
                                                Apellidos:
                                                <input name="last_name" type="text" class="form-control"
                                                    placeholder="Apellidos" title="Apellidos" required
                                                    value="{{ old('last_name') }}">
                                            </div>
                                            <div class="col-sm-3">
                                                Apodo:
                                                <input name="nick_name" type="text" class="form-control" placeholder="Apodo"
                                                    title="Apodo" value="{{ old('nick_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                DNI:
                                                <input name="dni" type="number" min="9999999" max="99999999" onchange="this.form.submit()"
                                                    class="form-control @if (current_existeDni(old('dni'))) is-invalid @endif" placeholder="DNI" title="DNI"
                                                    required value="{{ old('dni') }}">
                                                <div class="invalid-feedback">
                                                    <strong>El DNI existe.</strong>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                Fecha de Nacimiento:
                                                <div class="input-group">
                                                    <input name="date_of_birth" title="Fecha de Nacimiento" align="center"
                                                        type="date" class="form-control" style="text-align:center;"
                                                        placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                        im-insert="true" max="{{ \Carbon\Carbon::Now()->format('Y-m-d') }}"
                                                        required value="{{ old('date_of_birth') }}">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                Sexo:
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-restroom"></i>
                                                        </span>
                                                    </div>
                                                    <select name="sex" title="Sexo" class="form-control">
                                                        <option value="M" @if (old('sex') == 'M') selected @endif>Masculino</option>
                                                        <option value="F" @if (old('sex') == 'F') selected @endif>Femenino</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                Grupo (RH):
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text btn-xs">
                                                            <i class="fas fa-tint"></i>
                                                        </span>
                                                    </div>
                                                    <select name="tblood" title="Grupo Sanguíneo (RH)" class="form-control">
                                                        @foreach (current_tbloods() as $tblood)
                                                            <option value="{{ $tblood->id }}" @if ($tblood->id == old('tblood')) selected @endif>
                                                                {{ $tblood->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                Dirección:
                                                <input name="address" type="text" class="form-control"
                                                    placeholder="Dirección" title="Dirección" required
                                                    value="{{ old('address') }}">
                                            </div>
                                            <div class="col-sm-3">
                                                Localidad:
                                                <div class="input-group">
                                                    <select name="city" class="custom-select">
                                                        @if(old('province'))
                                                            @foreach (current_ID_name_City(old('province')) as $city)
                                                                @if( old('province')== 6 )
                                                                    <option value="{{ $city->id }}" @if ($city->id == 5806) selected @endif> {{ $city->name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $city->id }}" @if ($city->id == old('city')) selected @endif> {{ $city->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                            @foreach (current_ID_name_City('1') as $city)
                                                                @if( old('province')== 6 )
                                                                    <option value="{{ $city->id }}" @if ($city->id == 2755) selected @endif> {{ $city->name }}
                                                                    </option>
                                                                @else
                                                                    <option value="{{ $city->id }}" @if ($city->id == old('city')) selected @endif> {{ $city->name }}
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                Provincia:
                                                <div class="input-group">
                                                    <select onchange="this.form.submit()" name="province"
                                                        class="custom-select">
                                                        @foreach (current_ID_name_Province() as $province)
                                                            <option value="{{ $province->id }}" @if ($province->id == old('province')) selected @endif>
                                                                {{ $province->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                Inicio Tratamiento:
                                                <div class="input-group">
                                                    <input name="start_treatment" title="Inicio Tratamiento" align="center"
                                                        type="date" class="form-control" style="text-align:center;"
                                                        placeholder="01-01-2020" data-inputmask-alias="datetime"
                                                        data-inputmask-inputformat="dd/mm/yyyy" data-mask=""
                                                        im-insert="true"
                                                        max="{{ \Carbon\Carbon::Now()->format('Y-m-d') }}" required
                                                        value="{{ old('start_treatment') }}">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="far fa-calendar-alt"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                Diagnóstico:
                                                <div class="input-group">
                                                    <input name="diagnosis" type="text" class="form-control" placeholder="Diagnóstico"
                                                    title="Nombres" required value="{{ old('diagnosis') }}" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                                </div>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-2">
                                                Internado
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text btn-xs">
                                                            <i class="fas fa-bed"></i>
                                                        </span>
                                                    </div>
                                                    <select name="internship" class="form-control">
                                                        <option value="0" @if (old('internship') == '0') selected @endif>No</option>
                                                        <option value="1" @if (old('internship') == '1') selected @endif>Si</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                Información:
                                                <textarea class="form-control" rows="6"
                                                    placeholder="Ingrese toda la información relevante" name="description"
                                                    required>{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </form>
        <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-2">
                <button name="siguiente" type="submit" class="btn btn-block btn-primary btn-sm" value="1"
                @if (current_existeDni(old('dni'))) disabled @endif>
                    Siguiente&nbsp;&nbsp;&nbsp;
                    <i class="fas fa-angle-right"></i>
                </button>
            </div>
            <div class="col-sm-4"></div>
        </div>
        </form>
        </div>
    @stop
    @section('js')
        <script type="text/javascript">
            $(function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 7000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                $('.swalDefaultSuccess').ready(function() {
                    if (@json(Session::get('message')) == 'Existe') //funciona automatico
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Guardadoo',

                        })


                });
            });

        </script>

    @stop
