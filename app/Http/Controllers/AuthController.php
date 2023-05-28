<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Helpers\ApiResponser;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cookie;
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

        $token = $user->createToken('API Token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24);

        return $this->success([
            'user'  => UserResource::make($user),
        ])->withCookie($cookie);
    }

    public function logout(Request $request)
    {
        Auth::user()->tokens()->delete();
        $cookie = Cookie::forget('jwt');
        return $this->success(null, "Chao Pesca'o");
    }
}
