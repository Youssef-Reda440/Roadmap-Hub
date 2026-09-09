<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Roadmap;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $enrollments = $user->roadmapEnrollments()
            ->with([
                'roadmap.category',
                'roadmap.creator',
            ])
            ->latest('enrolled_at')
            ->get();

        return view('learner.my-learning', compact('enrollments'));
    }

    public function show(Roadmap $roadmap)
    {
        /** @var User $user */
        $user = Auth::user();

        $enrollment = $user->roadmapEnrollments()
            ->where('roadmap_id', $roadmap->id)
            ->first();

        abort_if($enrollment === null, 403);

        $roadmap->load([
            'category',
            'creator',
            'resources',
            'reviews.user',
        ]);

        return view('learner.learning-roadmap', compact(
            'roadmap',
            'enrollment'
        ));
    }

    public function enroll(Roadmap $roadmap)
    {
        /** @var User $user */
        $user = Auth::user();

        abort_if($roadmap->status !== 'published', 404);

        $alreadyEnrolled = $user->roadmapEnrollments()
            ->where('roadmap_id', $roadmap->id)
            ->exists();

        if ($alreadyEnrolled) {
            return redirect()
                ->route('learner.learning.show', $roadmap)
                ->with('info', 'أنت مسجل بالفعل في هذا المسار.');
        }

        $user->roadmapEnrollments()->create([
            'roadmap_id' => $roadmap->id,
            'enrolled_at' => now(),
        ]);

        return redirect()
            ->route('learner.learning.show', $roadmap)
            ->with('success', 'تم التسجيل في المسار بنجاح.');
    }
}
