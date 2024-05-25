<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function request(Request $request, Token $token)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
        ]);

        $type = Token::TOKEN_RESET_PASSWORD;
        $user = User::where('email', $request->input('email'))->first();

        if(!$user)
            return redirect()->back()->withErrors(['email' => 'This account does not exist.']);

        $checkToken = Token::where(['user_id' => $user->id, 'type' => $type])->withTrashed()->latest()->first();

        if(isset($checkToken) && date($checkToken->deleted_at) > now())
            return redirect()->back()->withErrors(['email' => 'An existing token has not yet expired.']);

        $token = $token->generateToken($type, $user->id);

        $mailData = [
            'user' => $user,
            'url' => env('APP_URL').'/reset-password/'.$token->token,
        ];

        Mail::to($user)->send(new ResetPasswordEmail($mailData));

        return Inertia::render('Auth/ForgotPassword')->with('success', 'Check your email to reset your password !');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $type = Token::TOKEN_RESET_PASSWORD;

        $token = Token::where(['token' => $request->input('token'), 'type' => $type])->withTrashed()->latest()->first();

        if(!$token)
            return redirect()->back()->withErrors(['password' => 'This token does not exist.']);

        $user = User::where(['id' => $token->user_id])->first();

        if(date($token->deleted_at) < now())
            return redirect()->back()->withErrors(['password' => 'This token has expired.']);

        $token->delete();

        $user->password = Hash::make($request->password);
        $user->save();

        $request->session()->flash('success', 'Password successfully changed, you can now login!');

        return redirect('/login');
    }
}
