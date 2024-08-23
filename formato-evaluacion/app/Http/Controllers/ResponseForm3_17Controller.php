<?php

namespace App\Http\Controllers;

use App\Models\UsersResponseForm3_17;
use Illuminate\Http\Request;

class ResponseForm3_17Controller extends Controller
{
    public function store317(Request $request)
    {
        try {
            // Validate request data
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'email' => 'required|exists:users,email',
                'score3_17' => 'required|numeric',
                //'comision3_17' => 'required|numeric',
                'obsDifusionExt' => 'nullable|string',
                'obsDifusionInt' => 'nullable|string',
                'obsRepDifusionExt' => 'nullable|string',
                'obsRepDifusionInt' => 'nullable|string',
                'user_type' => 'required|in:user,docente,dictaminator',


            ]);

            // Assign default value if not provided
            $validatedData['obsDifusionExt'] = $validatedData['obsDifusionExt'] ?? 'sin comentarios';
            $validatedData['obsDifusionInt'] = $validatedData['obsDifusionInt'] ?? 'sin comentarios';
            $validatedData['obsRepDifusionExt'] = $validatedData['obsRepDifusionExt'] ?? 'sin comentarios';
            $validatedData['obsRepDifusionInt'] = $validatedData['obsRepDifusionInt'] ?? 'sin comentarios';


            // Create a new record using Eloquent ORM
            UsersResponseForm3_17::create($validatedData);

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

    public function getData317(Request $request)
    {
        try {
            $data = UsersResponseForm3_17::where('user_id', $request->query('user_id'))->first();
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

