<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\FullName;
use App\Services\ClientService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ClientController extends Controller
{
    public function __construct(
        protected ClientService $clientService
    ) {
    }

    public function index()
    {
        if (empty($this->clientService->fetchAll()->all())) return response()->json([
            'status'    => 'error',
            'message'   => 'Nenhum cliente encontrado'
        ], 404);
        return $this->clientService->fetchAll();
    }

    public function findById(int $id)
    {
        $client = User::find($id);

        if (!$client) return response()->json([
            "status"    => 'error',
            "message"   => 'Cliente não encontrado'
        ], 404);

        return response()->json([
            "status"    => 'success',
            "data"      => $client
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            "name"      => ['nullable', 'string', new FullName],
            "email"     => ['nullable', 'email', 'unique:users'],
            "password"  => ['nullable', Password::min(6)]
        ]);

        $client = $this->clientService->update($request->all(), $id);
        if (!$client) return response()->json([
            "status"    => "error",
            "message"   => 'Erro ao atualizar o cliente'
        ], 500);

        return response()->json([
            "message"   => 'Cliente atualizado com sucesso',
            "data"      => $client
        ]);
    }

    public function destroy(int $id)
    {
        try {
            $this->clientService->delete($id);

            return response()->json(['message' => 'Cliente deletado com sucesso']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Cliente não encontrado: ' . $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao excluir cliente: ' . $e->getMessage()]);
        }
    }
}
