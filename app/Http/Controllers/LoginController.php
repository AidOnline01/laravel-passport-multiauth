<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PassportTenant;
use App\Models\PassportLandlord;
use Hash;
use App;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Passport;

class LoginController extends Controller
{
    public function login(Request $request) {
        $request->validate([
            'type' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = null;
        if($request->type === 'landlord') $user = PassportLandlord::where('email', $request->email)->first();
        if($request->type === 'tenant') $user = PassportTenant::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect']
            ]);
        }

        return $user->createToken($request->type)->accessToken;
    }
}
