<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function login(array $validate): string|false
    {
        $user = User::where('email', $validate['email'])->first();
        if (is_null($user)) return false;
        $guard = Auth::guard('api');
        /** @var User $model */
        $model = $guard->getProvider()->retrieveById($user->id);

        return $model->createToken('api-token')->plainTextToken;
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
