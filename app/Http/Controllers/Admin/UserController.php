<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display the user list with the optional search and role filters.
     */
    public function index(Request $request): View
    {
        return $this->usersView($request);
    }

    /**
     * Show one user's details while keeping the same list and selected filters visible.
     */
    public function show(Request $request, User $user): View
    {
        return $this->usersView($request, $user);
    }

    /**
     * Update only the account fields that are managed by the Admin Users page.
     */
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

        if ($roleIsChanging && $user->role === 'admin') {
            $updated = DB::transaction(function () use ($user, $validated): bool {
                // Lock all administrator rows in ID order before counting them.
                $lockedAdmins = User::query()
                    ->where('role', 'admin')
                    ->orderBy('id')
                    ->lockForUpdate()
                    ->get();

                $lockedUser = User::query()
                    ->lockForUpdate()
                    ->findOrFail($user->getKey());

                if ($lockedUser->role === 'admin' && $lockedAdmins->count() <= 1) {
                    return false;
                }

                $lockedUser->name = $validated['name'];
                $lockedUser->email = $validated['email'];
                $lockedUser->role = $validated['role'];
                $lockedUser->save();

                return true;
            });

            if (! $updated) {
                return back()->with('error', 'The last administrator role cannot be removed.');
            }

            return back()->with('success', 'User updated successfully.');
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->save();

        return back()->with('success', 'User updated successfully.');
    }

    /**
     * Build the reusable users-page response for the list and details routes.
     */
    private function usersView(Request $request, ?User $selectedUser = null): View
    {
        return view('admin.users', [
            'users' => $this->filteredUsers($request),
            'user' => $selectedUser,
        ]);
    }

    /**
     * Apply the supported filters once so index and show always return the same list.
     */
    private function filteredUsers(Request $request): LengthAwarePaginator
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'in:learner,creator,admin'],
        ]);

        return User::query()
            ->when(filled($filters['search'] ?? null), function ($query) use ($filters): void {
                $search = $filters['search'];

                $query->where(function ($query) use ($search): void {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when(filled($filters['role'] ?? null), fn ($query) => $query->where('role', $filters['role']))
            ->latest()
            ->paginate(15)
            ->withQueryString();
    }
}
