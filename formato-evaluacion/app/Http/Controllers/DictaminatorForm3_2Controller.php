<?php

namespace App\Http\Controllers;

use App\Models\DictaminatorsResponseForm3_2;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class DictaminatorForm3_2Controller extends TransferController
{
    public function storeform32(Request $request)
    {
        
        
        try {
            $validatedData = $request->validate([
                'dictaminador_id' => 'required|numeric',
                'user_id' => 'required|exists:users,id',
                'email' => 'required|exists:users,email',
                'score3_2' => 'required|numeric',
                'comision3_2' => 'required|numeric',
                'r1' => 'required|numeric',
                'r2' => 'required|numeric',
                'r3' => 'required|numeric',
                'cant1' => 'required|numeric',
                'cant2' => 'required|numeric',
                'cant3' => 'required|numeric',
                'prom90_100' => 'required|numeric',
                'prom80_90' => 'required|numeric',
                'prom70_80' => 'required|numeric',
                'obs3_2_1' => 'nullable|string',
                'obs3_2_2' => 'nullable|string',
                'obs3_2_3' => 'nullable|string',
                'user_type' => 'required|in:user,docente,dictaminator',
            ]);

            if (!isset($validatedData['score3_2'])) {
                $validatedData['score3_2'] = 0;
            }
            $validatedData['obs3_2_1'] = $validatedData['obs3_2_1'] ?? 'sin comentarios';
            $validatedData['obs3_2_2'] = $validatedData['obs3_2_2'] ?? 'sin comentarios';
            $validatedData['obs3_2_3'] = $validatedData['obs3_2_3'] ?? 'sin comentarios';


            
                DictaminatorsResponseForm3_2::create($validatedData);
                $this->checkAndTransfer('DictaminatorsResponseForm3_2');
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
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getFormData32(Request $request)
    {
        try {
            $data = DictaminatorsResponseForm3_2::where('user_id', $request->query('user_id'))->first();
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

