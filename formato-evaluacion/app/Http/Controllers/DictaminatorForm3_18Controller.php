<?php

namespace App\Http\Controllers;

use App\Models\DictaminatorsResponseForm3_18;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class DictaminatorForm3_18Controller extends Controller
{
    public function storeform312(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'dictaminador_id' => 'required|numeric',
                'user_id' => 'required|exists:users,id',
                'email' => 'required|exists:users,email',
                'score3_18' => 'required|numeric',
                'comision3_18' => 'required|numeric',
                'cantComOrgInt' => 'required|numeric',
                'cantComOrgNac' => 'required|numeric',
                'cantComOrgReg' => 'required|numeric',
                'cantComApoyoInt' => 'required|numeric',
                'cantComApoyoNac' => 'required|numeric',
                'cantComApoyoReg' => 'required|numeric',
                'cantCicloComOrgInt' => 'required|numeric',
                'cantCicloComOrgNac' => 'required|numeric',
                'cantCicloComOrgReg' => 'required|numeric',
                'cantCicloComApoyoInt' => 'required|numeric',
                'cantCicloComApoyoNac' => 'required|numeric',
                'cantCicloComApoyoReg' => 'required|numeric',
                'subtotalComOrgInt' => 'required|numeric',
                'subtotalComOrgNac' => 'required|numeric',
                'subtotalComOrgReg' => 'required|numeric',
                'subtotalComApoyoInt' => 'required|numeric',
                'subtotalComApoyoNac' => 'required|numeric',
                'subtotalComApoyoReg' => 'required|numeric',
                'subtotalCicloComOrgInt' => 'required|numeric',
                'subtotalCicloComOrgNac' => 'required|numeric',
                'subtotalCicloComOrgReg' => 'required|numeric',
                'subtotalCicloComApoyoInt' => 'required|numeric',
                'subtotalCicloComApoyoNac' => 'required|numeric',
                'subtotalCicloComApoyoReg' => 'required|numeric',
                'comisionComOrgInt' => 'required|numeric',
                'comisionComOrgNac' => 'required|numeric',
                'comisionComOrgReg' => 'required|numeric',
                'comisionComApoyoInt' => 'required|numeric',
                'comisionComApoyoNac' => 'required|numeric',
                'comisionComApoyoReg' => 'required|numeric',
                'comisionCicloComOrgInt' => 'required|numeric',
                'comisionCicloComOrgNac' => 'required|numeric',
                'comisionCicloComOrgReg' => 'required|numeric',
                'comisionCicloComApoyoInt' => 'required|numeric',
                'comisionCicloComApoyoNac' => 'required|numeric',
                'comisionCicloComApoyoReg' => 'required|numeric',
                'obsComOrgInt' => 'nullable|string',
                'obsComOrgNac' => 'nullable|string',
                'obsComOrgReg' => 'nullable|string',
                'obsComApoyoInt' => 'nullable|string',
                'obsComApoyoNac' => 'nullable|string',
                'obsComApoyoReg' => 'nullable|string',
                'obsCicloComOrgInt' => 'nullable|string',
                'obsCicloComOrgNac' => 'nullable|string',
                'obsCicloComOrgReg' => 'nullable|string',
                'obsCicloComApoyoInt' => 'nullable|string',
                'obsCicloComApoyoNac' => 'nullable|string',
                'obsCicloComApoyoReg' => 'nullable|string',
                'user_type' => 'required|in:user,docente,dictaminator',
            ]);

            if (!isset($validatedData['score3_18'])) {
                $validatedData['score3_18'] = 0;
            }
            $validatedData['obsComOrgInt'] = $validatedData['obsComOrgInt'] ?? 'sin comentarios';
            $validatedData['obsComOrgNac'] = $validatedData['obsComOrgNac'] ?? 'sin comentarios';
            $validatedData['obsComOrgReg'] = $validatedData['obsComOrgReg'] ?? 'sin comentarios';
            $validatedData['obsComApoyoInt'] = $validatedData['obsComApoyoInt'] ?? 'sin comentarios';
            $validatedData['obsComApoyoNac'] = $validatedData['obsComApoyoNac'] ?? 'sin comentarios';
            $validatedData['obsComApoyoReg'] = $validatedData['obsComApoyoReg'] ?? 'sin comentarios';
            $validatedData['obsCicloComOrgInt'] = $validatedData['obsCicloComOrgInt'] ?? 'sin comentarios';
            $validatedData['obsCicloComOrgNac'] = $validatedData['obsCicloComOrgNac'] ?? 'sin comentarios';
            $validatedData['obsCicloComOrgReg'] = $validatedData['obsCicloComOrgReg'] ?? 'sin comentarios';
            $validatedData['obsCicloComApoyoReg'] = $validatedData['obsCicloComApoyoReg'] ?? 'sin comentarios';
            $validatedData['obsCicloComApoyoInt'] = $validatedData['obsCicloComApoyoInt'] ?? 'sin comentarios';
            $validatedData['obsCicloComApoyoNac'] = $validatedData['obsCicloComApoyoNac'] ?? 'sin comentarios';



            DictaminatorsResponseForm3_18::create($validatedData);
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

    public function getFormData312(Request $request)
    {
        try {
            $data = DictaminatorsResponseForm3_18::where('user_id', $request->query('user_id'))->first();
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
