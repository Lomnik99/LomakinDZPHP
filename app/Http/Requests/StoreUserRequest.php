<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно.',
            'name.max' => 'Имя не может быть длиннее 255 символов.',

            'email.required' => 'Email обязателен.',
            'email.email' => 'Введите корректный адрес электронной почты.',
            'email.max' => 'Email не может быть длиннее 255 символов.',
            'email.unique' => 'Этот email уже зарегистрирован.',

            'password.required' => 'Пароль обязателен.',
            'password.min' => 'Пароль должен содержать минимум 6 символов.',
            'password.confirmed' => 'Пароли не совпадают.',

        ];
    }
}
