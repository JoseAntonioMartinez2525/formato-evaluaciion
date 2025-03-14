<?php

namespace App\Http\Controllers;

use App\Events\EvaluationCompleted;
use App\Models\UsersResponseForm3_7;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResponseForm3_7Controller extends Controller
{
    public function store37(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'email' => 'required|exists:users,email',
                'score3_7' => 'required|numeric',
                //'comision3_7' => 'required|numeric',
                'puntaje3_7' => 'required|numeric',
                'puntajeHoras3_7' => 'required|numeric',
                'obs3_7_1' => 'nullable|string',
                'user_type' => 'required|in:user,docente,dictaminator',

            ]);

            $validatedData['form_type'] = 'form3_7';
            // Assign default value if not provided
            $validatedData['obs3_7_1'] = $validatedData['obs3_7_1'] ?? 'sin comentarios';

            $docenteData = DB::table('dictaminators_response_form3_7')
                ->where('user_id', $validatedData['user_id'])
                ->select('comision3_7')
                ->first();


            // Pasar el valor a $validatedData para asegurar que esté disponible en la vista
            $validatedData['comision3_7'] = $docenteData->comision3_7 ?? null;


            // Create a new record using Eloquent ORM
            UsersResponseForm3_7::create($validatedData);
            // Disparar evento después de la creación del registro
            event(new EvaluationCompleted($validatedData['user_id']));

            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully!',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation errors
            \Log::error('Validation error: ' . $e->getMessage(), ['errors' => $e->errors()]);
            return response()->json([
                'success' => false,
                'message' => 'Validation error: ' . $e->getMessage(),
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Log other errors
            \Log::error('Error submitting form: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error submitting form: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getData37(Request $request)
    {
        try {
            $data = UsersResponseForm3_7::where('user_id', $request->query('user_id'))->first();
            return response()->json($data);
        } catch (\Exception $e) {
            \Log::error('Error retrieving data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving data: ' . $e->getMessage(),
            ], 500);
        }
    }
}

