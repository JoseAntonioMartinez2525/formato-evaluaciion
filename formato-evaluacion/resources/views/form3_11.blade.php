@php
$locale = app()->getLocale() ?: 'en';
$newLocale = str_replace('_', '-', $locale);
@endphp
<!DOCTYPE html>
<html lang="">

<head>
    <title>Asesoría a estudiantes</title>
    <meta charset="utf-8">
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
        <form id="form3_11" method="POST" onsubmit="event.preventDefault(); submitForm('/store-form311', 'form3_11');">
            @csrf
            <input type="hidden" name="dictaminador_email" value="{{ Auth::user()->email }}">
            <input type="hidden" name="dictaminador_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="user_id" value="">
            <input type="hidden" name="email" value="">
            <input type="hidden" name="user_type" value="">
            <!--3.11 Trabajos dirigidos para la titulación de estudiantes-->
            <h4>Puntaje máximo
                <label class="bg-black text-white px-4 mt-3" for="">95</label>
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
                        <th class="table-ajust cd" scope="col">Puntaje de la Comisión Dictaminadora
                        </th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th id="seccion3_11" class="acreditacion" colspan=5>3.11 Asesoría a estudiantes</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th id="score3_11">0</th>
                        <th id="comision3_11">0</th>
                        <th class="acreditacion" scope="col">Observaciones</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th class="acreditacion">Incisos</th>
                        <th class="acreditacion">Documento</th>
                        <th class="acreditacion">Actividad</th>
                        <th class="acreditacion">Puntaje</th>
                        <th class="acreditacion">Cantidad</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th class="acreditacion">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <!--3_11 Asesoria a estudiantes incisos-->
                    <tr>
                        <td>a)</td>
                        <td>Asesorías académicas</td>
                        <td>Por alumno(a), por semestre</td>
                        <td id="academica">5</td>
                        <td id="cantAsesoria"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="subtotalAsesoria"></td>
                        <td id="comisionAsesoria">
                            @if ($userType == 'dictaminador')
                                <input type="value" id="comisionAsesoria" name="comisionAsesoria" placeholder="0" oninput="onActv3Comision3_11()">   
                            @else
                                <span  id="comisionAsesoria" name="comisionAsesoria" ></span>                      
                            @endif
                        </td>
                        <td id="obsAsesoria">
                            @if ($userType == 'dictaminador')
                                <input class="table-header" type="text" id="obsAsesoria" name="obsAsesoria">
                            @else
                            <span id="obsAsesoria" name="obsAsesoria"></span>
                            @endif
                            
                        </td>
                    </tr>
                    <tr>
                        <td>b)</td>
                        <td>Servicio social*</td>
                        <td>Por alumno(a), por semestre</td>
                        <td id="servicio">20</td>
                        <td id="cantServicio"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="subtotalServicio"></td>
                        <td id="comisionServicio">
                        @if ($userType == 'dictaminador')   
                            <input type="value" id="comisionServicio" name="comisionServicio" placeholder="0" oninput="onActv3Comision3_11()">
                        @else
                            <span id="comisionServicio" name="comisionServicio"></span>
                        @endif

                        </td>
                        <td id="obsServicio">
                        @if ($userType == 'dictaminador')   
                            <input class="table-header" type="text" id="obsServicio" name="obsServicio"></td>
                        @else
                            <span id="comisionServicio" name="obsServicio"></span>
                        @endif

                    </tr>
                    <tr>
                        <td>c)</td>
                        <td>Prácticas profesionales</td>
                        <td>Por alumno(a), por semestre</td>
                        <td id="practicas">20</td>
                        <td id="cantPracticas"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="subtotalPracticas"></td>
                        <td  id="comisionPracticas">
                        @if ($userType == 'dictaminador')  
                            <input type="value" id="comisionPracticas"  name="comisionPracticas" placeholder="0" oninput="onActv3Comision3_11()">
                        @else
                        <span id="comisionPracticas" name="comisionPracticas"></span
                        @endif  
                            
                        </td>
                        <td id="obsPracticas">
                        @if ($userType == 'dictaminador')  
                            <input class="table-header" type="text" id="obsPracticas" name="obsPracticas">
                        @else
                            <span id="obsPracticas" name="obsPracticas"></span>
                        @endif    
                            
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <!--Tabla informativa Acreditacion Actividad 3.11-->
            <table>
                <thead>
                    <tr>
                        <th class="acreditacion" scope="col">Acreditacion: </th>
            
                        <th class="descripcion"><b>JD, *DSEs</b> </th>
                        <th>
                            @if ($userType != '') 
                            <button id="btn3_11" type="submit" class="btn custom-btn printButtonClass">Enviar</button>
                            @endif
                        </th>
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
                                document.getElementById('score3_11').textContent = data.form3_11.score3_11 || '0';
                                document.getElementById('cantAsesoria').textContent = data.form3_11.cantAsesoria || '0';
                                document.getElementById('cantServicio').textContent = data.form3_11.cantServicio || '0';
                                document.getElementById('cantPracticas').textContent = data.form3_11.cantPracticas || '0';
                                document.getElementById('subtotalAsesoria').textContent = data.form3_11.subtotalAsesoria || '0';
                                document.getElementById('subtotalServicio').textContent = data.form3_11.subtotalServicio || '0';
                                document.getElementById('subtotalPracticas').textContent = data.form3_11.subtotalPracticas || '0';


                                // Populate hidden inputs
                                document.querySelector('input[name="user_id"]').value = data.form3_11.user_id || '';
                                document.querySelector('input[name="email"]').value = data.form3_11.email || '';
                                document.querySelector('input[name="user_type"]').value = data.form3_11.user_type || '';
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
                                if (data.form3_11) {
                                    document.querySelector('input[name="dictaminador_id"]').value = data.dictaminador.dictaminador_id || '0';
                                    document.querySelector('input[name="user_id"]').value = data.dictaminador.user_id || '';
                                    document.querySelector('input[name="email"]').value = data.dictaminador.email || '';
                                    document.querySelector('input[name="user_type"]').value = data.dictaminador.user_type || '';

                                    document.getElementById('score3_11').textContent = data.form3_11.score3_11 || '0';
                                    document.getElementById('cantAsesoria').textContent = data.form3_11.cantAsesoria || '0';
                                    document.getElementById('cantServicio').textContent = data.form3_11.cantServicio || '0';
                                    document.getElementById('cantPracticas').textContent = data.form3_11.cantPracticas || '0';
                                    document.getElementById('subtotalAsesoria').textContent = data.form3_11.subtotalAsesoria || '0';
                                    document.getElementById('subtotalServicio').textContent = data.form3_11.subtotalServicio || '0';
                                    document.getElementById('subtotalPracticas').textContent = data.form3_11.subtotalPracticas || '0';
                                    document.getElementById('comision3_11').textContent = data.form3_11.comision3_11 || '0';
                                    document.querySelector('span[name="comisionAsesoria"]').textContent = data.form3_11.comisionAsesoria || '0';
                                    document.querySelector('span[name="comisionServicio"]').textContent = data.form3_11.comisionServicio || '0';
                                    document.querySelector('span[name="comisionPracticas"]').textContent = data.form3_11.comisionPracticas || '0';
                                    document.querySelector('span[name="obsAsesoria"]').textContent = data.form3_11.obsAsesoria || '';
                                    document.querySelector('span[name="obsServicio"]').textContent = data.form3_11.obsServicio || '';
                                    document.querySelector('span[name="obsPracticas"]').textContent = data.form3_11.obsPracticas || '';

                                } else {

                                    console.error('No form3_11 data found for the selected dictaminador.');
                                    // Reset input values if no data found
                                    document.querySelector('input[name="dictaminador_id"]').value = '0';
                                    document.querySelector('input[name="user_id"]').value = '0';
                                    document.querySelector('input[name="email"]').value = '';
                                    document.querySelector('input[name="user_type"]').value = '';
                                    document.getElementById('cantAsesoria').textContent = '0';
                                    document.getElementById('cantServicio').textContent = '0';
                                    document.getElementById('cantPracticas').textContent = '0';
                                    document.getElementById('subtotalAsesoria').textContent = '0';
                                    document.getElementById('subtotalServicio').textContent = '0';
                                    document.getElementById('subtotalPracticas').textContent = '0';
                                    document.getElementById('comision3_11').textContent = '0';
                                    document.querySelector('span[name="comisionAsesoria"]').textContent = '0';
                                    document.querySelector('span[name="comisionServicio"]').textContent = '0';
                                    document.querySelector('span[name="comisionPracticas"]').textContent = '0';
                                    document.querySelector('span[name="obsAsesoria"]').textContent = '';
                                    document.querySelector('span[name="obsServicio"]').textContent = '';
                                    document.querySelector('span[name="obsPracticas"]').textContent = '';

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

            // Gather all related information from the form
            formData['dictaminador_id'] = form.querySelector('input[name="dictaminador_id"]').value;
            formData['user_id'] = form.querySelector('input[name="user_id"]').value;
            formData['email'] = form.querySelector('input[name="email"]').value;
            formData['user_type'] = form.querySelector('input[name="user_type"]').value;
            formData['cantAsesoria'] = document.getElementById('cantAsesoria').textContent;
            formData['comisionAsesoria'] = document.getElementById('comisionAsesoria').value; // Ensure input value is fetched
            formData['cantServicio'] = document.getElementById('cantServicio').textContent;
            formData['cantPracticas'] = document.getElementById('cantPracticas').textContent;
            formData['comisionServicio'] = document.getElementById('comisionServicio').value; // Ensure input value is fetched
            formData['subtotalAsesoria'] = document.getElementById('subtotalAsesoria').textContent;
            formData['subtotalServicio'] = document.getElementById('subtotalServicio').textContent;
            formData['comisionPracticas'] = document.getElementById('comisionPracticas').value; // Ensure input value is fetched
            formData['subtotalPracticas'] = document.getElementById('subtotalPracticas').textContent;
            formData['comisionAsesoria'] = form.querySelector('input[id="comisionAsesoria"]').value;
            formData['comisionServicio'] = form.querySelector('input[id="comisionServicio"]').value;
            formData['comisionPracticas'] = form.querySelector('input[id="comisionPracticas"]').value;
            formData['score3_11'] = document.getElementById('score3_11').textContent;
            formData['comision3_11'] = document.getElementById('comision3_11').textContent;

            // Observations
            formData['obsAsesoria'] = form.querySelector('input[name="obsAsesoria"]').value;
            formData['obsServicio'] = form.querySelector('input[name="obsServicio"]').value;
            formData['obsPracticas'] = form.querySelector('input[name="obsPracticas"]').value;


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