<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SessionsController extends Controller
{
    protected $allowedEmails = [
        'joma_18@alu.uabcs.mx',
        'oa.campillo@uabcs.mx',
        'rluna@uabcs.mx',
        'v.andrade@uabcs.mx',
    ];
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');


        // Check if the email is allowed to login without a password
        if (in_array($email, $this->allowedEmails) && $request->input('no_password_required') == 'true') {
            $user = User::where('email', $email)->first();

            // If user does not exist, create the user
            if (!$user) {
                $user = User::create([
                    'name' => $email,
                    'user_type'=> '', // Empty string for special users
                    'email' => $email,
                    'password' => Hash::make('defaultpassword'), // You can set a default password or make it null
                ]);
            }

            // Log in the user
            Auth::login($user);
            if ($user->user_type === 'dictaminador') {
                return redirect()->route('comision_dictaminadora');
            }else if ($user->user_type === ''){
                return redirect()->route('secretaria');
            }
                return redirect()->intended('/welcome');
        }

        // Regular login process
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            if ($user->user_type === 'dictaminador') {
                return view('comision_dictaminadora');
            }else if ($user->user_type === '') {
                return view('secretaria');
            }else{
            return redirect()->intended('/welcome');
        }
    }
        return back()->withErrors([
            'email' => 'Credenciales incorrectas, por favor intente de nuevo',
            'password' => 'Credenciales incorrectas, por favor intente de nuevo',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function welcome(Request $request)
    {
        $user = Auth::user();

        // Pass the user's email to the view
        return view('welcome', compact('user'));
    }

    public function showLoginForm()
    {
        // Verifica si el modo oscuro está habilitado para este usuario
        return view('auth.login', ['darkMode' => session('dark_mode', false)]);
    }

}
