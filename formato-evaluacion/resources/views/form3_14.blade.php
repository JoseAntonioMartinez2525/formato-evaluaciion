@php
$locale = app()->getLocale() ?: 'en';
$newLocale = str_replace('_', '-', $locale);
@endphp
<!DOCTYPE html>
<html lang="">

<head>
    <title>Participación como ponente en congresos o eventos académicos del Área de Conocimiento o afines del docente</title>
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
        <form id="form3_14" method="POST" onsubmit="event.preventDefault(); submitForm('/store-form314', 'form3_14');">
            @csrf
            <input type="hidden" name="dictaminador_email" value="{{ Auth::user()->email }}">
            <input type="hidden" name="dictaminador_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="user_id" value="">
            <input type="hidden" name="email" value="">
            <input type="hidden" name="user_type" value="">
                <!--3.14 Participación como ponente en congresos o eventos académicos del Área de Conocimiento o afines del docente-->
            <h4>Puntaje máximo
                <label class="bg-black text-white px-4 mt-3" for="">40</label>
            </h4>
            <table class="table table-sm tutorias">
                <thead>
                    <tr>
                        <th scope="col" colspan=3>Actividad</th>
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
                        <th id="seccion3_14" class="acreditacion" colspan=7>3.14 Participación como ponente
                            en congresos
                            o eventos
                            académicos
                            del Área de Conocimiento o afines del docente</th>
                        <th id="score3_14">0</th>
                        <th id="comision3_14">0</th>
                        <th class="acreditacion" scope="col">Observaciones</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th class="acreditacion" colspan=2>Congresos y eventos académicos</th>
                        <th class="acreditacion">Puntaje</th>
                        <th class="acreditacion">Cantidad</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="acreditacion">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <!--Incisos 3.14-->
                    <tr>
                        <td>a)</td>
                        <td>Internacional</td>
                        <td id="puntajeCongresoInt"><b>25</b></td>
                        <td id="cantCongresoInt"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="subtotalCongresoInt">0</td>
                        <td>
                        @if($userType == 'dictaminador')                                            
                            <input type="value" id="comisionCongresoInt" placeholder="0"
                                oninput="onActv3Comision3_14()">
                        @else
                            <span id="comisionCongresoInt"></span>

                        @endif        

                        </td>
                        <td>
                        @if($userType == 'dictaminador')   
                            <input class="table-header" type="text" id="obsCongresoInt">
                        @else
                            <span id="obsCongresoInt"></span>
                        @endif  
                        </td>
                    </tr>
                    <tr>
                        <td>b)</td>
                        <td>Nacional</td>
                        <td id="puntajeCongresoNac"><b>20</b></td>
                        <td id="cantCongresoNac"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="subtotalCongresoNac">0</td>
                        <td>
                        @if($userType == 'dictaminador')
                            <input type="value" id="comisionCongresoNac" placeholder="0"
                                oninput="onActv3Comision3_14()">
                        @else
                            <span id="comisionCongresoNac"></span>
                        @endif        
                        
                        </td>
                        <td>
                        @if($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsCongresoNac">
                        @else
                            <span id="obsCongresoNac"></span>
                        @endif  
                        </td>
                    </tr>
                    <tr>
                        <td>b)</td>
                        <td>Local</td>
                        <td id="puntajeCongresoLoc"><b>10</b></td>
                        <td id="cantCongresoLoc"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="subtotalCongresoLoc">0</td>
                        <td>
                        @if($userType == 'dictaminador')
                            <input type="value" id="comisionCongresoLoc" placeholder="0"
                                oninput="onActv3Comision3_14()">
                        @else                                           
                        <span id="comisionCongresoLoc"></span>

                        @endif        
                        
                        </td>
                        <td>
                        @if($userType == 'dictaminador')
                            <input class="table-header" type="text" id="obsCongresoLoc">
                        @else                                           
                            <span id="obsCongresoLoc"></span>

                        @endif  
                        </td>
                    </tr>
                </tbody>
            </table>
    <!--Tabla informativa Acreditacion Actividad 3.14-->
    <table>
        <thead>
            <tr>
                <th class="acreditacion" scope="col">Acreditacion: </th>

                <th class="descripcion"><b>Instancia que otorga</b> </th>

                <th><button id="btn3_14" type="submit" class="btn custom-btn printButtonClass">Enviar</button></th>
            </tr>
        </thead>
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
                                document.getElementById('score3_14').textContent = data.form3_14.score3_14 || '0';

                                // Cantidades
                                document.getElementById('cantCongresoInt').textContent = data.form3_14.cantCongresoInt || '0';
                                document.getElementById('cantCongresoNac').textContent = data.form3_14.cantCongresoNac || '0';
                                document.getElementById('cantCongresoLoc').textContent = data.form3_14.cantCongresoLoc || '0';

                                // Subtotales
                                document.getElementById('subtotalCongresoInt').textContent = data.form3_14.subtotalCongresoInt || '0';
                                document.getElementById('subtotalCongresoNac').textContent = data.form3_14.subtotalCongresoNac || '0';
                                document.getElementById('subtotalCongresoLoc').textContent = data.form3_14.subtotalCongresoLoc || '0';

                                //  hidden inputs
                                document.querySelector('input[name="user_id"]').value = data.form3_14.user_id || '';
                                document.querySelector('input[name="email"]').value = data.form3_14.email || '';
                                document.querySelector('input[name="user_type"]').value = data.form3_14.user_type || '';
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
                                if (data.form3_14) {
                                    document.querySelector('input[name="dictaminador_id"]').value = data.dictaminador.dictaminador_id || '0';
                                    document.querySelector('input[name="user_id"]').value = data.dictaminador.user_id || '';
                                    document.querySelector('input[name="email"]').value = data.dictaminador.email || '';
                                    document.querySelector('input[name="user_type"]').value = data.dictaminador.user_type || '';
                                    document.getElementById('score3_14').textContent = data.form3_14.score3_14 || '0';
                                    document.getElementById('comision3_14').textContent = data.form3_14.comision3_14 || '0';

                                    // Cantidades
                                    document.getElementById('cantCongresoInt').textContent = data.form3_14.cantCongresoInt || '0';
                                    document.getElementById('cantCongresoNac').textContent = data.form3_14.cantCongresoNac || '0';
                                    document.getElementById('cantCongresoLoc').textContent = data.form3_14.cantCongresoLoc || '0';


                                    // Subtotales
                                    document.getElementById('subtotalCongresoInt').textContent = data.form3_14.subtotalCongresoInt || '0';
                                    document.getElementById('subtotalCongresoNac').textContent = data.form3_14.subtotalCongresoNac || '0';
                                    document.getElementById('subtotalCongresoLoc').textContent = data.form3_14.subtotalCongresoLoc || '0';

                                    // Comisiones
                                    document.querySelector('#comisionCongresoInt').textContent = data.form3_14.comisionCongresoInt || '0';
                                    document.querySelector('#comisionCongresoNac').textContent = data.form3_14.comisionCongresoNac || '0';
                                    document.querySelector('#comisionCongresoLoc').textContent = data.form3_14.comisionCongresoLoc || '0';

                                    // Observaciones
                                    document.querySelector('#obsCongresoInt').textContent = data.form3_14.obsCongresoInt || '';
                                    document.querySelector('#obsCongresoNac').textContent = data.form3_14.obsCongresoNac || '';
                                    document.querySelector('#obsCongresoLoc').textContent = data.form3_14.obsCongresoLoc || '';


                                } else {
                                    console.error('No form3_14 data found for the selected dictaminador.');

                                    // Reset input values if no data found
                                    document.querySelector('input[name="dictaminador_id"]').value = '0';
                                    document.querySelector('input[name="user_id"]').value = '0';
                                    document.querySelector('input[name="email"]').value = '';
                                    document.querySelector('input[name="user_type"]').value = '';

                                    document.getElementById('score3_14').textContent = '0';

                                    // Cantidades
                                    document.getElementById('cantCongresoInt').textContent =  '0';
                                    document.getElementById('cantCongresoNac').textContent = '0';
                                    document.getElementById('cantCongresoLoc').textContent = '0';

                                    // Subtotales
                                    document.getElementById('subtotalCongresoInt').textContent = '0';
                                    document.getElementById('subtotalCongresoNac').textContent = '0';
                                    document.getElementById('subtotalCongresoLoc').textContent =  '0';

                                    // Comisiones
                                    document.querySelector('#comisionCongresoInt').textContent = '0';
                                    document.querySelector('#comisionCongresoNac').textContent = '0';
                                    document.querySelector('#comisionCongresoLoc').textContent = '0';

                                    // Observaciones
                                    document.querySelector('#obsCongresoInt').textContent = '';
                                    document.querySelector('#obsCongresoNac').textContent = '';
                                    document.querySelector('#obsCongresoLoc').textContent = '';

                                    document.getElementById('comision3_14').textContent = '0';
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

            // Cantidades
            formData['cantCongresoInt'] = form.querySelector('td[id="cantCongresoInt"]').textContent;
            formData['cantCongresoNac'] = form.querySelector('td[id="cantCongresoNac"]').textContent;
            formData['cantCongresoLoc'] = form.querySelector('td[id="cantCongresoLoc"]').textContent;

            // Subtotales
            formData['subtotalCongresoInt'] = document.getElementById('subtotalCongresoInt').textContent;
            formData['subtotalCongresoNac'] = document.getElementById('subtotalCongresoNac').textContent;
            formData['subtotalCongresoLoc'] = document.getElementById('subtotalCongresoLoc').textContent;

            // Comisiones
            formData['comisionCongresoInt'] = form.querySelector('input[id="comisionCongresoInt"]').value;
            formData['comisionCongresoNac'] = form.querySelector('input[id="comisionCongresoNac"]').value;
            formData['comisionCongresoLoc'] = form.querySelector('input[id="comisionCongresoLoc"]').value;

            // Observaciones
            formData['obsCongresoInt'] = form.querySelector('input[id="obsCongresoInt"]').value;
            formData['obsCongresoNac'] = form.querySelector('input[id="obsCongresoNac"]').value;
            formData['obsCongresoLoc'] = form.querySelector('input[id="obsCongresoLoc"]').value;

            formData['score3_14'] = document.getElementById('score3_14').textContent;
            formData['comision3_14'] = document.getElementById('comision3_14').textContent;

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