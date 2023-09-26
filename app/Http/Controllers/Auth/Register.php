<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Register extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed'],
        ],
            [
                'name.required' => 'وارد کردن فیلد نام و نام خانوادگی الزامی است!',
                'email.required' => 'وارد کردن فیلد ایمیل الزامی است!',
                'password.required' => 'وارد کردن فیلد رمز عبور الزامی است!',
                'email.unique' => 'این ایمیل قبلا در سیستم ثبت شده است!',
                'email.email' => 'لطفا ایمیل خود را صحیح وارد کنید!',
                'password,confirmed' => 'لطفا فیلد تکرار رمز عبور را صحیح وارد کنید!'
            ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => UserRoleEnum::SIMPLE_USER,
        ]);

        Auth::loginUsingId($user->id);

        return redirect(route('event.create'));
    }
}
