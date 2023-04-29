<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\ForgotPasswordRequest;
use App\Service\User\SubmitPasswordService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function registration(): View
    {
        return view('Auth.register');
    }

    public function login(): View
    {
        return view('Auth.login');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        auth()->login($user, $request->remember);

        return redirect()->route('main');
    }

    public function logUser(LoginRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        if(auth()->attempt($validated, $request->remember)){
            $request->session()->regenerate();

            return redirect()->route('main');
        }

        return back()->withErrors(['email' => 'Неверно введенные данные!'])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('main');
    }

    public function showForgetPassword(): View
    {
        return view('Auth.forgot-password');
    }

    public function submitForgetPassword(ForgotPasswordRequest $request, SubmitPasswordService $submitPasswordService): RedirectResponse
    {
        $email = $request->validated();

        $submitPasswordService->storeForgetPassword($email);

        return redirect()->route('user.showResetPassword')->with('message', 'Мы отправили пароль на вашу почту!');

    }

    public function showResetPassword(): View
    {
        return view('Auth.reset-password');
    }

    public function submitResetPassword(ResetPasswordRequest $request, SubmitPasswordService $submitPasswordService): RedirectResponse
    {
        $validated = $request->validated();

        $submitPasswordService->storeResetPassword($validated);

        return redirect()->route('user.login')->with('message', 'Ваш пароль успешно изменен!');
    }
}
