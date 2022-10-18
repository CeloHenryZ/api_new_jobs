<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Providers\FunctionServiceProvider;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'registerUser']]);
    }

    public function registerUser(RegisterRequest $req)
    {
        $verifyCpfOrCnpj = $req->verifyCpfOrCnpj($req);

        if ($verifyCpfOrCnpj){
            try {

                if ($validated = $req->validated()) {

                    $user = User::create(
                        array_merge(
                            $validated,
                            $req->verifyCpfOrCnpj($req)
                        )
                    );

                    if ($token = auth()->attempt($validated)) {
                        return response()->json([
                            "response" => "Usuario criado com sucesso",
                            "token" => $this->respondWithToken($token),
                        ], 201);
                    }

                    return response()->json([
                        "algo deu errado :("
                    ], 403);
                }

            } catch( \Exception $e) {
                return response($e);
            }
        }
    }

    public function login(LoginRequest $req)
    {
        if($credentials = $req->validated()) {
            if(! $token = auth()->attempt($credentials)){
                return response()->json(['error' => 'unauthorized'], 401);
            }

            return $this->respondWithToken($token);
        }
    }


    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        auth()->logout();
        return response()->json([
            'message' => 'successfully logged out'
        ]);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
