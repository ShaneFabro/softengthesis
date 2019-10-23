<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = '/home';
    protected function redirectTo() {

        if(Auth::user()->role_id == 1){

            Log::channel('customlog')->info('User ' . Auth::user()->name . ' Logged In.');

            return route('admin.index');

        } elseif(Auth::user()->role_id == 2) {

            Log::channel('customlog')->info('User ' . Auth::user()->name . ' Logged In.');

            return route('dean.index');

        } elseif(Auth::user()->role_id == 3) {

            Log::channel('customlog')->info('User ' . Auth::user()->name . ' Logged In.');

            return route('head.index');

        } elseif(Auth::user()->role_id == 4){

            Log::channel('customlog')->info('User ' . Auth::user()->name . ' Logged In.');

            return route('member.index');
            
        }

    }

    public function credentials(Request $request){

        $credentials = $request->only($this->username(), 'password');

        $credentials['is_active'] = 1;
        
        return $credentials;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
