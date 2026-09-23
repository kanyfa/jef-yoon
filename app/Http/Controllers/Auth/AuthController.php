<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'L\'adresse e-mail est requise.',
            'email.email' => 'L\'adresse e-mail n\'est pas valide.',
            'password.required' => 'Le mot de passe est requis.',
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Ces identifiants ne correspondent à aucun compte.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route(
            Auth::user()->isCompany() ? 'company.dashboard' : 'candidate.dashboard'
        ));
    }

    public function showRegister(Request $request)
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $role = $request->input('role', 'candidate');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', Rule::in(['candidate', 'company'])],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Le nom est requis.',
            'email.required' => "L'adresse e-mail est requise.",
            'email.email' => 'L\'adresse e-mail n\'est pas valide.',
            'email.unique' => 'Cet e-mail est déjà utilisé.',
            'password.required' => 'Le mot de passe est requis.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => Hash::make($data['password']),
        ]);

        if ($user->isCompany()) {
            Company::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'location' => $data['location'] ?? null,
            ]);
        }

        Auth::login($user);

        return redirect()->route($user->isCompany() ? 'company.dashboard' : 'candidate.profile');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
