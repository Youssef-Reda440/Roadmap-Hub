@extends('admin.layouts.master')

@section('title', 'Profile | Roadmap Hub')

@section('admin-content')
    @include('admin.components.breadcrumb', ['current' => 'Profile'])

    <section class="admin-page-heading mb-4">
        <h1 class="h2 mb-1">Profile</h1>
        <p class="text-secondary mb-0">Update your admin account details.</p>
    </section>

    <section class="row g-4">
        <div class="col-12 col-xl-4">
            <article class="admin-panel card shadow-sm border-0 text-center h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <span class="admin-avatar admin-avatar--profile mb-3" aria-hidden="true">
                        {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($user->name, 0, 1)) }}
                    </span>
                    <h2 class="h5 mb-1">{{ $user->name }}</h2>
                    <p class="admin-panel__description text-secondary mb-2">Platform administrator</p>
                    <span class="badge text-bg-light">{{ \Illuminate\Support\Str::headline($user->role) }}</span>
                </div>
            </article>
        </div>

        <div class="col-12 col-xl-8">
            <article class="admin-panel card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h2 class="h5 mb-0">Basic information</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ url('/admin/profile') }}">
                        @csrf
                        @method('PATCH')

                        <div class="row g-4">
                            <div class="col-12 col-md-6">
                                <label class="form-label" for="profile-name">Full name</label>
                                <input id="profile-name"
                                    class="form-control admin-form-control @error('name') is-invalid @enderror"
                                    name="name" type="text" value="{{ old('name', $user->name) }}" required
                                    autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label" for="profile-email">Email</label>
                                <input id="profile-email"
                                    class="form-control admin-form-control @error('email') is-invalid @enderror"
                                    name="email" type="email" value="{{ old('email', $user->email) }}" required
                                    autocomplete="email" dir="ltr">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="profile-role">Account role</label>
                                <input id="profile-role" class="form-control admin-form-control" type="text"
                                    value="{{ \Illuminate\Support\Str::headline($user->role) }}" readonly
                                    aria-describedby="profile-role-help">
                                <p class="form-text mb-0" id="profile-role-help">
                                    Your account role is read-only and cannot be changed from Profile.
                                </p>
                            </div>
                        </div>

                        <div class="admin-form-actions d-flex justify-content-end mt-4">
                            <button class="btn admin-btn-primary" type="submit">Save changes</button>
                        </div>
                    </form>
                </div>
            </article>
        </div>
    </section>
@endsection
