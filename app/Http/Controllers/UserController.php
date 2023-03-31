<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\ResetPasswordRequest;
use App\Http\Requests\User\ForgotPasswordRequest;

class UserController extends Controller
{
    public function registration()
    {
        return view('Auth.register');
    }

    public function login()
    {
        return view('Auth.login');
    }

    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        auth()->login($user, $request->remember);

        return redirect()->route('main');
    }

    public function logUser(LoginRequest $request)
    {
        $validated = $request->validated();
        
        if(auth()->attempt($validated, $request->remember)){
            $request->session()->regenerate();

            return redirect()->route('main');
        }

        return back()->withErrors(['email' => 'Неверно введенные данные!'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('main');
    }

    public function showForgetPassword()
    {
        return view('Auth.forgot-password');
    }

    public function submitForgetPassword(ForgotPasswordRequest $request)
    {
        $email = $request->validated();
        $token = Str::random(8);
        DB::table('password_reset')->insert([
            'email' => $email['email'],
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);
        
        
        Mail::to($email['email'])->queue(new ForgotPasswordMail($token));

        return redirect()->route('user.showResetPassword')->with('message', 'Мы отправили пароль на вашу почту!');

    }

    public function showResetPassword()
    {
        return view('Auth.reset-password');
    }

    public function submitResetPassword(ResetPasswordRequest $request)
    {
        $validated = $request->validated();

        $newPassword = DB::table('password_reset')->where('token', $validated['password'])->value('token');
        if (! $newPassword){
            return back()->with('message', 'Неверно введенный пароль!');
        }

       DB::transaction(function() use ($validated, $newPassword){

        User::where('email', $validated['email'])->update([
            'password' => Hash::make($newPassword),
        ]);

        DB::table('password_reset')->where('token', $validated['password'])->delete();

       }); 
        

        return redirect()->route('user.login')->with('message', 'Ваш пароль успешно изменен!');
    }
}
