@php
$locale = app()->getLocale() ?: 'en';
$newLocale = str_replace('_', '-', $locale);
@endphp
<!DOCTYPE html>
<html lang="">

<head>
    <title>Trabajos dirigidos para la titulación de estudiantes</title>
    <meta charset="utf-9">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <x-head-resources />
</head>

<body class="bg-gray-50 text-black/50">

    <div class="relative min-h-screen flex flex-col items-center justify-center">
        @if (Route::has('login'))
            @if (Auth::check())
                <section role="region" aria-label="Response form">
                    <form class="printButtonClass">
                        @csrf
                    <nav class="nav flex-column" style="padding-top: 50px; height: 900px; background-color: #afc7ce;">
                        <div class="nav-header" style="display: flex; align-items: center; padding-top: 50px;">
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">
                                    <i class="fa-solid fa-user"></i>{{ Auth::user()->email }}
                                </a>
                            </li>
                            <li style="list-style: none; margin-right: 20px;">
                                <a href="{{ route('login') }}">
                                    <i class="fas fa-power-off" style="font-size: 24px;" name="cerrar_sesion"></i>
                                </a>
                            </li>
                        </div>
                            <li class="nav-item">
                                <a class="nav-link active" style="width: 200px;" href="{{ route('rules') }}">Artículo 10
                                    REGLAMENTO
                                    PEDPD</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" style="width: 200px;" href="{{ route('resumen') }}">Resumen (A ser
                                    llenado
                                    por la
                                    Comisión del PEDPD)</a>
                            </li><br>
                            <li id="jsonDataLink" class="d-none">
                                <a class="nav-link active" style="width: 200px;" href="{{ route('general') }}">Mostrar datos de
                                    los
                                    Usuarios</a>
                            </li>
                            <li id="reportLink" class="nav-item d-none">
                                <a class="nav-link active" style="width: 200px;" href="{{ route('perfil') }}">Mostrar
                                    Reporte</a>
                            </li>
                            <li class="nav-item">
                                @if(Auth::user()->user_type === 'dictaminador')
                                    <a class="nav-link active" style="width: 200px;"
                                        href="{{ route('comision_dictaminadora') }}">Selección de Formatos</a>
                                @else
                                    <a class="nav-link active" style="width: 200px;" href="{{ route('secretaria') }}">Selección de
                                        Formatos</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" style="width: 200px;" href="{{ route('docencia') }}">Apartado 3</a>
                            </li>
                        </nav>
                    </form>
                </section>
            @endif
        @endif
    </div>
    <x-general-header />
    @php
$userType = Auth::user()->user_type;
    @endphp
    <div class="container mt-4 printButtonClass">
        @if($userType == 'dictaminador')
            <!-- Select para dictaminador seleccionando docentes -->
            <label for="docenteSelect">Seleccionar Docente:</label>
            <select id="docenteSelect" class="form-select">
                <option value="">Seleccionar un docente</option>
                <!-- Aquí se llenarán los docentes con JavaScript -->
            </select>
        @elseif($userType == '')
            <!-- Select para usuario con user_type vacío seleccionando dictaminadores -->
            <label for="dictaminadorSelect">Seleccionar Dictaminador:</label>
            <select id="dictaminadorSelect" class="form-select">
                <option value="">Seleccionar un dictaminador</option>
                <!-- Aquí se llenarán los dictaminadores con JavaScript -->
            </select>
        @else
            <!-- Select por defecto para otros usuarios seleccionando docentes -->
            <label for="docenteSelect">Seleccionar Docente:</label>
            <select id="docenteSelect" class="form-select">
                <option value="">Seleccionar un docente</option>
                <!-- Aquí se llenarán los docentes con JavaScript -->
            </select>
        @endif
    </div>

    <main class="container">
        <!-- Form for Part 3_1 -->
        <form id="form3_9" method="POST" onsubmit="event.preventDefault(); submitForm('/store-form39', 'form3_9');">
            @csrf
            <input type="hidden" name="dictaminador_email" value="{{ Auth::user()->email }}">
            <input type="hidden" name="dictaminador_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="user_id" value="">
            <input type="hidden" name="email" value="">
            <input type="hidden" name="user_type" value="">
             <div>
                <!--3.9 Trabajos dirigidos para la titulación de estudiantes-->
                <h4>Puntaje máximo
                    <label class="bg-black text-white px-4 mt-3" for="">200</label>
                </h4>
            </div>
            <table class="table table-sm tutorias">
                <thead>
                    <tr>
                        <th>
                            <h3></h3>
                        </th>
                        <th>
                            <h3></h3>
                        </th>
                        <th>
                            <h3></h3>
                        </th>
                        <th>
                            <h3></h3>
                        </th>
                        <th>
                            <h3></h3>
                        </th>
                        <th>
                            <h3>Tutorias</h3>
                        </th>

                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th scope="col">Actividad</th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust cd" scope="col">Puntaje a evaluar</th>
                        <th class="table-ajust cd" scope="col">Puntaje de la Comisión Dictaminadora
                        </th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th id="seccion3_9" scope="col" class="p3_9" colspan=9>3.9 Trabajos dirigidos
                            para la
                            titulación de estudiantes
                        </th>
                    </tr>
                    <tr>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th id="score3_9">0</th>
                        <th id="comision3_9">0</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th class="acreditacion">Incisos</th>
                        <th class="acreditacion">Actividad</th>
                        <th class="acreditacion">Obra</th>
                        <th class="acreditacion">Nivel</th>
                        <th class="acreditacion">Puntaje</th>
                        <th class="acreditacion">Cantidad</th>
                        <th class="acreditacion">Subtotal</th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="acreditacion">Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>a)</td>
                        <td>Revisión de</td>
                        <td>Tesis</td>
                        <td>Doctorado</td>
                        <td id="puntajeTutorias20_1">20</td>
                        <td id="puntaje3_9_1"></td>
                        <td id="tutorias1">0</td>
                        <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="tutoriasComision1" name="tutoriasComision1" placeholder="0"
                                oninput="onActv3Comision3_9()">    
                        @else
                            <span id="tutoriasComision1" name="tutoriasComision1"></span>
                        @endif
                        </td>
                        <td id="obs3_9_1">
                        @if ($userType == 'dictaminador')
                            <input class="table-header" id="obs3_9_1" name="obs3_9_1" type="text">
                        @else
                            <span id="obs3_9_1" name="obs3_9_1"></span>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td>b)</td>
                        <td>Proyecto de</td>
                        <td>Tesis</td>
                        <td>Maestría</td>
                        <td id="puntajeTutorias15_1">15</td>
                        <td id="puntaje3_9_2"></td>
                        <td id="tutorias2">0</td>
                        <td>
                            @if ($userType == 'dictaminador')
                                <input type="value" id="tutoriasComision2" name="tutoriasComision2" placeholder="0" oninput="onActv3Comision3_9()">
                            @else
                                <span id="tutoriasComision2" name="tutoriasComision2"></span>
                            @endif
                        </td>
                        <td id="obs3_9_2">
                            @if ($userType == 'dictaminador')
                                <input class="table-header" id="obs3_9_2" name="obs3_9_2" type="text">
                            @else
                                <span id="obs3_9_2" name="obs3_9_2"></span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>c)</td>
                        <td>Proyecto de</td>
                        <td>Tesis y otras</td>
                        <td>TSU, Lic y especialidad</td>
                        <td id="puntajeTutorias10_1">10</td>
                        <td id="puntaje3_9_3"></td>
                        <td id="tutorias3">0</td>
                        <td>
                            @if ($userType == 'dictaminador')
                                <input type="value" id="tutoriasComision3" name="tutoriasComision3" placeholder="0" oninput="onActv3Comision3_9()">
                            @else
                                <span id="tutoriasComision3" name="tutoriasComision3"></span>
                            @endif
                        </td>
                        <td id="obs3_9_3">
                            @if ($userType == 'dictaminador')
                                <input class="table-header" id="obs3_9_3" name="obs3_9_3" type="text">
                            @else
                                <span id="obs3_9_3" name="obs3_9_3"></span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>d)</td>
                        <td>Dirección trabajo en realización</td>
                        <td>Tesis</td>
                        <td>Doctorado</td>
                        <td id="puntajeTutorias55">55</td>
                        <td id="puntaje3_9_4"></td>
                        <td id="tutorias4">0</td>
                        <td>
                            @if ($userType == 'dictaminador')
                                <input type="value" id="tutoriasComision4" name="tutoriasComision4" placeholder="0" oninput="onActv3Comision3_9()">
                            @else
                                <span id="tutoriasComision4" name="tutoriasComision4"></span>
                            @endif
                        </td>
                        <td id="obs3_9_4"> 
                            @if ($userType == 'dictaminador')
                                <input class="table-header" id="obs3_9_4" name="obs3_9_4" type="text">
                            @else
                                <span id="obs3_9_4" name="obs3_9_4"></span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>e)</td>
                        <td>Dirección trabajo en realización</td>
                        <td>Tesis</td>
                        <td>Maestría</td>
                        <td id="puntajeTutorias45">45</td>
                        <td id="puntaje3_9_5"></td>
                        <td id="tutorias5">0</td>
                        <td>
                            @if ($userType == 'dictaminador')
                                <input type="value" id="tutoriasComision5" name="tutoriasComision5" placeholder="0" oninput="onActv3Comision3_9()">
                            @else
                                <span id="tutoriasComision5" name="tutoriasComision5"></span>
                            @endif
                        </td>
                        <td id="obs3_9_5">
                            @if ($userType == 'dictaminador')
                                <input class="table-header" id="obs3_9_5" name="obs3_9_5" type="text">
                            @else
                                <span id="obs3_9_5" name="obs3_9_5"></span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>f)</td>
                        <td>Dirección trabajo en realización</td>
                        <td>Tesis y otras</td>
                        <td>TSU, Lic y especialidad</td>
                        <td id="puntajeTutorias35">35</td>
                        <td id="puntaje3_9_6"></td>
                        <td id="tutorias6">0</td>
                        <td>
                            @if ($userType == 'dictaminador')
                                <input type="value" id="tutoriasComision6" name="tutoriasComision6" placeholder="0" oninput="onActv3Comision3_9()">
                            @else
                                <span id="tutoriasComision6" name="tutoriasComision6"></span>
                            @endif
                        </td>
                        <td id="obs3_9_6">
                            @if ($userType == 'dictaminador')
                                <input class="table-header" id="obs3_9_6" name="obs3_9_6" type="text">
                            @else
                                <span id="obs3_9_6" name="obs3_9_6"></span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>g)</td>
                        <td>Dirección trabajo terminado</td>
                        <td>Tesis</td>
                        <td>Doctorado</td>
                        <td id="puntajeTutorias70">70</td>
                        <td id="puntaje3_9_7"></td>
                        <td id="tutorias7">0</td>
                        <td>
                            @if ($userType == 'dictaminador')
                                <input type="value" id="tutoriasComision7" name="tutoriasComision7" placeholder="0" oninput="onActv3Comision3_9()">
                            @else
                                <span id="tutoriasComision7" name="tutoriasComision7"></span>
                            @endif
                        </td>
                        <td id="obs3_9_7">
                            @if ($userType == 'dictaminador')
                                <input class="table-header" id="obs3_9_7" name="obs3_9_7" type="text">
                            @else
                                <span id="obs3_9_7" name="obs3_9_7"></span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>h)</td>
                        <td>Dirección trabajo terminado</td>
                        <td>Tesis</td>
                        <td>Maestría</td>
                        <td id="puntajeTutorias60">60</td>
                        <td id="puntaje3_9_8"></td>
                        <td id="tutorias8">0</td>
                        <td>
                            @if ($userType == 'dictaminador')
                                <input type="value" id="tutoriasComision8" name="tutoriasComision8" placeholder="0" oninput="onActv3Comision3_9()">
                            @else
                                <span id="tutoriasComision8" name="tutoriasComision8"></span>
                            @endif
                        </td>
                        <td id="obs3_9_8">
                            @if ($userType == 'dictaminador')
                                <input class="table-header" id="obs3_9_8" name="obs3_9_8" type="text">
                            @else
                                <span id="obs3_9_8" name="obs3_9_8"></span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>i)</td>
                        <td>Dirección trabajo terminado</td>
                        <td>Tesis y otras</td>
                        <td>TSU, Lic y especialidad</td>
                        <td id="puntajeTutorias50">50</td>
                        <td id="puntaje3_9_9"></td>
                        <td id="tutorias9">0</td>
                        <td>
                            @if ($userType == 'dictaminador')
                                <input type="value" id="tutoriasComision9" name="tutoriasComision9" placeholder="0" oninput="onActv3Comision3_9()">
                            @else
                                <span id="tutoriasComision9" name="tutoriasComision9"></span>
                            @endif
                        </td>
                        <td id="obs3_9_9">
                            @if ($userType == 'dictaminador')
                                <input class="table-header" id="obs3_9_9" name="obs3_9_9" type="text">
                            @else
                                <span id="obs3_9_9" name="obs3_9_9"></span>
                            @endif
                        </td>
                    </tr>
                <tr>
                    <td>j)</td>
                    <td>Revisión de trabajo terminado</td>
                    <td>Tesis</td>
                    <td>Doctorado</td>
                    <td id="puntajeTutorias30_1">30</td>
                    <td id="puntaje3_9_10">0</td>
                    <td id="tutorias10">0</td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="tutoriasComision10" name="tutoriasComision10" placeholder="0" oninput="onActv3Comision3_9()">
                        @else
                            <span id="tutoriasComision10" name="tutoriasComision10"></span>
                        @endif
                    </td>
                    <td id="obs3_9_10">
                        @if ($userType == 'dictaminador')
                            <input class="table-header" id="obs3_9_10" name="obs3_9_10" type="text">
                        @else
                            <span id="obs3_9_10" name="obs3_9_10"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>k)</td>
                    <td>Revisión de trabajo terminado</td>
                    <td>Tesis</td>
                    <td>Maestría</td>
                    <td id="puntajeTutorias20_2">50</td>
                    <td id="puntaje3_9_11">0</td>
                    <td id="tutorias11">0</td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="tutoriasComision11" name="tutoriasComision11" placeholder="0" oninput="onActv3Comision3_9()">
                        @else
                            <span id="tutoriasComision11" name="tutoriasComision11"></span>
                        @endif
                    </td>
                    <td id="obs3_9_11">
                        @if ($userType == 'dictaminador')
                            <input class="table-header" id="obs3_9_11" name="obs3_9_11" type="text">
                        @else
                            <span id="obs3_9_11" name="obs3_9_11"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>l)</td>
                    <td>Revisión de trabajo terminado</td>
                    <td>Tesis y otras</td>
                    <td>TSU, Lic y especialidad</td>
                    <td id="puntajeTutorias15_2">15</td>
                    <td id="puntaje3_9_12">0</td>
                    <td id="tutorias12">0</td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="tutoriasComision12" name="tutoriasComision12" placeholder="0" oninput="onActv3Comision3_9()">
                        @else
                            <span id="tutoriasComision12" name="tutoriasComision12"></span>
                        @endif
                    </td>
                    <td id="obs3_9_12">
                        @if ($userType == 'dictaminador')
                            <input class="table-header" id="obs3_9_12" name="obs3_9_12" type="text">
                        @else
                            <span id="obs3_9_12" name="obs3_9_12"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>m)</td>
                    <td>Sinodalía</td>
                    <td>Examen</td>
                    <td>Doctorado</td>
                    <td id="puntajeTutorias30_2">30</td>
                    <td id="puntaje3_9_13">0</td>
                    <td id="tutorias13">0</td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="tutoriasComision13" name="tutoriasComision13" placeholder="0" oninput="onActv3Comision3_9()">
                        @else
                            <span id="tutoriasComision13" name="tutoriasComision13"></span>
                        @endif
                    </td>
                    <td id="obs3_9_13">
                        @if ($userType == 'dictaminador')
                            <input class="table-header" id="obs3_9_13" name="obs3_9_13" type="text">
                        @else
                            <span id="obs3_9_13" name="obs3_9_13"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>n)</td>
                    <td>Sinodalía</td>
                    <td>Examen</td>
                    <td>Maestría</td>
                    <td id="puntajeTutorias20_3">15</td>
                    <td id="puntaje3_9_14">0</td>
                    <td id="tutorias14">0</td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="tutoriasComision14" name="tutoriasComision14" placeholder="0" oninput="onActv3Comision3_9()">
                        @else
                            <span id="tutoriasComision14" name="tutoriasComision14"></span>
                        @endif
                    </td>
                    <td id="obs3_9_14">
                        @if ($userType == 'dictaminador')
                            <input class="table-header" id="obs3_9_14" name="obs3_9_14" type="text">
                        @else
                            <span id="obs3_9_14" name="obs3_9_14"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>o)</td>
                    <td>Sinodalía</td>
                    <td>Examen</td>
                    <td>TSU, Lic y especialidad</td>
                    <td id="puntajeTutorias15_3">15</td>
                    <td id="puntaje3_9_15">0</td>
                    <td id="tutorias15">0</td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="tutoriasComision15" name="tutoriasComision15" placeholder="0" oninput="onActv3Comision3_9()">
                        @else
                            <span id="tutoriasComision15" name="tutoriasComision15"></span>
                        @endif
                    </td>
                    <td id="obs3_9_15">
                        @if ($userType == 'dictaminador')
                            <input class="table-header" id="obs3_9_15" name="obs3_9_15" type="text">
                        @else
                            <span id="obs3_9_15" name="obs3_9_15"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>p)</td>
                    <td>Distinciones</td>
                    <td></td>
                    <td>Doctorado</td>
                    <td id="puntajeTutorias15_4">15</td>
                    <td id="puntaje3_9_16">0</td>
                    <td id="tutorias16">0</td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="tutoriasComision16" name="tutoriasComision16" placeholder="0" oninput="onActv3Comision3_9()">
                        @else
                            <span id="tutoriasComision16" name="tutoriasComision16"></span>
                        @endif
                    </td>
                    <td id="obs3_9_16">
                        @if ($userType == 'dictaminador')
                            <input class="table-header" id="obs3_9_16" name="obs3_9_16" type="text">
                        @else
                            <span id="obs3_9_16" name="obs3_9_16"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>q)</td>
                    <td>Distinciones</td>
                    <td></td>
                    <td>Maestría</td>
                    <td id="puntajeTutorias10_2">10</td>
                    <td id="puntaje3_9_17">0</td>
                    <td id="tutorias17">0</td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="tutoriasComision17" name="tutoriasComision17" placeholder="0" oninput="onActv3Comision3_9()">
                        @else
                            <span id="tutoriasComision17" name="tutoriasComision17"></span>
                        @endif
                    </td>
                    <td id="obs3_9_17">
                        @if ($userType == 'dictaminador')
                            <input class="table-header" id="obs3_9_17" name="obs3_9_17" type="text">
                        @else
                            <span id="obs3_9_17" name="obs3_9_17"></span>
                        @endif
                    </td>
                </tr>

                    <!--Tabla informativa Acreditacion Actividad 3.9-->
                    <table>
                        <thead>
                            <tr>
                                <th class="acreditacion" scope="col">Acreditacion: </th>

                                <th class="descripcion"><b>DSE para pregrado, DIIP para posgrado</b>
                                </th>
                                <th>
                                    @if ($userType != '')
                                        <button id="btn3_9" type="submit" class="btn custom-btn printButtonClass">Enviar</button>
                                    @endif    
                                </th>
                            </tr>
                        </thead>
                    </table>
                </tbody>
            </table>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const docenteSelect = document.getElementById('docenteSelect');
            const dictaminadorSelect = document.getElementById('dictaminadorSelect');

            // Current user type from the backend
            const userType = @json($userType);  // Get user type from backend

            // Fetch docente options if user is a dictaminador
            if (docenteSelect && userType === 'dictaminador') {
                try {
                    const response = await fetch('/get-docentes');
                    const docentes = await response.json();

                    docentes.forEach(docente => {
                        const option = document.createElement('option');
                        option.value = docente.email;
                        option.textContent = docente.email;
                        docenteSelect.appendChild(option);
                    });

                    // Handle docente selection change
                    docenteSelect.addEventListener('change', async (event) => {
                        const email = event.target.value;
                        if (email) {
                            try {
                                const response = await axios.get('/get-docente-data', { params: { email } });
                                const data = response.data;

                                // Populate fields with fetched data
                                document.getElementById('score3_9').textContent = data.form3_9.score3_9 || '0';
                                
                                //puntaje
                                for (let i = 1; i <= 17; i++) {
                                    const elementId = `puntaje3_9_${i}`;
                                    const value = data.form3_9[`puntaje3_9_${i}`] || '0';
                                    document.getElementById(elementId).textContent = value;
                                }

                                //tutorias
                                for (let j = 1; j <= 17; j++) {
                                    const elementId = `tutorias${j}`;
                                    const value = data.form3_9[`tutorias${j}`] || '0';
                                    document.getElementById(elementId).textContent = value;
                                }


                                // Populate hidden inputs
                                document.querySelector('input[name="user_id"]').value = data.form3_9.user_id || '';
                                document.querySelector('input[name="email"]').value = data.form3_9.email || '';
                                document.querySelector('input[name="user_type"]').value = data.form3_9.user_type || '';
                            } catch (error) {
                                console.error('Error fetching docente data:', error);
                            }
                        }
                    });
                } catch (error) {
                    console.error('Error fetching docentes:', error);
                    alert('No se pudo cargar la lista de docentes.');
                }
            }

            // Fetch dictaminador options if user type is null or empty
            if (dictaminadorSelect && userType === '') {
                try {
                    const response = await fetch('/get-dictaminadores');
                    const dictaminadores = await response.json();

                    dictaminadores.forEach(dictaminador => {
                        const option = document.createElement('option');
                        option.value = dictaminador.id;  // Use dictaminador ID as value
                        option.dataset.email = dictaminador.email; // Store email in data attribute
                        option.textContent = dictaminador.email;
                        dictaminadorSelect.appendChild(option);
                    });

                    // Handle dictaminador selection change
                    dictaminadorSelect.addEventListener('change', async (event) => {
                        const dictaminadorId = event.target.value;
                        const email = event.target.options[event.target.selectedIndex].dataset.email;  // Get email from selected option

                        if (dictaminadorId) {
                            try {
                                const response = await axios.get('/get-dictaminador-data', {
                                    params: { email: email, dictaminador_id: dictaminadorId }  // Send both ID and email
                                });
                                const data = response.data;

                                // Populate fields based on fetched data
                                if (data.form3_9) {
                                    document.querySelector('input[name="dictaminador_id"]').value = data.dictaminador.dictaminador_id || '0';
                                    document.querySelector('input[name="user_id"]').value = data.dictaminador.user_id || '';
                                    document.querySelector('input[name="email"]').value = data.dictaminador.email || '';
                                    document.querySelector('input[name="user_type"]').value = data.dictaminador.user_type || '';
                                   
                                    for (let i = 1; i <= 17; i++) {
                                        const puntaje3_9 = `puntaje3_9_${i}`;
                                        const puntaje3_9Value = data.form3_9[`puntaje3_9_${i}`] || '0';
                                        document.getElementById(puntaje3_9).textContent = puntaje3_9Value;
                                    }

                                    for (let j = 1; j <= 17; j++) {
                                        const tutorias = `tutorias${j}`;
                                        const tutoriasValue = data.form3_9[`tutorias${j}`] || '0';
                                        document.getElementById(tutorias).textContent = tutoriasValue;
                                    }

                                    // Para las comisiones
                                    for (let i = 1; i <= 17; i++) {
                                        const tutoriasComision = `tutoriasComision${i}`;
                                        const tutoriasComisionValue = data.form3_9[`tutoriasComision${i}`] || '0';
                                        const ComisionesElement = document.querySelector(`span[name="${tutoriasComision}"]`);
                                        if (ComisionesElement) {
                                            ComisionesElement.textContent = tutoriasComisionValue;
                                        }
                                    }

                                    // Para las observaciones
                                    for (let i = 1; i <= 17; i++) {
                                        const obs3_9_ = `obs3_9_${i}`;
                                        const value =  data.form3_9[`obs3_9_${i}`] || ''; 
                                        const element = document.querySelector(`span[name="${obs3_9_}"]`);
                                        if (element) {
                                            element.textContent = value;
                                        }
                                    }

                                    document.getElementById('score3_9').textContent = data.form3_9.score3_9 || '0';
                                    document.getElementById('comision3_9').textContent = data.form3_9.comision3_9 || '0';
                                


                                } else {

                                    console.error('No form3_9 data found for the selected dictaminador.');
                                    // Reset input values if no data found
                                    document.querySelector('input[name="dictaminador_id"]').value = '0';
                                    document.querySelector('input[name="user_id"]').value = '0';
                                    document.querySelector('input[name="email"]').value = '';
                                    document.querySelector('input[name="user_type"]').value = '';

                                    document.getElementById('score3_9').textContent = '0';

                                    for (let i = 1; i <= 17; i++) {
                                        const elementId = `puntaje3_9_${i}`;
                                        const value = '0';
                                        document.getElementById(elementId).textContent = value;
                                    }

                                    for (let j = 1; j <= 17; j++) {
                                        const elementId = `tutorias${j}`;
                                        const value = '0';
                                        document.getElementById(elementId).textContent = value;
                                    }

                                    // Para las comisiones
                                    for (let i = 1; i <= 17; i++) {
                                        const elementName = `tutoriasComision${i}`;
                                        const value = '0';
                                        const element = document.querySelector(`span[name="${elementName}"]`);
                                        if (element) {
                                            element.textContent = value;
                                        }
                                    }

                                    // Para las observaciones
                                    for (let i = 1; i <= 17; i++) {
                                        const elementName = `obs3_9_${i}`;
                                        const value = ''; // Aquí puedes definir el valor según lo que necesites
                                        const element = document.querySelector(`span[name="${elementName}"]`);
                                        if (element) {
                                            element.textContent = value;
                                        }
                                    }

                                    document.getElementById('comision3_9').textContent = '0';


                                }
                            } catch (error) {
                                console.error('Error fetching dictaminador data:', error);
                            }
                        }
                    });
                } catch (error) {
                    console.error('Error fetching dictaminadores:', error);
                    alert('No se pudo cargar la lista de dictaminadores.');
                }
            }
        });

        // Function to handle form submission
        async function submitForm(url, formId) {
            const formData = {};
            const form = document.getElementById(formId);

            if (!form) {
                console.error(`Form with id "${formId}" not found.`);
                return;
            }

            formData['dictaminador_id'] = form.querySelector('input[name="dictaminador_id"]').value;
            formData['user_id'] = form.querySelector('input[name="user_id"]').value;
            formData['email'] = form.querySelector('input[name="email"]').value;
            formData['user_type'] = form.querySelector('input[name="user_type"]').value;

            //puntajes
            for (let i = 1; i <= 17; i++) {
                formData[`puntaje3_9_${i}`] = document.getElementById(`puntaje3_9_${i}`)?.textContent || '';
            }

            // tutorias
            for (let j = 1; j <= 17; j++) {
                formData[`tutorias${j}`] = document.getElementById(`tutorias${j}`)?.textContent || '';
            }

            // tutoriasComision
            for (let i = 1; i <= 17; i++) {
                formData[`tutoriasComision${i}`] = form.querySelector(`input[id="tutoriasComision${i}"]`)?.value || '';
            }

            // observationes
            for (let i = 1; i <= 17; i++) {
                formData[`obs3_9_${i}`] = form.querySelector(`input[name="obs3_9_${i}"]`)?.value || '';
            }

            formData['score3_9'] = document.getElementById('score3_9').textContent;
            formData['comision3_9'] = document.getElementById('comision3_9').textContent;

            // Observations

            console.log('Form data:', formData);

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData),
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const responseData = await response.json();
                console.log('Response received from server:', responseData);
            } catch (error) {
                console.error('There was a problem with the fetch operation:', error);
            }
        }
        function minWithSum(value1, value2) {
            const sum = value1 + value2;
            return Math.min(sum, 200);


        }
    </script>

</body>

</html>