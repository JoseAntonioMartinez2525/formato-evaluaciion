@php
    $locale = app()->getLocale() ?: 'en';
    $newLocale = str_replace('_', '-', $locale);
@endphp
<!DOCTYPE html>
<html lang="{{ $newLocale }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formato de Evaluación docente</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/form3.css') }}" rel="stylesheet">
    <script src="{{ asset('js/subtotales.js') }}"></script>
    <script src="{{ asset('js/comisiones.js') }}"></script>
    <script src="{{ asset('js/privileges.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.development.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.development.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://kit.fontawesome.com/e72e299160.js" crossorigin="anonymous"></script>
    <style>
        @media print {
            .footer-number::after {
                content: "1";
            }
        }
    </style>

</head>

<body class="font-sans antialiased">
    <x-general-header />
    <div class="bg-gray-50 text-black/50">
        <div class="relative min-h-screen flex flex-col items-center justify-center">
            @if (Route::has('login'))
                @if (Auth::check() && Auth::user()->user_type === '')
                    <section role="region" aria-label="Response form">
                        <form>
                            @csrf
                            <nav class="nav flex-column menu">
                                <li class="nav-item">
                                    <a style="margin-left: 210px;" href="{{ route('login') }}">
                                        <i class="fas fa-power-off" name="cerrar_sesion"></i>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link disabled" href="#"><i
                                            class="fa-solid fa-user"></i>{{ Auth::user()->email }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" style="width: 200px;" href="{{route('rules')}}">Artículo 10
                                        REGLAMENTO
                                        PEDPD</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" style="width: 200px;" href="{{route('docencia')}}">Actividades 3.
                                        Calidad en la docencia</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" style="width: 200px;" href="{{route('resumen')}}">Resumen (A ser
                                        llenado por la Comisión del PEDPD)</a>
                                </li><br>
                                <li id="jsonDataLink" class="d-none">
                                    <a class="nav-link active" style="width: 200px;" href="{{ route('general') }}">Mostrar datos
                                        de los Usuarios</a>
                                </li>
                                <li id="reportLink" class="nav-item d-none">
                                    <a class="nav-link active" style="width: 200px;" href="{{ route('perfil') }}">Mostrar
                                        Reporte</a>
                                </li>


                            </nav>
                </form>@endif
                </section>

                <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                    <div class="flex lg:justify-center lg:col-start-2"></div>

                    <nav class="-mx-3 flex flex-1 justify-end"></nav>

        
                    <form id="form1">

                        <label for="convocatoria" class="label">Convocatoria</label>
                        <span name="convocatoria" class="input-header mb-3" id="convocatoria"></span>

                        <label for="periodo" class="label">Periodo de evaluación:</label>
                        <span name="periodo" id="periodo" class="input-header mb-3"></span>

                        <label for="nombre" class="label">Nombre del personal académico:</label> 
                            <span id="nombre"
                           class="input-header mb-3"></span>

                        <label for="area" class="label">Área de Conocimiento:</label>
                        <span id="area" class="form-select input-header">
                        </span>

                        <label for="departamento" class="label">Departamento Académico:</label>
                        <span id="departamento" class="input-header"></span>
                        

                        <h3>Instrucciones</h3>
                        <div class="container flex">
                            <p style="width:1100px; margin-left: -20px;">1 La persona a ser evaluada deberá completar la
                                información en cantidades u horas en los campos
                                marcados en color gris. <br>
                                2 La Comisión Dictaminadora deberá llenar los campos marcados en color azul cielo (puntajes
                                totales o
                                subtotales, según sea el caso). <br>
                                3 No se deberán modificar fórmulas, ni agregar o quitar renglones. <br>
                                4 Este formato deberá presentarse en forma independiente de la documentación que acrediten
                                las
                                actividades realizadas. Para la evaluación no es necesario entregar las obras
                                completas-libros,
                                manuales, publicaciones,etc., sino entregar el documento probatorio que se indique en la
                                Guía de
                                definiciones. <br>
                                5 La Comisión Dictaminadora no tomará en cuenta documentación que no esté contemplada dentro
                                del
                                formato de evaluación, asimismo no se aceptará documentación presentada de forma
                                extemporánea.
                                <center><button type="submit" class="btn btn-primary" id="btn1">Enviar</button>
                                </center>
                        </div>

                    </form>
                </header>

                <main class="container">
                    <!--Actividad 1: Permanencia en las actividades de la docencia	-->

                    <form id="form2" method="POST" onsubmit="event.preventDefault(); submitForm('/store2', 'form2');">
                        <div>
                            <h4>Puntaje máximo
                                <label class="bg-black text-white px-4" for="">100</label>
                            </h4>

                        </div>
                        @csrf
                        <!-- Add hidden fields for user_id and email -->
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                        <input type="hidden" name="user_type" value="{{ auth()->user()->user_type }}">
                        <input type="hidden" id="puntajeEvaluarInput" name="puntajeEvaluar" value="0">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Actividad</th>
                                    <th class="table-ajust" scope="col">Años</th>
                                    <th class="table-ajust cd" scope="col">Puntaje a evaluar</th>
                                    <th class="table-ajust cd" scope="col">Puntaje de la Comisión Dictaminadora</th>
                                    <th class="table-ajust" scope="col">Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="margin-right: auto;"><b>1. Permanencia en las actividades de la docencia</b>
                                    </td>
                                    <td class="horasActv2">
                                        <input type="number" id="horasActv2" name="horasActv2" class="form-control">
                                    </td>
                                    <td id="puntajeEvaluar" class="puntajeEvaluar text-white">
                                        <label id="puntajeEvaluarText">0</label>
                                    </td>
                                    <td class="table-header comision">
                                        <input type="number" id="comision1" name="comision1" class="table-header comision"
                                            step="any">
                                    </td>
                                    <td>
                                        <input id="obs1" name="obs1" class="table-header" type="text"></input>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th style="font-weight: normal; text-size: 20px;" scope="col">Acreditacion: </th>
                                    <th style="width:60px;padding-left: 100px;">SG</th>
                                    <th style="font-weight: normal; padding-left: 100px;">6.25 puntos por cada año de
                                        experiencia docente
                                        cumplido. A partir de los 16 años de experiencia docente se otorgarán los 100 puntos
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </form>

                    <form id="form2_2" method="POST" onsubmit="event.preventDefault(); submitForm('/store3', 'form2_2');">
                        @csrf
                        <div>
                            <!--Actividad 2: Dedicacion en el Desempeño docente	-->
                            <h4>Puntaje máximo
                                <label class="bg-black text-white px-4 mt-3" for="">200</label>
                            </h4>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                        <input type="hidden" name="user_type" value="{{ auth()->user()->user_type }}">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Actividad</th>
                                    <th class="table-ajust" scope="col">Horas</th>
                                    <th class="table-ajust cd" scope="col">Puntaje a evaluar</th>
                                    <th class="table-ajust cd" scope="col">Puntaje de la Comisión Dictaminadora</th>
                                    <th class="table-ajust" scope="col">Observaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>2. Dedicacion en el Desempeño docente</b></td>
                                    <td for=""></td>
                                    <td id="hours" name="hours" for=""><label id="hoursText" for="">0</label></td>
                                    <td id="actv2Comision" name="actv2Comision" for=""></td>
                                </tr>
                                <tr>
                                    <td><label for="">a) Posgrado</label>
                                        <label for="">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
                                            Semestre </label>
                                    </td>
                                    <td><input id="horasPosgrado" class="horasActv2" placeholder="0" type="text"
                                            oninput="onChange()">
                                    </td>
                                    <td class="puntajeEvaluar2"><label id="DSE" class="puntajeEvaluar" type="text"></label>
                                    </td>
                                    <td class="comision actv"><input id="comisionPosgrado" placeholder="0" for=""
                                            oninput="onActv2Comision()"></input></td>
                                    <td><input id="obs2" name="obs2" class="table-header" type="text"></td>
                                </tr>
                                <tr>
                                    <td>b) Licenciatura y TSU
                                        <label for="">&nbsp &nbsp &nbsp &nbsp Horas </label>
                                    </td>
                                    <td><input id="horasSemestre" class="horasActv2" placeholder="0" type="text"
                                            oninput="onChange()">
                                    </td>
                                    <td class="puntajeEvaluar2"><label id="DSE2" class="puntajeEvaluar" type="text"></label>
                                    </td>
                                    <td class="comision actv"><input id="comisionLic" placeholder="0"
                                            oninput="onActv2Comision()"></input>
                                    </td>
                                    <td><input id="obs2_2" name="obs2_2" class="table-header" type="text"></input></td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <th style="font-weight: normal; text-size: 20px;" scope="col">Acreditacion: </th>
                                    <th style="width:60px;padding-left: 100px;">DSE/DIIP</th>
                                    <th style="font-weight: normal; padding-left: 100px;">8.5 puntos por cada
                                        hora/semana/año en cada
                                        caso
                                    </th>
                                    <th>
                                        <button type="submit" class="btn btn-primary" id="form2_2Button">Enviar</button>
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </form>


            @endif
        </div>
        </main>

        <div>

            <footer>
                <div>

                    <canvas id="convocatoriaCanvas" width="1500" height="500"></canvas>
                </div>
                <!--
@component('components.pie-pag', ['number' => '0'])
@endcomponent-->
            </footer>

        </div>
    </div>
    </div>
    </div>

    <script>

        const convocatoria = document.querySelector('nav a').textContent.trim();
        const periodo = document.getElementById('periodo').textContent;
        const nombre = document.querySelector('input[name="nombre"]').value;
        const area = document.querySelector('select[name="area"]').value;
        const departamento = document.querySelector('select[name="departamento"]').value;
        const horasPosgrado = document.getElementById('horasPosgrado').value;
        const horasSemestre = document.getElementById('horasSemestre').value;

        const obs1 = document.getElementById('obs1').textContent;
        const obs2 = document.getElementById('obs2').textContent;
        const obs2_2 = document.getElementById('obs2_2').textContent;
        const hours = document.querySelector('#hoursText');
        //const actv2Comision = document.querySelector('#actv2ComisionText');


        let data = {
            convocatoria: convocatoria,
            periodo: periodo,
            nombre: nombre,
            area: area,
            departamento: departamento,
            horasPosgrado: horasPosgrado,
            horasSemestre: horasSemestre,
            obs1: obs1,
            obs2: obs2,
            obs2_2: obs2_2,
            docencia: docencia,
            hours: hoursText,

        };

        const dse = document.querySelector("#DSE");
        const puntajeAEvaluarPosgrado = document.querySelector("#horasPosgrado");

        const dse2 = document.querySelector("#DSE2");
        const puntajeAEvaluarSemestre = document.querySelector("#horasSemestre");
        const puntajePosgrado = 0, puntajeSemestre = 0, dsePosgrado = "", dseSemestre = "";
        function onload() {
            // Setup some event handlers. 
            var buttons = document.getElementsByClassName('button');
            for (var i = 0; i < buttons.length; i++) { buttons[i].addEventListener('click', handleClick); }

        }

        function handleClick(event) {
            var currentTarget = event.currentTarget;
            // Use the event data here. 
            console.log('Button clicked: ' + currentTarget.getAttribute('data-id'));
        } document.addEventListener('DOMContentLoaded', onload);
        function onChange() {
            // Obtener los valores de los inputs
            const puntajePosgrado = parseFloat(document.getElementById("horasPosgrado").value);
            const puntajeSemestre = parseFloat(document.getElementById("horasSemestre").value);
            const h = parseFloat(document.querySelector('#hoursText'));

            // Realizar los cálculos
            const dsePosgrado = puntajePosgrado * 8.5;
            const dseSemestre = puntajeSemestre * 8.5;
            const hora = (dsePosgrado + dseSemestre);

            // Actualizar el contenido de las etiquetas <label>
            document.getElementById("DSE").innerText = dsePosgrado;
            document.getElementById("DSE2").innerText = dseSemestre;

            // Mostrar los valores actualizados en la consola
            console.log(dsePosgrado);
            console.log(dseSemestre);

            const minimo = minWithSum(dsePosgrado, dseSemestre);

            document.getElementById("hoursText").innerText = minimo;
            console.log(minimo);


        }


        function hayObservacion(indiceActividad) {
            var selectEscala = document.getElementById('selectEscala' + indiceActividad);
            var selectActividad = document.getElementById('selectActividad' + indiceActividad);
            var inputObservacion = document.getElementById('observacion' + indiceActividad);
            var mensajeObservacion = document.getElementById('mensajeObservacion' + indiceActividad);

            if (selectActividad.value != 0 && selectEscala.value != 0) {
                mensajeObservacion.textContent = 'Observación: ' + inputObservacion.value;
                mensajeObservacion.style.display = 'block';
                return true;
            } else {
                mensajeObservacion.style.display = 'none';
                return false;
            }
        }


        const nav = document.querySelector('nav');
        let lastScrollLeft = 0; // Variable to store the last horizontal scroll position

        window.addEventListener('scroll', () => {
            let currentScrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

            // Check if scrolling to the right
            if (currentScrollLeft > lastScrollLeft) {
                // Scrolling to the right, hide the navigation
                nav.style.display = 'none';
            } else {
                // Scrolling to the left or not horizontally, show the navigation
                nav.style.display = 'block';
            }

            lastScrollLeft = currentScrollLeft <= 0 ? 0 : currentScrollLeft; // For Mobile or negative scrolling
        });



        // Function to check if there is an observation for a specific activity
        function hayObservacion(actividad) {
            const obs = document.querySelector(`#obs${actividad}`).value;
            return obs.trim() !== '';
        }

        function minWithSum(value1, value2) {
            const sum = value1 + value2;
            return Math.min(sum, 200);


        }

        function min40(...values) {
            const sum40 = values.reduce((acc, val) => acc + val, 0);
            return Math.min(sum40, 40);
        }

        function min30(...values) {
            const sum30 = values.reduce((acc, val) => acc + val, 0);
            return Math.min(sum30, 30);
        }

        function subtotal(value1, value2) {
            const st = value1 * value2;
            return st;
        }

        function min60(...values) {
            const sum60 = values.reduce((acc, val) => acc + val, 0);
            return Math.min(sum60, 60);
        }

        function minWithSumThree(value1, value2, value3, value4) {
            const ms = value1 + value2 + value3 + value4;
            return Math.min(ms, 100);
        }

        function min50(...values) {
            const ms = values.reduce((acc, val) => acc + val, 0);
            return Math.min(ms, 50);
        }

        function minWithSumThreeFive(value1, value2) {
            const ms = value1 + value2;
            return Math.min(ms, 75);
        }

        function minTutorias() {
            // convert the arguments object to an array
            const values = Array.from(arguments);

            // use reduce to sum the values
            const ms = values.reduce((acc, current) => {
                return acc + current;
            }, 0);

            // return the minimum of ms and 200
            return Math.min(ms, 200);
        }

        function min700(...values) {
            const ms = values.reduce((acc, val) => acc + val, 0);
            return Math.min(ms, 700);
        }

        // Función para actualizar el objeto data con los valores de los campos del formulario
        function actualizarData() {
            data[this.id] = this.value;
        }

        document.querySelector('input[name="horasActv2"]').addEventListener('input', function () {
            let horasActv2 = parseFloat(this.value) || 0;
            let puntajeEvaluar = 0;

            const A40 = 6.25;
            const B56 = 17;
            const B57 = 50;
            const variables = {};
            const variablesMultiplicadas = {};

            for (let i = 40; i <= 55; i++) {
                variables[`B${i}`] = i - 39;

                variablesMultiplicadas[`C${i}`] = A40 * variables[`B${i}`]; // Calculate and store in variablesMultiplicated object

                if (horasActv2 === variables[`B${i}`]) {
                    puntajeEvaluar = variablesMultiplicadas[`C${i}`];
                    break;
                }
            }

            const C56 = B56 * A40;
            const C57 = B57 * A40;

            if (horasActv2 >= 16) {
                puntajeEvaluar = 100;
            }

            // Obtiene una referencia a la etiqueta <td id="puntajeEvaluar">
            let puntajeEvaluarElement = document.getElementById('puntajeEvaluar');

            // Actualiza el valor de la etiqueta <td id="puntajeEvaluar">
            puntajeEvaluarElement.innerText = puntajeEvaluar.toFixed(2);
            document.getElementById('puntajeEvaluarInput').value = puntajeEvaluar.toFixed(2);
        });
        document.addEventListener('DOMContentLoaded', function () {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            async function submitForm(url, formId) {
                // Get form data
                let formData = {};
                let gridOptions = {};
                let form = document.getElementById(formId);
                // Ensure the form element exists
                if (!form) {
                    console.error(`Form with id "${formId}" not found.`);
                    return;
                }

                //Recoge los datos dependiendo del formulario actual
                switch (formId) {
                    case 'form1':
                        formData['convocatoria'] = form.querySelector('input[name="convocatoria"]').value;
                        formData['periodo'] = form.querySelector('input[name="periodo"]').value;
                        formData['nombre'] = form.querySelector('input[name="nombre"]').value;
                        formData['area'] = form.querySelector('select[name="area"]').selectedOptions[0].textContent;
                        formData['departamento'] = form.querySelector('select[name="departamento"]').selectedOptions[0].textContent;
                        break;

                    case 'form2':
                        formData['user_id'] = form.querySelector('input[name="user_id"]').value;
                        formData['email'] = form.querySelector('input[name="email"]').value;
                        formData['horasActv2'] = form.querySelector('input[name="horasActv2"]').value;
                        formData['puntajeEvaluar'] = form.querySelector('input[name="puntajeEvaluar"]').value;
                        //formData['comision1'] = form.querySelector('input[name="comision1"]').value;
                        formData['obs1'] = form.querySelector('input[name="obs1"]').value;
                        break;

                    case 'form2_2':
                        formData['user_id'] = form.querySelector('input[name="user_id"]').value;
                        formData['email'] = form.querySelector('input[name="email"]').value;
                        let hoursLabel = form.querySelector('label[id="hoursText"]');
                        //let actv2ComisionLabel = form.querySelector('td[id="actv2Comision"]');

                        if (!hoursLabel) {
                            console.error('Label with id "hoursText" not found.');
                        } else {
                            formData['hours'] = hoursLabel.innerText;
                        }

                        /*if (!actv2ComisionLabel) {
                          console.error('Label with id "actv2Comision" not found.');
                        } else {
                          formData['actv2Comision'] = actv2ComisionLabel.innerText;
                        }*/

                        formData['obs2'] = form.querySelector('input[name="obs2"]').value;
                        formData['obs2_2'] = form.querySelector('input[name="obs2_2"]').value;
                        break;

                }
                console.log('Form data:', formData);


                try {
                    let response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(formData),
                    });

                    let responseText = await response.text(); // Obtener el texto de la respuesta
                    console.log('Raw response from server:', responseText);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    let data = JSON.parse(responseText);
                    console.log('Response received from server:', data);
                } catch (error) {
                    console.error('There was a problem with the fetch operation:', error);
                }
            }

            window.submitForm = submitForm;
        });


        // Función para actualizar el label en el footer con la convocatoria y periodo de evaluación
        function actualizarLabelConvocatoriaPeriodo(convocatoria, periodo) {
            const label = document.getElementById('convocatoriaPeriodoLabel');
            label.textContent = `Convocatoria: ${convocatoria}, Período: ${periodo}`;
        }

        // Captura la convocatoria y periodo de evaluación al enviar el formulario form1
        document.addEventListener('DOMContentLoaded', function () {
            const form1 = document.getElementById('form1');
            form1.addEventListener('submit', function (event) {
                event.preventDefault(); // Evita el envío del formulario para manejarlo con JavaScript

                // Captura los valores del formulario form1
                const convocatoria = document.getElementById('convocatoria').value;
                const periodo = document.getElementById('periodo').value;

                // Actualiza el label en el footer con los valores capturados
                actualizarLabelConvocatoriaPeriodo(convocatoria, periodo);
                console.log(label);
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Get the canvas element
            var canvas = document.getElementById('convocatoriaCanvas');
            var context = canvas.getContext('2d');

            // Function to update the canvas with 'Convocatoria' value
            function updateCanvas(text) {
                // Clear the canvas
                context.clearRect(200, 100, canvas.width, canvas.height);

                // Set text properties
                context.font = '20px Arial';
                context.fillStyle = 'black';
                context.textAlign = 'right';
                context.textBaseline = 'middle';

                // Draw the text
                context.fillText(text, canvas.width / 2, canvas.height / 2);
            }

            // Get the input element with id 'convocatoria'
            var convocatoriaInput = document.getElementById('convocatoria');
            if (convocatoriaInput) {
                // Update the canvas initially with the placeholder value or empty
                updateCanvas(convocatoriaInput.placeholder);

                // Listen for input events to dynamically update the canvas
                convocatoriaInput.addEventListener('input', function () {
                    var newValue = convocatoriaInput.value;
                    updateCanvas(newValue);
                });
            }
        });


        document.addEventListener('DOMContentLoaded', function () {
            const userEmail = "{{ Auth::user()->email }}"; // Obtén el email del usuario desde Blade

            const allowedEmails = [
                'joma_18@alu.uabcs.mx',
                'oa.campillo@uabcs.mx',
                'rluna@uabcs.mx',
                'v.andrade@uabcs.mx'
            ];

            // Verifica si el email está en la lista de correos permitidos
            if (allowedEmails.includes(userEmail)) {
                // Muestra el enlace
                document.getElementById('jsonDataLink').classList.remove('d-none');
            }
        });
    </script>

</body>

</html>