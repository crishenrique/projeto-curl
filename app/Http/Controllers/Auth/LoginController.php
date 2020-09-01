<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request){
        $data = $request->only([
            'username',
            'password'
        ]);

        $validator = $this->validator($data);

        if($validator->fails()){
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        if(Auth::attempt($data)){
            return redirect()->route('home');
        }else{
            $validator->errors()->add('password', 'Usuário e/ou senha incorreto(s).');

            return redirect()->route('login')->withErrors($validator)->withInput();
        }
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:3']
        ]);
    }

}
