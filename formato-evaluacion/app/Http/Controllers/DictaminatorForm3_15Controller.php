<?php

namespace App\Http\Controllers;

use App\Models\DictaminatorsResponseForm3_15;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class DictaminatorForm3_15Controller extends Controller
{
    public function storeform315(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'dictaminador_id' => 'required|numeric',
                'user_id' => 'required|exists:users,id',
                'email' => 'required|exists:users,email',
                'score3_15' => 'required|numeric',
                'comision3_15' => 'required|numeric',
                'cantPatentes' => 'required|numeric',
                'subtotalPatentes' => 'required|numeric',
                'comisionPatententes' => 'required|numeric',
                'cantPrototipos' => 'required|numeric',
                'subtotalPrototipos' => 'required|numeric',
                'comisionPrototipos' => 'required|numeric',
                'obsPatentes' => 'nullable|string',
                'obsPrototipos' => 'nullable|string',
                'user_type' => 'required|in:user,docente,dictaminator',
            ]);

            if (!isset($validatedData['score3_15'])) {
                $validatedData['score3_15'] = 0;
            }
            $validatedData['obsPatentes'] = $validatedData['obsPatentes'] ?? 'sin comentarios';
            $validatedData['obsPrototipos'] = $validatedData['obsPrototipos'] ?? 'sin comentarios';



            DictaminatorsResponseForm3_15::create($validatedData);
            return response()->json([
                'success' => true,
                'message' => 'Data successfully saved',
                'data' => $validatedData,
            ], 200);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Database error: ' . $e->getMessage(),
            ], 500); // Cambiado de 1200 a 500
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500); // Cambiado de 1200 a 500
        }

    }

    public function getFormData315(Request $request)
    {
        try {
            $data = DictaminatorsResponseForm3_15::where('user_id', $request->query('user_id'))->first();
            if (!$data) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving data: ' . $e->getMessage(),
            ], 500);
        }

    }
}

