<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\UsersResponseForm2_2;
use App\Models\DictaminatorsResponseForm2_2;

class ResponseForm2_2Controller extends Controller
{
    public function store3(Request $request)
    {
        try {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'email' => 'required|exists:users,email',
            'hours' => 'required|numeric',
            'horasPosgrado' => 'required|numeric',
            'horasSemestre' => 'required|numeric',
            'dse' => 'required|numeric',
            'dse2' => 'required|numeric',
            'obs2' => 'nullable|string',
            'obs2_2' => 'nullable|string',
            'user_type' => 'required|in:user,docente,dictaminator',
        ]);

            $validatedData['form_type'] = 'form2_2';
        // Assign a default value if hours is not provided
        if (!isset($validatedData['hours'])) {
            $validatedData['hours'] = 0;
        }
        $validatedData['obs2'] = $validatedData['obs2'] ?? 'sin comentarios';
        $validatedData['obs2_2'] = $validatedData['obs2_2'] ?? 'sin comentarios';

            $horasSemestre = $validatedData['horasSemestre'] ?? 0.0;
            $horasPosgrado = $validatedData['horasPosgrado'] ?? 0.0;

        // Guardar en la tabla correspondiente según el tipo de usuario

        UsersResponseForm2_2::create($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Form submitted successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getData22(Request $request)
    {

        $data = UsersResponseForm2_2::where('user_id', $request->query('user_id'))->first();
        return response()->json($data);
    }
}

