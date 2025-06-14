<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoricoConta;
use Illuminate\Http\Request;

class HistoricoContaController extends Controller
{
    /**
     * Lista todos os registros do histórico.
     */
    public function index()
    {
        $historico = HistoricoConta::all();
        return response()->json($historico);
    }

    /**
     * Mostra um registro específico do histórico.
     */
    public function show($id)
    {
        $registro = HistoricoConta::find($id);

        if (!$registro) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        return response()->json($registro);
    }

    /**
     * (Opcional) Remove um item do histórico permanentemente.
     */
    public function destroy($id)
    {
        $registro = HistoricoConta::find($id);

        if (!$registro) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }

        $registro->delete();

        return response()->json(['message' => 'Registro excluído do histórico']);
    }
}
