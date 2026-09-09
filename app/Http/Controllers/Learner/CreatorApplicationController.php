<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreatorApplicationController extends Controller
{
    public function show()
    {
        /** @var User $user */
        $user = Auth::user();

        $application = $user->creatorApplications()
            ->latest()
            ->first();

        return view('learner.creator-application', compact('application'));
    }

    public function store()
    {
        /** @var User $user */
        $user = Auth::user();

        $existingApplication = $user->creatorApplications()
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($existingApplication) {
            return back()->with(
                'error',
                'لديك طلب قائم بالفعل.'
            );
        }

        $user->creatorApplications()->create([
            'status' => 'pending',
        ]);

        return back()->with(
            'success',
            'تم إرسال طلبك بنجاح وسيتم مراجعته من قبل الإدارة.'
        );
    }
}
