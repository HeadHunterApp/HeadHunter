<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Allaskereso;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'nev' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:40', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nev' => $request->nev,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'jogosultsag' => 'álláskereső',
        ]);

        event(new Registered($user));

        Auth::login($user);

        $allaskereso = Allaskereso::create([
            'user_id' => $user->user_id,
            'nem' => $request->nem,
            'szul_ido' => $request->szul_ido,
            'cim' => $request->cim
        ]);
        $allaskereso->save();

        return response()->noContent();
    }
}
