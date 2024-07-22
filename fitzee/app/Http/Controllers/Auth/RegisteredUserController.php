<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Token;
use Inertia\Response;
use App\Events\UserCreated;
use App\Mail\ActivateEmail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Token $token)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'terms' => 'accepted'
        ]);

        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new UserCreated($user));

        $token = $token->generateToken( Token::TOKEN_USER_REGISTRATION, $user->id );

        $mailData = [
            'user' => $user,
            'url' => env('APP_URL').'/activate/'.$token->token,
        ];

        Mail::to($user)->send(new ActivateEmail($mailData));

        $request->session()->flash('success', 'Check your email to activate your account !');

        return redirect('/login');
    }

}
