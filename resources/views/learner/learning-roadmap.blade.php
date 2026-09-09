@extends('layouts.app')

@section('lang', 'ar')
@section('dir', 'rtl')

{{-- @var Roadmap $roadmap --}}
@section('title', $roadmap->title)

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700&family=Rubik:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/learner/learning-roadmap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/learner/learner-navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endsection

@section('navigation')
    @include('components.navbars.learner-navbar')
@endsection

@section('content')
    <main class="roadmap-page">

        {{-- Breadcrumb --}}
        <div class="breadcrumb">

            <a href="{{ route('learner.learning.index') }}">
                تعلّمي
            </a>

            <span>›</span>

            <span>
                {{ $roadmap->title }}
            </span>

        </div>


        {{-- Roadmap Header --}}
        <section class="roadmap-header">

            <div class="header-content">

                <div class="category">
                    {{ $roadmap->category->name }}
                </div>

                <h1>
                    {{ $roadmap->title }}
                </h1>

                <p>
                    {{ $roadmap->description }}
                </p>

                <div class="roadmap-meta">

                    <span>
                        {{ $roadmap->resources->count() }} موارد تعليمية
                    </span>

                    <span>•</span>

                    <span>
                        @switch($roadmap->level)
                            @case('beginner')
                                مبتدئ
                            @break

                            @case('intermediate')
                                متوسط
                            @break

                            @case('advanced')
                                متقدم
                            @break

                            @default
                                {{ $roadmap->level }}
                        @endswitch
                    </span>

                    <span>•</span>

                    <span>
                        المدرب: {{ $roadmap->creator->name }}
                    </span>

                </div>

            </div>

        </section>


        {{-- Roadmap Content --}}
        <section class="roadmap-content">

            {{-- Resources --}}
            <div class="resources-section">

                <div class="resources-header">

                    <div>

                        <span class="section-label">
                            محتوى المسار
                        </span>

                        <h2>
                            الموارد التعليمية
                        </h2>

                        <p>
                            ابدأ بالتعلّم من الموارد التالية بالترتيب.
                        </p>

                    </div>

                    <span class="resources-count">
                        {{ $roadmap->resources->count() }}
                        موارد
                    </span>

                </div>


                <div class="topics">

                    @forelse ($roadmap->resources as $index => $resource)
                        <div class="topic">

                            {{-- Resource Number --}}
                            <div class="topic-check resource-number">
                                {{ $index + 1 }}
                            </div>


                            {{-- Resource Info --}}
                            <div class="topic-info">

                                <h3>
                                    {{ $resource->title }}
                                </h3>

                                <p>
                                    {{ $resource->description }}
                                </p>

                                <span class="resource-type">

                                    @switch($resource->type)
                                        @case('video')
                                            فيديو
                                        @break

                                        @case('documentation')
                                            توثيق
                                        @break

                                        @case('article')
                                            مقال
                                        @break

                                        @case('link')
                                            رابط
                                        @break

                                        @case('other')
                                            مورد
                                        @break

                                        @default
                                            {{ $resource->type }}
                                    @endswitch

                                </span>

                            </div>


                            {{-- Open Resource --}}
                            <a href="{{ $resource->url }}" target="_blank" rel="noopener noreferrer" class="start-btn">
                                ابدأ
                            </a>

                        </div>

                        @empty

                            <div class="empty-state">

                                <h3>
                                    لا توجد موارد تعليمية بعد
                                </h3>

                                <p>
                                    لم تتم إضافة موارد لهذا المسار حتى الآن.
                                </p>

                            </div>
                        @endforelse

                    </div>

                </div>


                {{-- Reviews --}}
                @php
                    $userReview = $roadmap->reviews->firstWhere('user_id', auth()->id());
                @endphp


                {{-- Add / Edit Review --}}
                <section class="review-section">

                    <div class="review-section-header">

                        <div>

                            <span class="section-label">
                                تقييمك
                            </span>

                            <h2>
                                قيّم هذا المسار
                            </h2>

                            <p>
                                شارك تجربتك وساعد المتعلمين الآخرين على اختيار المسار المناسب.
                            </p>

                        </div>

                    </div>


                    @if ($userReview)

                        {{-- Existing User Review --}}
                        <div class="user-review-card">

                            <div class="user-review-header">

                                <div>

                                    <span class="review-label">
                                        تقييمك الحالي
                                    </span>

                                    <div class="review-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $userReview->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </div>

                                </div>

                                <span class="review-date">
                                    {{ $userReview->created_at?->format('Y/m/d') }}
                                </span>

                            </div>


                            <p class="user-review-comment">
                                {{ $userReview->comment }}
                            </p>


                            <div class="user-review-actions">

                                {{-- Update Review --}}
                                <form action="{{ route('learner.reviews.update', $userReview) }}" method="POST"
                                    class="edit-review-form">
                                    @csrf
                                    @method('PATCH')

                                    <div class="review-edit-fields">

                                        <div class="rating-field">

                                            <label for="rating">
                                                التقييم
                                            </label>

                                            <select name="rating" id="rating" required>
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $userReview->rating == $i ? 'selected' : '' }}>
                                                        {{ $i }} / 5
                                                    </option>
                                                @endfor
                                            </select>

                                        </div>


                                        <div class="comment-field">

                                            <label for="comment">
                                                التعليق
                                            </label>

                                            <textarea name="comment" id="comment" rows="3" maxlength="1000" required>{{ old('comment', $userReview->comment) }}</textarea>

                                        </div>

                                    </div>

                                    <button type="submit" class="update-review-btn">
                                        حفظ التعديل
                                    </button>

                                </form>


                                {{-- Delete Review --}}
                                <form action="{{ route('learner.reviews.destroy', $userReview) }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete-review-btn">
                                        حذف التقييم
                                    </button>

                                </form>

                            </div>

                        </div>
                    @else
                        {{-- New Review --}}
                        <div class="review-form-card">

                            <form action="{{ route('learner.reviews.store', $roadmap) }}" method="POST">

                                @csrf


                                <div class="rating-field">

                                    <label>
                                        تقييمك للمسار
                                    </label>

                                    <div class="rating-options">

                                        @for ($i = 5; $i >= 1; $i--)
                                            <label class="rating-option">

                                                <input type="radio" name="rating" value="{{ $i }}"
                                                    {{ old('rating') == $i ? 'checked' : '' }} required>

                                                <span>
                                                    {{ $i }}
                                                </span>

                                                <i class="bi bi-star-fill"></i>

                                            </label>
                                        @endfor

                                    </div>

                                    @error('rating')
                                        <span class="form-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="comment-field">

                                    <label for="comment">
                                        اكتب رأيك
                                    </label>

                                    <textarea name="comment" id="comment" rows="5" maxlength="1000" placeholder="شاركنا تجربتك مع هذا المسار..."
                                        required>{{ old('comment') }}</textarea>

                                    @error('comment')
                                        <span class="form-error">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>


                                <div class="review-form-footer">

                                    <span>
                                        تقييمك يساعد المتعلمين الآخرين.
                                    </span>

                                    <button type="submit" class="submit-review-btn">
                                        إرسال التقييم
                                        <i class="bi bi-arrow-left"></i>
                                    </button>

                                </div>

                            </form>

                        </div>

                    @endif

                </section>


                {{-- Other Learners Reviews --}}
                <section class="reviews-list-section">

                    <div class="reviews-section-header">

                        <div>

                            <span class="section-label">
                                آراء المتعلمين
                            </span>

                            <h2>
                                تقييمات هذا المسار
                            </h2>

                        </div>

                        <span class="reviews-count">
                            {{ $roadmap->reviews->count() }}
                            تقييم
                        </span>

                    </div>


                    @if ($roadmap->reviews->isEmpty())

                        <div class="empty-reviews">

                            <div class="empty-reviews-icon">
                                <i class="bi bi-chat-square-text"></i>
                            </div>

                            <h3>
                                لا توجد تقييمات بعد
                            </h3>

                            <p>
                                كن أول من يشارك تجربته مع هذا المسار.
                            </p>

                        </div>
                    @else
                        <div class="reviews-list">

                            @foreach ($roadmap->reviews as $review)
                                <article class="review-card">

                                    <div class="review-card-header">

                                        <div class="review-user">

                                            <div class="review-avatar">
                                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                                            </div>

                                            <div>

                                                <h3>
                                                    {{ $review->user->name }}
                                                </h3>

                                                <span>
                                                    {{ $review->created_at?->format('Y/m/d') }}
                                                </span>

                                            </div>

                                        </div>


                                        <div class="review-card-rating">

                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                            @endfor

                                        </div>

                                    </div>


                                    <p class="review-card-comment">
                                        {{ $review->comment }}
                                    </p>

                                </article>
                            @endforeach

                        </div>

                    @endif

                </section>

            </section>

        </main>

    @endsection

    @section('footer')
        @include('components.footers.home-footer')
    @endsection
