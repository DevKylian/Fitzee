<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Token;

class ActivateController extends Controller
{
    public function activate($token)
    {
        $token = Token::where('token', $token)->withTrashed()->latest()->first();

        if(!$token)
            return redirect()->back()->with(['info' => 'This token does not exist.']);

        $user = User::where('id', $token->user_id)->first();

        if($user->status != User::STATUS_NOT_VERIFIED)
            return redirect()->back()->with(['info' => 'Account already activated.']);

        if(date($token->deleted_at) < now())
            return redirect()->back()->with(['info' => 'This token has expired.']);

        $user->status = User::STATUS_VERIFIED;
        $user->save();

        $token->delete();

        return redirect()->back()->with(['success' => 'Account activated successfully.']);
    }
}
