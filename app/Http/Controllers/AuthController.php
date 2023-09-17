<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register (RegistroRequest $request) {
        // Validar el registro
        $data = $request->validated();

        // Crear usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        // Retornar una respuesta
        return [
            // createToken('token'), en sí, esa palabra 'token', puede ser cualquier nombre ya que ese es valor que se almacenará en la tabla "personal_access_token"
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function login (LoginRequest $request) {
        $data = $request->validated();

        // Revisar password
        if (!Auth::attempt($data)) { // en caso de que no se pueda autenticar al usuario
            return response([
                'errors' => ['El email o el password con incorrectos']
            ], 422);
        }

        // Autenticar al usuario
        // Una vez que el usuario haya colocado correctamente su email y password, vamos a generar y retornar un token
        $user = Auth::user();
        return [
            // createToken('token'), en sí, esa palabra 'token', puede ser cualquier nombre ya que ese es valor que se almacenará en la tabla "personal_access_token"
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function logout (Request $request) {
        $user = $request->user();
        $user->currentAccessToken()->delete(); // elimina el token de la BD

        return [
            'user' => null
        ];
    }
}
