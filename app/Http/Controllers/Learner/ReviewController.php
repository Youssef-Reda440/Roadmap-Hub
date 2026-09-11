<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Roadmap;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Roadmap $roadmap)
    {
        /** @var User $user */
        $user = Auth::user();

        abort_if($roadmap->status !== 'published', 404);

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $alreadyReviewed = $user->reviews()
            ->where('roadmap_id', $roadmap->id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->with(
                'error',
                'لقد قمت بتقييم هذا المسار بالفعل.'
            );
        }

        $review = new Review([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        $review->user()->associate($user);
        $review->roadmap()->associate($roadmap);
        $review->save();

        return back()->with(
            'success',
            'تم إضافة تقييمك بنجاح.'
        );
    }

    public function update(Request $request, Review $review)
    {
        /** @var User $user */
        $user = Auth::user();

        abort_unless($review->user_id === $user->id, 403);

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['required', 'string', 'max:1000'],
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with(
            'success',
            'تم تحديث تقييمك بنجاح.'
        );
    }

    public function destroy(Review $review)
    {
        /** @var User $user */
        $user = Auth::user();

        abort_unless($review->user_id === $user->id, 404);

        $review->delete();

        return back()->with(
            'success',
            'تم حذف تقييمك بنجاح.'
        );
    }
}
