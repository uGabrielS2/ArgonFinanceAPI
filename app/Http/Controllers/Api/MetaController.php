<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    public function index()
    {
        $metas = Meta::all();
        return response()->json($metas);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome_da_meta' => 'required|string|max:255',
            'valor_da_meta' => 'required|numeric|min:0',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        $meta = Meta::create($data);

        return response()->json($meta, 201);
    }

    public function show($id)
    {
        $meta = Meta::find($id);

        if (!$meta) {
            return response()->json(['message' => 'Meta não encontrada'], 404);
        }

        return response()->json($meta);
    }

    public function update(Request $request, $id)
    {
        $meta = Meta::find($id);

        if (!$meta) {
            return response()->json(['message' => 'Meta não encontrada'], 404);
        }

        $data = $request->validate([
            'nome_da_meta' => 'sometimes|string|max:255',
            'valor_da_meta' => 'sometimes|numeric|min:0',
            'usuario_id' => 'sometimes|exists:usuarios,id',
        ]);

        $meta->update($data);

        return response()->json($meta);
    }

    public function destroy($id)
    {
        $meta = Meta::find($id);

        if (!$meta) {
            return response()->json(['message' => 'Meta não encontrada'], 404);
        }

        $meta->delete();

        return response()->json(['message' => 'Meta deletada com sucesso']);
    }
}
