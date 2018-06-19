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

    public function login(Request $request) {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        try{
            auth()->login(User::authenticate(request()->get('username'), request()->get('password')));
            return response()->json(["message" => "Successfully logged in. Redirecting..."]);
        } catch (\Exception $exception) {
            throw new CMPResponseException("validation_failure", ["username" => ["A system error occurred. ({$exception->getMessage()})"]]);
        }

    }

    public function logout() {
        auth()->logout();
        return redirect()->route('login');
    }
}
