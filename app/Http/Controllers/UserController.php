<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Models\User;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->all();
        return view('users.index', compact('users'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->create($request->validated());
        return redirect()->route('users.index')->with('success', 'Пользователь создан');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->userRepository->update($user, $request->validated());
        return redirect()->route('users.index')->with('success', 'Пользователь обновлён');
    }

    public function destroy(User $user)
    {
        $this->userRepository->delete($user);
        return redirect()->route('users.index')->with('success', 'Пользователь удалён');
    }
}
