<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $request->validate(['status' => ['nullable', 'in:pending,resolved']]);

        $reports = Report::with(['user', 'reportable'])
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->input('status')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.reports', compact('reports'));
    }

    public function show(Report $report)
    {
        return view('admin.reports', [
            'reports' => Report::with(['user', 'reportable'])->latest()->paginate(15),
            'report' => $report->load(['user', 'reportable']),
        ]);
    }

    public function resolve(Report $report)
    {
        if ($report->status !== 'pending') {
            return back()->with('error', 'Only pending reports can be resolved.');
        }

        $report->status = 'resolved';
        $report->save();

        return back()->with('success', 'Report resolved successfully.');
    }
}
