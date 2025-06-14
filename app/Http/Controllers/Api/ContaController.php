<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Conta;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    /**
     * Retorna todas as contas cadastradas.
     */
    public function index()
    {
        $contas = Conta::all();
        return response()->json($contas, 200);
    }

    /**
     * Cria uma nova conta.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'nome_da_conta' => 'required|string|max:255',
        'data' => 'required|date',
        'agua' => 'nullable|numeric',
        'luz' => 'nullable|numeric',
        'gas' => 'nullable|numeric',
        'lazer' => 'nullable|numeric',
        'outros' => 'nullable|numeric',
        'usuario_id' => 'required|exists:usuarios,id',
    ]);

    // Preencher valores nulos com 0 antes da soma
    $agua = $data['agua'] ?? 0;
    $luz = $data['luz'] ?? 0;
    $gas = $data['gas'] ?? 0;
    $lazer = $data['lazer'] ?? 0;
    $outros = $data['outros'] ?? 0;

    // Calcular o valor total
    $data['valor_total'] = $agua + $luz + $gas + $lazer + $outros;

    // Criar a conta
    $conta = \App\Models\Conta::create($data);

    return response()->json([
        'message' => 'Conta criada com sucesso',
        'conta' => $conta
    ], 201);
}


    /**
     * Retorna uma conta específica.
     */
    public function show($id)
    {
        $conta = Conta::find($id);

        if (!$conta) {
            return response()->json(['message' => 'Conta não encontrada'], 404);
        }

        return response()->json($conta);
    }

    /**
     * Atualiza uma conta existente.
     */
    public function update(Request $request, $id)
    {
        $conta = Conta::find($id);
    
        if (!$conta) {
            return response()->json(['message' => 'Conta não encontrada'], 404);
        }
    
        $data = $request->validate([
            'nome_da_conta' => 'sometimes|string|max:255',
            'data' => 'sometimes|date',
            'agua' => 'nullable|numeric',
            'luz' => 'nullable|numeric',
            'gas' => 'nullable|numeric',
            'lazer' => 'nullable|numeric',
            'outros' => 'nullable|numeric',
            'usuario_id' => 'sometimes|exists:usuarios,id',
        ]);
    
        // Pega os valores atuais ou os novos valores informados para cálculo
        $agua = $data['agua'] ?? $conta->agua ?? 0;
        $luz = $data['luz'] ?? $conta->luz ?? 0;
        $gas = $data['gas'] ?? $conta->gas ?? 0;
        $lazer = $data['lazer'] ?? $conta->lazer ?? 0;
        $outros = $data['outros'] ?? $conta->outros ?? 0;
    
        // Calcula o total
        $data['valor_total'] = $agua + $luz + $gas + $lazer + $outros;
    
        $conta->update($data);
    
        return response()->json($conta);
    }
    

    /**
     * Remove uma conta.
     */
    public function destroy($id)
    {
        $conta = Conta::find($id);

        if (!$conta) {
            return response()->json(['message' => 'Conta não encontrada'], 404);
        }

        // Copiar dados para o histórico
        \App\Models\HistoricoConta::create([
            'nome_da_conta' => $conta->nome_da_conta,
            'data' => $conta->data,
            'agua' => $conta->agua,
            'luz' => $conta->luz,
            'gas' => $conta->gas,
            'lazer' => $conta->lazer,
            'outros' => $conta->outros,
            'valor_total' => $conta->valor_total,
            'usuario_id' => $conta->usuario_id,
            'status' => 'excluida',
            'excluida_em' => now(),
        ]);        

        // Deletar conta
        $conta->delete();

        return response()->json(['message' => 'Conta deletada e movida para histórico']);
    }
}
