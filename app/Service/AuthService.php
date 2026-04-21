<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService
{

    public function login(array $validate): string|false
    {
        \Log::info(json_encode($validate));
        //TODO Протестить
        $user = User::where('email', $validate['email'])->first();
        \Log::info($user->id);
        if (is_null($user)) return false;
        $guard = Auth::guard('api');
        /** @var User $model */
        $model = $guard->getProvider()->retrieveById($user->id);
        \Log::info(json_encode($model));
        return $model->createToken('api-token')->plainTextToken;
    }

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
    }
}
