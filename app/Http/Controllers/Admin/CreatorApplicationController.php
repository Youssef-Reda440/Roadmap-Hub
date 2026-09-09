<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CreatorApplication;
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
        if ($application->status !== 'pending') {
            return back()->with('error', 'Only pending applications can be approved.');
        }

        DB::transaction(function () use ($application): void {
            $application->status = 'approved';
            $application->save();

            $application->user->role = 'creator';
            $application->user->save();
        });

        return back()->with('success', 'Creator application approved successfully.');
    }

    public function reject(CreatorApplication $application)
    {
        if ($application->status !== 'pending') {
            return back()->with('error', 'Only pending applications can be rejected.');
        }

        $application->status = 'rejected';
        $application->save();

        return back()->with('success', 'Creator application rejected successfully.');
    }
}
