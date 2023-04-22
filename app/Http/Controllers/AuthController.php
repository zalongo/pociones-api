<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Helpers\ApiResponser;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email'    => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        if (!Auth::attempt($attr)) {
            return $this->error('Usuario y/o Contraseña Incorrectos', Response::HTTP_UNAUTHORIZED);
        }

        $user = auth()->user();

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken,
            'user'  => UserResource::make($user),
        ]);
    }

    public function logout()
    {
        Auth:: user()->tokens()->delete();

        return $this->success(null, "Chao Pesca'o");
    }
}
