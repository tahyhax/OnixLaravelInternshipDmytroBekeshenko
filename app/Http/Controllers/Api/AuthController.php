<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !$this->checkHash($request, $user, 'password')) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }
        Auth::guard('api')->setUser($user);

        return response()->json([
            'status_code' => Response::HTTP_OK,
            'access_token' => $user->createToken('authToken')->plainTextToken,
            'token_type' => 'Bearer',
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
//        https://stackoverflow.com/questions/62496954/laravel-7-sanctum-logout

        return response()->json([
            'status_code' => Response::HTTP_OK,
            'auth' => !$request->user()->currentAccessToken()->delete()
        ]);
    }


    /**
     * @param Request $request
     * @param Model $model
     * @param string $field
     * @return bool
     */
    protected function checkHash($request, $model, $field)
    {
        return Hash::check($request->{$field}, $model->{$field}, []);
    }

}