@php
$locale = app()->getLocale() ?: 'en';
$newLocale = str_replace('_', '-', $locale);
@endphp
<!DOCTYPE html>
<html lang="">

<head>
    <title>Publicaciones de investigación relacionadas con el contenido de los PE que imparte el docente</title>
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
        <form id="form3_12" method="POST" onsubmit="event.preventDefault(); submitForm('/store-form312', 'form3_12');">
            @csrf
            <input type="hidden" name="dictaminador_email" value="{{ Auth::user()->email }}">
            <input type="hidden" name="dictaminador_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="user_id" value="">
            <input type="hidden" name="email" value="">
            <input type="hidden" name="user_type" value="">
             <!--3.12 Trabajos dirigidos para la titulación de estudiantes-->
            <h4>Puntaje máximo
                <label class="bg-black text-white px-4 mt-3" for="">150</label>
            </h4>
            <table class="table table-sm tutorias">
                <thead>
                    <tr>
                        <th scope="col" colspan=3>Actividad</th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust" scope="col"></th>
                        <th class="table-ajust cd" scope="col">Puntaje a evaluar</th>
                        <th class="table-ajust cd" scope="col">Puntaje de la Comisión Dictaminadora</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th id="seccion3_12" class="acreditacion" colspan=7>3.12 Publicaciones de
                            investigación
                            relacionadas con el
                            contenido
                            de los PE que imparte el docente</th>
                        <th></th>
                        <th id="score3_12">0</th>
                        <th id="comision3_12">0</th>
                        <th class="acreditacion" scope="col">Observaciones</th>
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
                        <th></th>
                        <th></th>
                        <th class="acreditacion">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <!--3_12 Publicaciones de investigación incisos-->
                    <tr>
                        <td>a)</td>
                        <td>Autor(a) o coautor(a) de libros, técnicos, científicos y humanísticos</td>
                        <td>--</td>
                        <td>--</td>
                        <td id="puntajeCientificos">100</td>
                        <td id="cantCientifico"></td>
                        <td></td>
                        <td></td>
                        <td id="subtotalCientificos"></td>
                        <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="comisionCientificos" name="comisionCientificos" placeholder="0"  oninput="onActv3Comision3_12()">
                        @else
                            <span id="comisionCientificos" name="comisionCientificos"></span>
                        @endif 
                        </td>
                        <td>
                        @if ($userType == 'dictaminador')                        
                            <input class="table-header" type="text" id="obsCientificos">
                        @else
                            <span id="obsCientificos" name="obsCientificos"></span>
                        @endif
                        </td>
                    </tr>
                <tr>
                    <td>b)</td>
                    <td>Autor(a) o coautor(a) de libros de divulgación</td>
                    <td>--</td>
                    <td>--</td>
                    <td id="puntajeDivulgacion">50</td>
                    <td id="cantDivulgacion"></td>
                    <td></td>
                    <td></td>
                    <td id="subtotalDivulgacion"></td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="comisionDivulgacion" name="comisionDivulgacion" placeholder="0"
                                oninput="onActv3Comision3_12()">
                        @else
                            <span id="comisionDivulgacion" name="comisionDivulgacion"></span>
                        @endif  
                        </td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsDivulgacion">
                        @else
                            <span id="obsDivulgacion" name="obsDivulgacion"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>c)</td>
                    <td>Traducción de libros</td>
                    <td>--</td>
                    <td>--</td>
                    <td id="puntajeTraduccion">40</td>
                    <td id="cantTraduccion"></td>
                    <td></td>
                    <td></td>
                    <td id="subtotalTraduccion"></td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="comisionTraduccion" name="comisionTraduccion" placeholder="0"
                                oninput="onActv3Comision3_12()">
                        @else
                            <span id="comisionTraduccion" name="comisionTraduccion"></span>
                        @endif                    
                     </td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsTraduccion">
                        @else
                            <span id="obsTraduccion" name="obsTraduccion"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>d)</td>
                    <td>Autor(a) o coautor(a) de artículos</td>
                    <td>Con Arbitraje</td>
                    <td>Internacional</td>
                    <td id="puntajeArbitrajeInt">60</td>
                    <td id="cantArbitrajeInt"></td>
                    <td></td>
                    <td></td>
                    <td id="subtotalArbitrajeInt"></td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="comisionArbitrajeInt" name="comisionArbitrajeInt" placeholder="0"
                                oninput="onActv3Comision3_12()">
                        @else
                            <span id="comisionArbitrajeInt" name="comisionArbitrajeInt"></span>
                        @endif                     
                    </td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsArbitrajeInt">
                        @else
                            <span id="obsArbitrajeInt" name="obsArbitrajeInt"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>e)</td>
                    <td>Autor(a) o coautor(a) de artículos</td>
                    <td>Con Arbitraje</td>
                    <td>Nacional</td>
                    <td id="puntajeArbitrajeNac">30</td>
                    <td id="cantArbitrajeNac"></td>
                    <td></td>
                    <td></td>
                    <td id="subtotalArbitrajeNac"></td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="comisionArbitrajeNac" name="comisionArbitrajeNac" placeholder="0"
                                oninput="onActv3Comision3_12()">
                        @else
                            <span id="comisionArbitrajeNac" name="comisionArbitrajeNac"></span>
                        @endif                    
                     </td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsArbitrajeNac">
                        @else
                            <span id="obsArbitrajeNac" name="obsArbitrajeNac"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>f)</td>
                    <td>Autor(a) o coautor(a) de artículos</td>
                    <td>Sin Arbitraje</td>
                    <td>Internacional</td>
                    <td id="puntajeSinInt">15</td>
                    <td id="cantSinInt"></td>
                    <td></td>
                    <td></td>
                    <td id="subtotalSinInt"></td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="comisionSinInt" name="comisionSinInt" placeholder="0" oninput="onActv3Comision3_12()">
                        @else
                            <span id="comisionSinInt" name="comisionSinInt"></span>
                        @endif                    
                     </td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsSinInt">
                        @else
                            <span id="obsSinInt" name="obsSinInt"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>g)</td>
                    <td>Autor(a) o coautor(a) de artículos</td>
                    <td>Sin Arbitraje</td>
                    <td>Nacional</td>
                    <td id="puntajeSinNac">10</td>
                    <td id="cantSinNac"></td>
                    <td></td>
                    <td></td>
                    <td id="subtotalSinNac"></td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="comisionSinNac" name="comisionSinNac" placeholder="0" oninput="onActv3Comision3_12()">
                        @else
                            <span id="comisionSinNac" name="comisionSinNac"></span>
                        @endif                     
                    </td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsSinNac">
                        @else
                            <span id="obsSinNac" name="obsSinNac"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>h)</td>
                    <td>Capítulo de libro especializado</td>
                    <td>Autor(a) o coautor (a) de capítulo de libro internacional o nacional</td>
                    <td>--</td>
                    <td id="puntajeAutor">25</td>
                    <td id="cantAutor"></td>
                    <td></td>
                    <td></td>
                    <td id="subtotalAutor"></td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="comisionAutor" name="comisionAutor" placeholder="0" oninput="onActv3Comision3_12()">
                        @else
                            <span id="comisionAutor" name="comisionAutor"></span>
                        @endif                     
                    </td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsAutor">
                        @else
                            <span id="obsAutor" name="obsAutor"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>i)</td>
                    <td>Capítulo de libro especializado</td>
                    <td>Editor(a) o coeditor(a) de libro</td>
                    <td>--</td>
                    <td id="puntajeEditor">25</td>
                    <td id="cantEditor"></td>
                    <td></td>
                    <td></td>
                    <td id="subtotalEditor"></td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="comisionEditor" name="comisionEditor" placeholder="0" oninput="onActv3Comision3_12()">
                        @else
                            <span id="comisionEditor" name="comisionEditor"></span>
                        @endif                     
                    </td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsEditor">
                        @else
                            <span id="obsEditor" name="obsEditor"></span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>j)</td>
                    <td>Sitio web</td>
                    <td>Diseño de sitio web</td>
                    <td>--</td>
                    <td id="puntajeWeb">20</td>
                    <td id="cantWeb"></td>
                    <td></td>
                    <td></td>
                    <td id="subtotalWeb"></td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input type="value" id="comisionWeb" name="comisionWeb" placeholder="0" oninput="onActv3Comision3_12()">
                        @else
                            <span id="comisionWeb" name="comisionWeb"></span>
                        @endif                     
                    </td>
                    <td>
                        @if ($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsWeb">
                        @else
                            <span id="obsWeb" name="obsWeb"></span>
                        @endif
                    </td>
                </tr>

                </tbody>
            </table>
            <!--Tabla informativa Acreditacion Actividad 3.12-->
            <table>
                <thead>
                    <tr>
                        <th class="acreditacion" scope="col">Acreditacion: </th>

                        <th class="descripcion"><b>Instancia que la otorga</b> </th>
                        <th>
                        @if ($userType != '')
                            <button id="btn3_12" type="submit" class="btn custom-btn printButtonClass">Enviar</button>
                        @endif
                        </th>
                    </tr>
                </thead>
            </table>
            </form>
    </main>

    <script>
       
       let cant3_12 = [ 'cantCientifico', 'cantDivulgacion', 'cantTraduccion', 'cantArbitrajeInt', 'cantArbitrajeNac', 'cantSinInt', 'cantSinNac', 'cantAutor', 'cantEditor', 'cantWeb'];
        let subtotal3_12 = [ 'subtotalCientificos', 'subtotalDivulgacion', 'subtotalTraduccion', 'subtotalArbitrajeInt', 'subtotalArbitrajeNac', 'subtotalSinInt', 'subtotalSinNac', 'subtotalAutor', 'subtotalEditor', 'subtotalWeb'];
        let comision3_12 = [ 'comisionCientificos', 'comisionDivulgacion', 'comisionTraduccion', 'comisionArbitrajeInt', 'comisionArbitrajeNac', 'comisionSinInt', 'comisionSinNac', 'comisionAutor', 'comisionEditor', 'comisionWeb'];
        let obs3_12 = [ 'obsCientificos', 'obsDivulgacion', 'obsTraduccion', 'obsArbitrajeInt', 'obsArbitrajeNac', 'obsSinInt', 'obsSinNac', 'obsAutor', 'obsEditor', 'obsWeb'];
                        
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
                                document.getElementById('score3_12').textContent = data.form3_12.score3_12 || '0';
                               
                                // Cantidades
                                document.getElementById('cantCientifico').textContent = data.form3_12.cantCientifico || '0';
                                document.getElementById('cantDivulgacion').textContent = data.form3_12.cantDivulgacion || '0';
                                document.getElementById('cantTraduccion').textContent = data.form3_12.cantTraduccion || '0';
                                document.getElementById('cantArbitrajeInt').textContent = data.form3_12.cantArbitrajeInt || '0';
                                document.getElementById('cantArbitrajeNac').textContent = data.form3_12.cantArbitrajeNac || '0';
                                document.getElementById('cantSinInt').textContent = data.form3_12.cantSinInt || '0';
                                document.getElementById('cantSinNac').textContent = data.form3_12.cantSinNac || '0';
                                document.getElementById('cantAutor').textContent = data.form3_12.cantAutor || '0';
                                document.getElementById('cantEditor').textContent = data.form3_12.cantEditor || '0';
                                document.getElementById('cantWeb').textContent = data.form3_12.cantWeb || '0';

                                // Subtotales
                                document.getElementById('subtotalCientificos').textContent = data.form3_12.subtotalCientificos || '0';
                                document.getElementById('subtotalDivulgacion').textContent = data.form3_12.subtotalDivulgacion || '0';
                                document.getElementById('subtotalTraduccion').textContent = data.form3_12.subtotalTraduccion || '0';
                                document.getElementById('subtotalArbitrajeInt').textContent = data.form3_12.subtotalArbitrajeInt || '0';
                                document.getElementById('subtotalArbitrajeNac').textContent = data.form3_12.subtotalArbitrajeNac || '0';
                                document.getElementById('subtotalSinInt').textContent = data.form3_12.subtotalSinInt || '0';
                                document.getElementById('subtotalSinNac').textContent = data.form3_12.subtotalSinNac || '0';
                                document.getElementById('subtotalAutor').textContent = data.form3_12.subtotalAutor || '0';
                                document.getElementById('subtotalEditor').textContent = data.form3_12.subtotalEditor || '0';
                                document.getElementById('subtotalWeb').textContent = data.form3_12.subtotalWeb || '0';


                                // Populate hidden inputs
                                document.querySelector('input[name="user_id"]').value = data.form3_12.user_id || '';
                                document.querySelector('input[name="email"]').value = data.form3_12.email || '';
                                document.querySelector('input[name="user_type"]').value = data.form3_12.user_type || '';
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
                                if (data.form3_12) {
                                    document.querySelector('input[name="dictaminador_id"]').value = data.dictaminador.dictaminador_id || '0';
                                    document.querySelector('input[name="user_id"]').value = data.dictaminador.user_id || '';
                                    document.querySelector('input[name="email"]').value = data.dictaminador.email || '';
                                    document.querySelector('input[name="user_type"]').value = data.dictaminador.user_type || '';                               
                                    document.getElementById('score3_12').textContent = data.form3_12.score3_12 || '0';
                                    document.getElementById('comision3_12').textContent = data.form3_12.comision3_12 || '0';
                                    
                                    // Cantidades
                                    document.getElementById('cantCientifico').textContent = data.form3_12.cantCientifico || '0';
                                    document.getElementById('cantDivulgacion').textContent = data.form3_12.cantDivulgacion || '0';
                                    document.getElementById('cantTraduccion').textContent = data.form3_12.cantTraduccion || '0';
                                    document.getElementById('cantArbitrajeInt').textContent = data.form3_12.cantArbitrajeInt || '0';
                                    document.getElementById('cantArbitrajeNac').textContent = data.form3_12.cantArbitrajeNac || '0';
                                    document.getElementById('cantSinInt').textContent = data.form3_12.cantSinInt || '0';
                                    document.getElementById('cantSinNac').textContent = data.form3_12.cantSinNac || '0';
                                    document.getElementById('cantAutor').textContent = data.form3_12.cantAutor || '0';
                                    document.getElementById('cantEditor').textContent = data.form3_12.cantEditor || '0';
                                    document.getElementById('cantWeb').textContent = data.form3_12.cantWeb || '0';

                                    // Subtotales
                                    document.getElementById('subtotalCientificos').textContent = data.form3_12.subtotalCientificos || '0';
                                    document.getElementById('subtotalDivulgacion').textContent = data.form3_12.subtotalDivulgacion || '0';
                                    document.getElementById('subtotalTraduccion').textContent = data.form3_12.subtotalTraduccion || '0';
                                    document.getElementById('subtotalArbitrajeInt').textContent = data.form3_12.subtotalArbitrajeInt || '0';
                                    document.getElementById('subtotalArbitrajeNac').textContent = data.form3_12.subtotalArbitrajeNac || '0';
                                    document.getElementById('subtotalSinInt').textContent = data.form3_12.subtotalSinInt || '0';
                                    document.getElementById('subtotalSinNac').textContent = data.form3_12.subtotalSinNac || '0';
                                    document.getElementById('subtotalAutor').textContent = data.form3_12.subtotalAutor || '0';
                                    document.getElementById('subtotalEditor').textContent = data.form3_12.subtotalEditor || '0';
                                    document.getElementById('subtotalWeb').textContent = data.form3_12.subtotalWeb || '0';

                                    // Comisiones
                                    document.querySelector('#comisionCientificos').textContent = data.form3_12.comisionCientificos || '0';
                                    document.querySelector('#comisionDivulgacion').textContent = data.form3_12.comisionDivulgacion || '0';
                                    document.querySelector('#comisionTraduccion').textContent = data.form3_12.comisionTraduccion || '0';
                                    document.querySelector('#comisionArbitrajeInt').textContent = data.form3_12.comisionArbitrajeInt || '0';
                                    document.querySelector('#comisionArbitrajeNac').textContent = data.form3_12.comisionArbitrajeNac || '0';
                                    document.querySelector('#comisionSinInt').textContent = data.form3_12.comisionSinInt || '0';
                                    document.querySelector('#comisionSinNac').textContent = data.form3_12.comisionSinNac || '0';
                                    document.querySelector('#comisionAutor').textContent = data.form3_12.comisionAutor || '0';
                                    document.querySelector('#comisionEditor').textContent = data.form3_12.comisionEditor || '0';
                                    document.querySelector('#comisionWeb').textContent = data.form3_12.comisionWeb || '0';

                                    // Observaciones
                                    document.querySelector('#obsCientificos').textContent = data.form3_12.obsCientificos || '';
                                    document.querySelector('#obsDivulgacion').textContent = data.form3_12.obsDivulgacion || '';
                                    document.querySelector('#obsTraduccion').textContent = data.form3_12.obsTraduccion || '';
                                    document.querySelector('#obsArbitrajeInt').textContent = data.form3_12.obsArbitrajeInt || '';
                                    document.querySelector('#obsArbitrajeNac').textContent = data.form3_12.obsArbitrajeNac || '';
                                    document.querySelector('#obsSinInt').textContent = data.form3_12.obsSinInt || '';
                                    document.querySelector('#obsSinNac').textContent = data.form3_12.obsSinNac || '';
                                    document.querySelector('#obsAutor').textContent = data.form3_12.obsAutor || '';
                                    document.querySelector('#obsEditor').textContent = data.form3_12.obsEditor || '';
                                    document.querySelector('#obsWeb').textContent = data.form3_12.obsWeb || '';

                        

                                } else {
                                    console.error('No form3_12 data found for the selected dictaminador.');

                                    // Reset input values if no data found
                                    document.querySelector('input[name="dictaminador_id"]').value = '0';
                                    document.querySelector('input[name="user_id"]').value = '0';
                                    document.querySelector('input[name="email"]').value = '';
                                    document.querySelector('input[name="user_type"]').value = '';

                                    document.getElementById('score3_12').textContent = '0';

                                    // Reset cantidad values
                                    for (let i = 0; i < cant3_12.length; i++) {
                                        const cantidad = cant3_12[i];
                                        document.querySelector(`input[name="${cantidad}"]`).value = '0';
                                    }

                                    // Reset subtotal values
                                    for (let j = 0; j < subtotal3_12.length; j++) {
                                        const subtotal = subtotal3_12[j];
                                        document.querySelector(`input[name="${subtotal}"]`).value = '0';
                                    }

                                    // Reset comision values
                                    for (let k = 0; k < comision3_12.length; k++) {
                                        const comision = comision3_12[k];
                                        const element = document.querySelector(`input[name="${comision}"]`);
                                        if (element) {
                                            element.textContent = '0';
                                        }
                                    }

                                    // Reset observation values
                                    for (let l = 0; l < obs3_12.length; l++) {
                                        const obs = obs3_12[l];
                                        const element = document.querySelector(`input[name="${obs}"]`);
                                        if (element) {
                                            element.textContent = ''; // Asignar un valor vacío
                                        }
                                    }

                                    document.getElementById('comision3_12').textContent = '0';
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

            // Puntajes
            for (let i = 0; i < cant3_12.length; i++) {
                formData[cant3_12[i]] = document.getElementById(cant3_12[i])?.textContent || '';
            }

            // Subtotales
            for (let j = 0; j < subtotal3_12.length; j++) {
                formData[subtotal3_12[j]] = document.getElementById(subtotal3_12[j])?.textContent || '';
            }

            // Comisiones
            for (let k = 0; k < comision3_12.length; k++) {
                formData[comision3_12[k]] = form.querySelector(`input[id="${comision3_12[k]}"]`)?.value || '';
            }

            // Observaciones
            for (let l = 0; l < obs3_12.length; l++) {
                formData[obs3_12[l]] = form.querySelector(`input[id="${obs3_12[l]}"]`)?.value || '';
            }

            formData['score3_12'] = document.getElementById('score3_12').textContent;
            formData['comision3_12'] = document.getElementById('comision3_12').textContent;

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