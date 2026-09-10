<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreatorApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreatorApplicationController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['status' => ['nullable', 'in:pending,approved,rejected']]);

        $applications = CreatorApplication::with('user')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->input('status')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.creator-applications', compact('applications'));
    }

    public function show(CreatorApplication $application)
    {
        return view('admin.creator-applications', [
            'applications' => CreatorApplication::with('user')->latest()->paginate(15),
            'application' => $application->load('user'),
        ]);
    }

    public function approve(CreatorApplication $application)
    {
        $approvalResult = DB::transaction(function () use ($application): string {
            $lockedApplication = CreatorApplication::query()
                ->lockForUpdate()
                ->find($application->getKey());

            if (! $lockedApplication) {
                return 'missing';
            }

            if ($lockedApplication->status !== 'pending') {
                return 'not_pending';
            }

            $lockedUser = User::query()
                ->lockForUpdate()
                ->find($lockedApplication->user_id);

            if (! $lockedUser) {
                return 'missing_user';
            }

            if ($lockedUser->role !== 'learner') {
                return 'ineligible_role';
            }

            $lockedApplication->status = 'approved';
            $lockedApplication->save();

            $lockedUser->role = 'creator';
            $lockedUser->save();

            return 'approved';
        });

        if ($approvalResult === 'not_pending') {
            return back()->with('error', 'Only pending applications can be approved.');
        }

        if ($approvalResult === 'ineligible_role') {
            return back()->with('error', 'Only learner accounts can be approved as creators.');
        }

        if ($approvalResult !== 'approved') {
            return back()->with('error', 'Creator application or applicant is no longer available.');
        }

        return back()->with('success', 'Creator application approved successfully.');
    }

    public function reject(CreatorApplication $application)
    {
        $rejected = DB::transaction(function () use ($application): bool {
            $lockedApplication = CreatorApplication::query()
                ->lockForUpdate()
                ->find($application->getKey());

            if (! $lockedApplication || $lockedApplication->status !== 'pending') {
                return false;
            }

            $lockedApplication->status = 'rejected';
            $lockedApplication->save();

            return true;
        });

        if (! $rejected) {
            return back()->with('error', 'Only pending applications can be rejected.');
        }

        return back()->with('success', 'Creator application rejected successfully.');
    }
}
