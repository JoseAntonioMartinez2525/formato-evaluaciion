<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ConsolidatedResponseController extends Controller
{
    public function showResumen()
    {
        // Recuperar los datos de comisiones
        $consolidatedResponses = DB::table('consolidated_responses')->get();
        // Calcular subtotales para las secciones 3.1 a 3.8
        $subtotal3_1To3_8 = $consolidatedResponses->reduce(function ($carry, $response) {
            return $carry + $response->actv3Comision + $response->comision3_2 + $response->comision3_3 + $response->comision3_4 + $response->comision3_5 + $response->comision3_6 + $response->comision3_7 + $response->comision3_8;
        }, 0);

        $subtotal3_9To3_11 = $consolidatedResponses->reduce(function ($carry, $response) {
            return $carry + $response->comision3_9 + $response->comision3_10 + $response->comision3_11;
        }, 0);

        $subtotal3_12To3_16 = $consolidatedResponses->reduce(function ($carry, $response) {
            return $carry + $response->comision3_12 + $response->comision3_13 + $response->comision3_14 + $response->comision3_15 + $response->comision3_16;
        }, 0);


        $subtotal3_17To3_19 = $consolidatedResponses->reduce(function ($carry, $response) {
            return $carry + $response->comision3_17 + $response->comision3_18 + $response->comision3_19;
        }, 0);




        // Estructurar los datos en secciones
        $response = DB::table('consolidated_responses')->first();
        $sections = [


                        [
                            'label' => '1. Permanencia en las actividades de la docencia',
                            'value' => 100,
                            'comision' => $response->comision1 ?? 0,
                        ],
                      


                        [
                            'label' => '1.1 Años de experiencia docente en la institución',
                            'value' => 100,
                            'comision' => $response->comision1 ?? 0,
                        ],
                        // Añadir más datos de la sección "Experiencia"


                        [
                            'label' => '2. Dedicación en el desempeño docente<',
                            'value' => 200,
                            'comision' => $response->actv2Comision ?? 0,
                        ],
        

                        [
                            'label' => '2.1 Carga de trabajo docente frente a grupo',
                            'value' => 200,
                            'comision' => $response->actv2Comision ?? 0,
                        ],


                        [
                            'label' => '3.1 Participación en actividades de diseño curricular',
                            'value' => 60,
                            'comision' => $response->actv3Comision ?? 0,
                        ],


                        [
                            'label' => '3.2 Calidad del desempeño docente evaluada por los estudiantes',
                            'value' => 50,
                            'comision' => $response->comision3_2 ?? 0,
                        ],



                        [
                            'label' => '3.3 Publicaciones relacionadas con la docencia',
                            'value' => 100,
                            'comision' => $response->comision3_3 ?? 0,
                        ],



                        [
                            'label' => '3.4 Distinciones académicas recibidas por el docente',
                            'value' => 60,
                            'comision' => $response->comision3_4 ?? 0,
                        ],



                        [
                            'label' => '3.5 Asistencia, puntualidad y permanencia en el desempeño docente, evaluada por el JD y por CAAC',
                            'value' => 75,
                            'comision' => $response->comision3_5 ?? 0,
                        ],



                        [
                            'label' => '3.6 Capacitación y actualización pedagógica recibida',
                            'value' => 40,
                            'comision' => $response->comision3_6 ?? 0,
                        ],



                        [
                            'label' => '3.7 Cursos de actualización disciplinaria recibidos dentro de su área de conocimiento',
                            'value' => 40,
                            'comision' => $response->comision3_7 ?? 0,
                        ],



                        [
                            'label' => '3.8 Impartición de cursos, diplomados, seminarios, talleres extracurriculares, de educación, continua o de formación y capacitación docente',
                            'value' => 40,
                            'comision' => $response->comision3_8 ?? 0,
                        ],


            [
                'label' => 'Subtotal 3.1 a 3.8',
                'value' => '',
                'comision' => $subtotal3_1To3_8,
                'is_subtotal' => true,
            ],


                        [
                            'label' => '3.9 Trabajos dirigidos para la titulación de estudiantes',
                            'value' => 200,
                            'comision' => $response->comision3_9 ?? 0,
                        ],




                        [
                            'label' => '3.10 Tutorías a estudiantes',
                            'value' => 115,
                            'comision' => $response->comision3_10 ?? 0,
                        ],




                        [
                            'label' => '3.11 Asesoría a estudiantes',
                            'value' => 95,
                            'comision' => $response->comision3_11 ?? 0,
                        ],


            [
                'label' => 'Subtotal 3.9 a 3.11',
                'value' => '',
                'comision' => $subtotal3_9To3_11,
                'is_subtotal' => true,
            ],


                        [
                            'label' => '3.12 Publicaciones de investigación relacionadas con el contenido de los PE que imparte el docente',
                            'value' => 150,
                            'comision' => $response->comision3_12 ?? 0,
                        ],



                        [
                            'label' => '3.13 Proyectos académicos de investigación',
                            'value' => 130,
                            'comision' => $response->comision3_13 ?? 0,
                        ],



                        [
                            'label' => '3.14 Participación como ponente en congresos o eventos académicos del área de conocimiento o afines del docente',
                            'value' => 40,
                            'comision' => $response->comision3_14 ?? 0,
                        ],



                        [
                            'label' => '3.15 Registro de patentes y productos de investigación tecnológica y educativa',
                            'value' => 60,
                            'comision' => $response->comision3_15 ?? 0,
                        ],



                        [
                            'label' => '3.16 Actividades de arbitraje, revisión, corrección y edición',
                            'value' => 30,
                            'comision' => $response->comision3_16 ?? 0,
                        ],


            [
                'label' => 'Subtotal 3.12 a 3.16',
                'value' => '',
                'comision' => $subtotal3_12To3_16,
                'is_subtotal' => true,
            ],


                        [
                            'label' => '3.17 Proyectos académicos de extensión y difusión',
                            'value' => 50,
                            'comision' => $response->comision3_17 ?? 0,
                        ],



                        [
                            'label' => '3.18 Organización de congresos o eventos institucionales del área de conocimiento del Docente',
                            'value' => 40,
                            'comision' => $response->comision3_18 ?? 0,
                        ],



                        [
                            'label' => '3.19 Participación en cuerpos colegiados',
                            'value' => 40,
                            'comision' => $response->comision3_19 ?? 0,
                        ],


            [
                'label' => 'Subtotal 3.17 a 3.19',
                'value' => '',
                'comision' => $subtotal3_17To3_19,
                'is_subtotal' => true,
            ],
        ];



        // Pasar los datos a la vista resumen.blade.php
        return view('form4', ['sections' => $sections, 'subtotal3_1To3_8' => $subtotal3_1To3_8, 'subtotal3_9To3_11'=> $subtotal3_9To3_11,'subtotal3_12To3_16'=> $subtotal3_12To3_16,'subtotal3_17To3_19'=> $subtotal3_17To3_19]);

    }

    
}