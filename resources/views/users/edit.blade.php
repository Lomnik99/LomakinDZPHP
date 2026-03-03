@extends('layouts.main')

@section('title', 'Редактирование пользователя')

@section('content')

    <div class="container mx-auto px-4 py-8 max-w-3xl">

        <!-- Заголовок -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                Редактирование пользователя
            </h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                Измените данные пользователя {{ $user->name }}
            </p>
        </div>

        <!-- Карточка с формой -->
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700">

            <div class="p-6 lg:p-8">

                <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Основные поля -->
                    <div class="grid grid-cols-1 gap-6">

                        <!-- Аватар -->
                        <div class="mt-6">
                            <x-input-label for="avatar" :value="__('Аватар')" />

                            <div class="mt-2 flex items-center gap-6">
                                <!-- Текущий аватар -->
                                <div class="shrink-0">
                                    <img
                                        src="{{ $user->avatar_url }}"
                                        alt="{{ $user->name }}"
                                        class="h-20 w-20 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700"
                                    >
                                </div>


                                <div class="flex-1">
                                    <x-text-input
                                        id="avatar"
                                        name="avatar"
                                        type="file"
                                        accept="image/*"
                                        class="mt-1 block w-full"
                                    />
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        JPG, PNG, max 2MB
                                    </p>
                                    <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <!-- Имя -->
                        <div>
                            <x-input-label for="name" :value="__('Имя')" />
                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('name', $user->name)"
                                required
                                autofocus
                                autocomplete="name"
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input
                                id="email"
                                name="email"
                                type="email"
                                class="mt-1 block w-full"
                                :value="old('email', $user->email)"
                                required
                                autocomplete="username"
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Пароль (опционально) -->
                        <div>
                            <x-input-label for="password" :value="__('Новый пароль (оставьте пустым, если не меняете)')" />
                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-full"
                                autocomplete="new-password"
                            />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Подтверждение пароля -->
                        <div>
                            <x-input-label for="password_confirmation" :value="__('Подтвердите пароль')" />
                            <x-text-input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="mt-1 block w-full"
                                autocomplete="new-password"
                            />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                    </div>

                    <!-- Кнопки -->
                    <div class="mt-8 flex items-center justify-end gap-4">

                        <a href="{{ route('users.index') }}"
                           class="px-5 py-2.5 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600
                                  text-gray-800 dark:text-gray-200 font-medium rounded-lg transition">
                            Отмена
                        </a>

                        <button type="submit"
                                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700
                                       text-white font-medium rounded-lg shadow-md transition-all duration-200
                                       focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Сохранить изменения
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

@endsection
