<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


    public function update(Request $request)
    {
        $values = $request->only(['name', 'email']);
        $rules = [
            'name' => 'required|max:255|unique:users,name,' . $request->user()->id,
            'email' => 'required|email|max:255|unique:users,email,' . $request->user()->id,
        ];
        if($request->password) {
            $rules['password'] = 'string|confirmed|min:8';
            $values['password'] =  Hash::make($request->password);
        }
        $request->validate($rules);
        $request->user()->update($values);
        
        return back()->with('status', __('You have been successfully updated.'));
    }

    public function destroy(Request $request)
    {
        $request->user()->delete();
        return response()->json();
    }
}
