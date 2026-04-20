<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Service\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginController
{
    public function __construct(private AuthService  $authService)
    {

}
    public function login(LoginRequest $request): JsonResponse
    {
        $validate = $request->validated();
        $token = $this->authService->login($validate);
        if (!$token) return response()->json(false, Response::HTTP_UNAUTHORIZED);
        return response()->json(['token' => $token]);
    }
}
