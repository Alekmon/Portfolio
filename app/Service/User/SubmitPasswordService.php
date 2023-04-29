<?php

namespace App\Service\User;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\ForgotPasswordMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class SubmitPasswordService
{
    public function storeForgetPassword($email): void
    {
        
        $token = Str::random(8);
        DB::table('password_reset')->insert([
            'email' => $email['email'],
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $this->sendMail($email, $token);
    }

    public function sendMail($email, $token): Mail
    {
        return Mail::to($email['email'])->queue(new ForgotPasswordMail($token));
    }

    public function storeResetPassword($validated): RedirectResponse
    {
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
    }

}