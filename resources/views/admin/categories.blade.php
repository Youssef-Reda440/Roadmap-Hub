@extends('admin.layouts.master')

@section('title', 'Categories | Roadmap Hub')

@section('admin-content')
    @include('admin.components.breadcrumb', ['current' => 'Categories'])

    <section class="admin-page-heading d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="h2 mb-1">Manage categories</h1>
            <p class="text-secondary mb-0">Organize topics and help learners discover the right roadmaps.</p>
        </div>
        <button class="btn admin-btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#create-category-form"
            aria-expanded="{{ old('form_context') === 'create-category' ? 'true' : 'false' }}" aria-controls="create-category-form">
            Add category
        </button>
    </section>

    <section class="collapse {{ old('form_context') === 'create-category' ? 'show' : '' }}" id="create-category-form">
        <div class="admin-panel card shadow-sm border-0 mb-4">
            <div class="card-header bg-white">
                <h2 class="h5 mb-1">Add category</h2>
                <p class="small text-secondary mb-0">Create a category for organizing roadmaps.</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('/admin/categories') }}">
                    @csrf
                    <input name="form_context" type="hidden" value="create-category">

                    <div class="mb-3">
                        <label class="form-label" for="new-category-name">Category name</label>
                        <input id="new-category-name" class="form-control admin-form-control @error('name') is-invalid @enderror"
                            name="name" type="text" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-0">
                        <label class="form-label" for="new-category-description">Description</label>
                        <textarea id="new-category-description" class="form-control admin-form-control @error('description') is-invalid @enderror"
                            name="description" rows="4">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-form-actions d-flex justify-content-end gap-2 mt-4">
                        <button class="btn admin-btn-secondary" type="button" data-bs-toggle="collapse"
                            data-bs-target="#create-category-form">Cancel</button>
                        <button class="btn admin-btn-primary" type="submit">Create category</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="admin-panel card shadow-sm border-0">
        <div class="card-body p-0">
            <form class="admin-filter-bar border-bottom p-3 d-flex flex-column flex-sm-row align-items-sm-center gap-2" method="GET"
                action="{{ url('/admin/categories') }}">
                <label class="admin-search admin-search--wide input-group mb-0">
                    <span class="input-group-text bg-white"><i class="bi bi-search" aria-hidden="true"></i></span>
                    <input class="form-control" name="search" type="search" value="{{ request('search', '') }}"
                        placeholder="Search categories">
                </label>
                <button class="btn admin-btn-primary" type="submit">Search</button>
                <a class="btn admin-btn-secondary" href="{{ url('/admin/categories') }}">Reset</a>
            </form>

            @if ($categories->isEmpty())
                <div class="p-4">
                    @include('admin.components.empty-state', [
                        'title' => 'No categories found',
                        'description' => 'Categories will appear here when they are available.',
                        'icon' => 'bi-grid',
                        'slot' => '',
                    ])
                </div>
            @else
                <div class="admin-table-wrapper table-responsive">
                    <table class="table admin-data-table align-middle mb-0">
                        <caption class="visually-hidden">Roadmap categories</caption>
                        <thead>
                            <tr>
                                <th scope="col">Category name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Roadmaps</th>
                                <th scope="col">Created</th>
                                <th scope="col" class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $listedCategory)
                                <tr>
                                    <td><strong>{{ $listedCategory->name }}</strong></td>
                                    <td>{{ $listedCategory->description ?: '—' }}</td>
                                    <td>{{ $listedCategory->roadmaps_count }}</td>
                                    <td>{{ $listedCategory->created_at?->format('M j, Y') ?? '—' }}</td>
                                    <td class="text-end">
                                        <a class="btn admin-btn-secondary btn-sm"
                                            href="{{ url('/admin/categories/' . $listedCategory->id) }}{{ request()->filled('search') ? '?search=' . urlencode(request('search')) : '' }}">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="admin-pagination border-top px-3 py-3">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </section>

    @isset($category)
        <section class="admin-panel card shadow-sm border-0 mt-4" id="category-details">
            <div class="card-header bg-white">
                <h2 class="h5 mb-1">Edit category</h2>
                <p class="small text-secondary mb-0">Update the available category information.</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('/admin/categories/' . $category->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label" for="category-name">Category name</label>
                        <input id="category-name" class="form-control admin-form-control @error('name') is-invalid @enderror"
                            name="name" type="text" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-0">
                        <label class="form-label" for="category-description">Description</label>
                        <textarea id="category-description" class="form-control admin-form-control @error('description') is-invalid @enderror"
                            name="description" rows="4">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="admin-form-actions d-flex justify-content-end gap-2 mt-4">
                        <a class="btn admin-btn-secondary" href="{{ url('/admin/categories') }}">Cancel</a>
                        <button class="btn admin-btn-primary" type="submit">Save category</button>
                    </div>
                </form>

                <div class="border-top mt-4 pt-4">
                    @if ($category->roadmaps_count === 0)
                        <form method="POST" action="{{ url('/admin/categories/' . $category->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn admin-btn-danger" type="submit">Delete category</button>
                        </form>
                    @else
                        <button class="btn admin-btn-danger" type="button" disabled
                            title="Cannot delete category because it has linked roadmaps."
                            aria-describedby="delete-category-unavailable">
                            Delete category
                        </button>
                        <p class="small text-secondary mt-2 mb-0" id="delete-category-unavailable">
                            Cannot delete category because it has linked roadmaps.
                        </p>
                    @endif
                </div>
            </div>
        </section>
    @endisset
@endsection
