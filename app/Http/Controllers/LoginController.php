<?php

namespace App\Http\Controllers;

use App\Exceptions\CMPResponseException;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mockery\Exception;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['logout']);
    }

    public function showLoginForm() {
        return view('admin.login');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws CMPResponseException
     */
    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        auth()->login(User::authenticate(request()->get('username'), request()->get('password')));
        return response()->json(["message" => "Successfully logged in. Redirecting..."]);
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('login');
    }
}
