<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'in:learner,creator,admin'],
        ]);

        $users = User::query()
            ->when($request->filled('search'), function ($query) use ($request): void {
                $search = $request->input('search');
                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('role'), fn ($query) => $query->where('role', $request->input('role')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.users', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users', [
            'users' => User::latest()->paginate(15),
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'role' => ['required', 'in:learner,creator,admin'],
        ]);

        $roleIsChanging = $user->role !== $validated['role'];

        if ($roleIsChanging && $user->is($request->user())) {
            return back()->with('error', 'You cannot change your own administrator role.');
        }

        if ($roleIsChanging && $user->role === 'admin' && User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'The last administrator role cannot be removed.');
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->save();

        return back()->with('success', 'User updated successfully.');
    }
}
