<?php

namespace App\Http\Controllers\AuthApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\LoginApiRequest;
use App\Services\ClientService;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function __construct(
        protected ClientService $clientService
    ) {
    }

    public function register(ClientRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $client = $this->clientService->create($data);

        if (!$client) return response()->json([
            "error" => "Erro ao criar Cliente"
        ], 500);

        return $this->response('Cliente criado com sucesso', 201, $client);
    }

    public function login(LoginApiRequest $request)
    {
        $credentials = $request->validated();
        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Credenciais inválidas'], 401);
        }

        $token = $request->user()->createToken('API Token')->plainTextToken;
        return $this->response('Token criado com sucesso', 201, [
            'token' => $token,
            'user'  => auth()->user()
        ]);
    }

    public function logout()
    {
        $client = auth()->user()->currentAccessToken();
        $client->delete();

        return response()->json([
            'message' => 'Cliente deslogado',
            'status'  => 'success'
        ], 200);
    }
}
