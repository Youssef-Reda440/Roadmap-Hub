<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        /** @var User $user */
        $user = Auth::user();

        $stats = [
            'enrollments' => $user->roadmapEnrollments()->count(),
            'saved' => $user->savedRoadmaps()->count(),
            'reviews' => $user->reviews()->count(),
        ];

        return view('learner.profile', compact(
            'user',
            'stats'
        ));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'تم تحديث بيانات الحساب بنجاح.');
    }
}
