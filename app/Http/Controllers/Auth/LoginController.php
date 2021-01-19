<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite; 
use App\User;


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

    protected $redirectTo = '/admin/listpost';

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /*
        Standar login laravel
    */
    public function login(Request $request) // overwrite function login.
    {
        $input = $request->all();
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'email';
        
        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password'])))
        {
            $user = Auth::user();
            if(!is_null($user->is_admin)){
                switch ($user->is_admin) {
                    case '1':
                        return redirect()->route('backend.dashboard')->with(['messenge'=>'Wellcome Admin']);
                        break;
                    
                    default:
                        echo "Bạn là thành viên mới sinh nek";
                        //return redirect()->route('home');
                        break;
                }
            }else{
                return redirect()->route('home')->with(['messenge'=>'Wellcome Member']);
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }       
    }
     

    /*
        for social login
    */
    public function redirect_social($driver){
        return Socialite::driver($driver)->redirect();
    }
    public function callback_social($driver){ 
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }       
        $existingUser = User::where('email', $user->getEmail())->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser                    = new User;
            $newUser->provider_name     = 'google';
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->avatar            = $user->getAvatar();
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect()->route('member')->with(['messenge'=>'Wellcome Member']);
    }

}
