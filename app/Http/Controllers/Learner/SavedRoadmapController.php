<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Roadmap;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SavedRoadmapController extends Controller
{
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $savedRoadmaps = $user->savedRoadmaps()
            ->with([
                'roadmap.category',
                'roadmap.creator',
            ])
            ->latest('saved_at')
            ->get();

        return view('learner.saved-roadmaps', compact('savedRoadmaps'));
    }

    public function store(Roadmap $roadmap)
    {
        /** @var User $user */
        $user = Auth::user();

        abort_if($roadmap->status !== 'published', 404);

        $alreadySaved = $user->savedRoadmaps()
            ->where('roadmap_id', $roadmap->id)
            ->exists();

        if ($alreadySaved) {
            return back()->with('info', 'المسار محفوظ بالفعل.');
        }

        $user->savedRoadmaps()->create([
            'roadmap_id' => $roadmap->id,
            'saved_at' => now(),
        ]);

        return back()->with('success', 'تم حفظ المسار بنجاح.');
    }

    public function destroy(Roadmap $roadmap)
    {
        /** @var User $user */
        $user = Auth::user();

        $deleted = $user->savedRoadmaps()
            ->where('roadmap_id', $roadmap->id)
            ->delete();

        if (!$deleted) {
            return back()->with('info', 'المسار غير موجود في المحفوظات.');
        }

        return back()->with('success', 'تم إزالة المسار من المحفوظات.');
    }
}