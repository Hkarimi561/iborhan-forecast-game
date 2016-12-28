<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Laravel\Socialite\Facades\Socialite;
use Auth;


class AuthController extends Controller
{
    //	oAuth

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $redirectTo = '/user';
    protected $guard = 'web';

    public function __construct()
    {
        $this->redirectPath = route('home');
//            return view('login');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        //notice we are not doing any validation, you should do it
        $user = Socialite::driver($provider)->user();
//            dd($user);
        $url = parse_url($user->avatar);
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
            $ipAddress = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));
        }
        if ($user['gender'] == 'male') {
            $user['gender'] = '1';
        } else {
            $user['gender'] = '0';
        }
        $url = $url['scheme'] . '://' . $url['host'] . '' . $url['path'];

        // stroing data to our use table and logging them in
        $data = [
            'display_name' => $user->getName(),
            'email' => $user->getEmail(),
            'avatar' => $url,
//                    'ip' => $ipAddress,
            'gender' => $user['gender'],
        ];

        auth()->login(User::firstOrCreate($data));

        //after login redirecting to home page
        return redirect($this->redirectPath());
    }

    public function get_login()
    {
        if (auth('admin')->check()) {
            return redirect('/admin/login');
        } else {
            return view('login');
        }
    }

    public function logout()
    {
        if (auth()->check()) {
            auth()->logout();
            return redirect()->route('home');
        } else {
            return redirect()->back();
        }
    }
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    //    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    //
    //    /**
    //     * Create a new authentication controller instance.
    //     *
    //     * @return void
    //     */
    //    public function __construct()
    //    {
    //        $this->middleware('guest', ['except' => 'getLogout']);
    //    }
    //
    //    /**
    //     * Get a validator for an incoming registration request.
    //     *
    //     * @param  array  $data
    //     * @return \Illuminate\Contracts\Validation\Validator
    //     */
    //    protected function validator(array $data)
    //    {
    //        return Validator::make($data, [
    //            'name' => 'required|max:255',
    //            'email' => 'required|email|max:255|unique:users',
    //            'password' => 'required|confirmed|min:6',
    //        ]);
    //    }
    //


    public function get_register()
    {
        if (auth()->check()) {
            return redirect('/');
        } else {
            return view('signup');
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(Request $request)
    {
        $data = $request->toArray();
//		        dd($data->toArray());
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
