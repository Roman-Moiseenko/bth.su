<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    public function login(LoginRequest $request): JsonResponse
    {
        //TODO Протестить
        try {
            $validate = $request->validated();
            $user = User::where('email', $validate['email'])->first();
            $guard = Auth::guard('api');
            /** @var User $model */
            $model = $guard->getProvider()->retrieveById($user->id);
            $token = $model->createToken('api-token')->plainTextToken;
            return response()->json(['token' => $token]);

        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_UNAUTHORIZED);
        }
    }
}
