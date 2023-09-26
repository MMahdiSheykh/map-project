<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Register extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
           'name' => ['required'],
            'email' => ['required','email', Rule::unique('users')],
            'password' => ['required','confirmed'],
        ],
        [
            'name.required' => 'وارد کردن فیلد نام و نام خانوادگی الزامی است!',
            'email.required' => 'وارد کردن فیلد ایمیل الزامی است!',
            'password.required' => 'وارد کردن فیلد رمز عبور الزامی است!',
            'email.unique' => 'این ایمیل قبلا در سیستم ثبت شده است!',
            'email.email' => 'لطفا ایمیل خود را صحیح وارد کنید!',
            'password,confirmed' => 'لطفا فیلد تکرار رمز عبور را صحیح وارد کنید!'
        ]);

        User::create([
           'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => UserRoleEnum::SIMPLE_USER,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
