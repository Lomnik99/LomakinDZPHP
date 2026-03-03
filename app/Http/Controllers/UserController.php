<?php

namespace App\Http\Controllers;

use App\Filters\UserFilters;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function Laravel\Prompts\select;

class UserController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserFilters    $userFilters
    )
    {
    }

    public function index(Request $request): View
    {
        $users = User::query();

        return view('users.index', [
            'users' => $this->userFilters
                ->apply($request, $users)
                ->paginate(10)
                ->withQueryString(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->userRepository->create($request->validated());
        return redirect()->route('users.index')->with('success', 'Пользователь создан');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($request, $user);

        return redirect()->route('users.index')->with('success', 'Пользователь обновлён');
    }

    public function destroy(User $user)
    {
        $this->userRepository->delete($user);
        return redirect()->route('users.index')->with('success', 'Пользователь удалён');
    }
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user,
        ]);
    }
    public function create()
    {
        return view('users.create');
    }
    public function edit(user $user )
    {
        return view('users.edit', compact('user'));
    }
}
