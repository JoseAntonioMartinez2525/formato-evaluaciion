<?php

namespace App\Http\Controllers;

use App\Models\DictaminatorsResponseForm3_1;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class DictaminatorForm3_1Controller extends Controller
{
    public function storeform31(Request $request)
    {
        \Log::info('Request data:', $request->all()); // Ver los datos que se están haciendo
        try {
            $validatedData = $request->validate([
                'user_id' => 'required|exists:users,id',
                'email' => 'required|exists:users,email',
                'elaboracion' => 'required|numeric',
                'elaboracionSubTotal1' => 'required|numeric', // Allow nullable
                'comisionIncisoA' => 'required|numeric',
                'elaboracion2' => 'required|numeric',
                'elaboracionSubTotal2' => 'required|numeric',
                'comisionIncisoB' => 'required|numeric',
                'elaboracion3' => 'required|numeric',
                'elaboracionSubTotal3' => 'required|numeric',
                'comisionIncisoC' => 'required|numeric',
                'elaboracion4' => 'required|numeric',
                'elaboracionSubTotal4' => 'required|numeric',
                'comisionIncisoD' => 'required|numeric',
                'elaboracion5' => 'required|numeric',
                'elaboracionSubTotal5' => 'required|numeric',
                'comisionIncisoE' => 'required|numeric',
                'score3_1' => 'required|numeric',
                'actv3Comision' => 'required|numeric',
                'obs3_1_1' => 'nullable|string',
                'obs3_1_2' => 'nullable|string',
                'obs3_1_3' => 'nullable|string',
                'obs3_1_4' => 'nullable|string',
                'obs3_1_5' => 'nullable|string',
                'user_type' => 'required|in:user,docente,dictaminator',
            ]);

            \Log::info('Validated Data:', $validatedData);

            if (!isset($validatedData['score3_1'])) {
                $validatedData['score3_1'] = 0;
            }
            $validatedData['obs3_1_1'] = $validatedData['obs3_1_1'] ?? 'sin comentarios';
            $validatedData['obs3_1_2'] = $validatedData['obs3_1_2'] ?? 'sin comentarios';
            $validatedData['obs3_1_3'] = $validatedData['obs3_1_3'] ?? 'sin comentarios';
            $validatedData['obs3_1_4'] = $validatedData['obs3_1_4'] ?? 'sin comentarios';
            $validatedData['obs3_1_5'] = $validatedData['obs3_1_5'] ?? 'sin comentarios';

            try {
                DictaminatorsResponseForm3_1::create($validatedData);
            } catch (QueryException $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al procesar la solicitud: ' . $e->getMessage(),
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data successfully saved',
                'data' => $validatedData
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
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getFormData31(Request $request)
    {
        try {
            $data = DictaminatorsResponseForm3_1::where('user_id', $request->query('user_id'))->first();
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
