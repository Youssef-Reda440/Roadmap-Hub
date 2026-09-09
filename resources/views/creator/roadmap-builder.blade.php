@extends('layouts.app')

@section('title', 'Roadmap Builder')

@section('head')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/creator/style.css') }}">
@endsection

@section('navigation')
    @include('components.navbars.creator-navbar')
@endsection

@section('content')
    @php
        /** @var \App\Models\Roadmap|null $roadmap */
        /** @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Category> $categories */
    @endphp

    <div class="container py-4 py-lg-5">

        {{-- Page Header --}}
        <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">

            <div>
                <h1 class="page-title">
                    {{ isset($roadmap) ? 'Edit Roadmap' : 'Add New Roadmap' }}
                </h1>

                <p class="page-subtitle mb-0">
                    {{ isset($roadmap)
                        ? 'Update your roadmap and manage its learning resources.'
                        : 'Create a structured learning path for your audience.' }}
                </p>
            </div>

            <a href="{{ route('creator.roadmaps.index') }}" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left me-2"></i>
                Back to List
            </a>

        </div>


        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger mb-4">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>
        @endif


        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif


        {{-- Error Message --}}
        @if (session('error'))
            <div class="alert alert-danger mb-4">
                {{ session('error') }}
            </div>
        @endif


        {{-- Roadmap Form --}}
        <form action="{{ isset($roadmap) ? route('creator.roadmaps.update', $roadmap) : route('creator.roadmaps.store') }}"
            method="POST">

            @csrf

            @if (isset($roadmap))
                @method('PATCH')
            @endif


            {{-- =========================
            Basic Information
        ========================== --}}

            <div class="form-section">

                <h3 class="h5 fw-bold mb-4">
                    <i class="bi bi-info-circle me-2 text-primary"></i>
                    Basic Information
                </h3>


                <div class="row g-4">

                    {{-- Title --}}
                    <div class="col-md-8">

                        <label for="title" class="form-label">
                            Roadmap Title
                        </label>

                        <input type="text" name="title" id="title" class="form-control"
                            placeholder="e.g., Full Stack Web Development" value="{{ old('title', $roadmap->title ?? '') }}"
                            required>

                    </div>


                    {{-- Category --}}
                    <div class="col-md-4">

                        <label for="category_id" class="form-label">
                            Category
                        </label>

                        <select name="category_id" id="category_id" class="form-select" required>

                            <option value="">
                                Select Category
                            </option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $roadmap->category_id ?? '') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>


                    {{-- Description --}}
                    <div class="col-12">

                        <label for="description" class="form-label">
                            Description
                        </label>

                        <textarea name="description" id="description" class="form-control" rows="4"
                            placeholder="Describe what learners will achieve..." required>{{ old('description', $roadmap->description ?? '') }}</textarea>

                    </div>


                    {{-- Level --}}
                    <div class="col-md-6">

                        <label for="level" class="form-label">
                            Level
                        </label>

                        <select name="level" id="level" class="form-select" required>

                            <option value="">
                                Select Level
                            </option>

                            <option value="beginner" @selected(old('level', $roadmap->level ?? '') === 'beginner')>
                                Beginner
                            </option>

                            <option value="intermediate" @selected(old('level', $roadmap->level ?? '') === 'intermediate')>
                                Intermediate
                            </option>

                            <option value="advanced" @selected(old('level', $roadmap->level ?? '') === 'advanced')>
                                Advanced
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- =========================
            Learning Resources
        ========================== --}}

            <div class="form-section">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <h3 class="h5 fw-bold mb-0">
                        <i class="bi bi-list-ol me-2 text-primary"></i>
                        Learning Resources
                    </h3>

                    <span class="text-muted" style="font-size: 0.875rem;">
                        Add resources in learning order
                    </span>

                </div>


                {{-- Add Resource --}}
                <div class="resource-builder-header text-center">

                    <p class="mb-2 fw-semibold">
                        Build your learning path step by step
                    </p>

                    <button type="button" class="btn btn-primary-custom btn-sm" id="add-resource-btn">
                        <i class="bi bi-plus-lg me-1"></i>
                        Add Resource
                    </button>

                </div>


                {{-- Resources Container --}}
                <div id="resources-container">

                    @if (isset($roadmap) && $roadmap->resources->isNotEmpty())

                        @foreach ($roadmap->resources as $index => $resource)
                            <div class="resource-item">

                                <div class="row g-3 align-items-start">

                                    {{-- Resource Order --}}
                                    <div class="col-auto">

                                        <div class="d-flex flex-column align-items-center gap-2">

                                            <div class="resource-order">
                                                {{ $index + 1 }}
                                            </div>

                                            <div class="order-controls d-flex flex-column gap-1">

                                                <button type="button" class="move-resource-up" title="Move up">
                                                    <i class="bi bi-chevron-up"></i>
                                                </button>

                                                <button type="button" class="move-resource-down" title="Move down">
                                                    <i class="bi bi-chevron-down"></i>
                                                </button>

                                            </div>

                                        </div>

                                    </div>


                                    <div class="col">

                                        <div class="row g-3">

                                            {{-- Resource Type --}}
                                            <div class="col-md-3">

                                                <label class="form-label" style="font-size: 0.75rem;">
                                                    Type
                                                </label>

                                                <select name="resources[{{ $index }}][type]"
                                                    class="form-select form-select-sm" required>

                                                    @foreach ([
            'video' => 'Video',
            'documentation' => 'Documentation',
            'article' => 'Article',
            'link' => 'Link',
            'other' => 'Other',
        ] as $value => $label)
                                                        <option value="{{ $value }}" @selected(old("resources.$index.type", $resource->type) === $value)>
                                                            {{ $label }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                            </div>


                                            {{-- Resource Title --}}
                                            <div class="col-md-4">

                                                <label class="form-label" style="font-size: 0.75rem;">
                                                    Title
                                                </label>

                                                <input type="text" name="resources[{{ $index }}][title]"
                                                    class="form-control form-control-sm"
                                                    value="{{ old("resources.$index.title", $resource->title) }}"
                                                    placeholder="Resource title" required>

                                            </div>


                                            {{-- Resource URL --}}
                                            <div class="col-md-5">

                                                <label class="form-label" style="font-size: 0.75rem;">
                                                    URL
                                                </label>

                                                <input type="url" name="resources[{{ $index }}][url]"
                                                    class="form-control form-control-sm"
                                                    value="{{ old("resources.$index.url", $resource->url) }}"
                                                    placeholder="https://..." required>

                                            </div>


                                            {{-- Resource Description --}}
                                            <div class="col-12">

                                                <label class="form-label" style="font-size: 0.75rem;">
                                                    Description
                                                </label>

                                                <input type="text" name="resources[{{ $index }}][description]"
                                                    class="form-control form-control-sm"
                                                    value="{{ old("resources.$index.description", $resource->description) }}"
                                                    placeholder="Brief description..." required>

                                            </div>

                                        </div>

                                    </div>


                                    {{-- Remove Resource --}}
                                    <div class="col-auto">

                                        <button type="button" class="action-btn btn-delete remove-resource"
                                            title="Remove resource">
                                            <i class="bi bi-x-lg"></i>
                                        </button>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    @endif

                </div>


                {{-- Empty State --}}
                <div id="resources-empty"
                    class="empty-state py-4
                    {{ isset($roadmap) && $roadmap->resources->isNotEmpty() ? 'd-none' : '' }}">

                    <div class="empty-state-icon" style="font-size: 3rem;">
                        <i class="bi bi-collection"></i>
                    </div>

                    <p class="mb-0">
                        No resources added yet.
                        Click "Add Resource" to start building.
                    </p>

                </div>

            </div>


            {{-- =========================
            Actions
        ========================== --}}

            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-end">

                {{-- Cancel --}}
                <a href="{{ route('creator.roadmaps.index') }}" class="btn btn-outline-custom">
                    Cancel
                </a>


                {{-- Save as Draft --}}
                <button type="submit" name="action" value="draft" class="btn btn-outline-custom">
                    <i class="bi bi-file-earmark me-2"></i>
                    Save as Draft
                </button>


                {{-- Submit for Review --}}
                <button type="submit" name="action" value="submit" class="btn btn-primary-custom">
                    <i class="bi bi-send me-2"></i>
                    Submit
                </button>

            </div>

        </form>

    </div>


    {{-- =========================
        Roadmap Builder JavaScript
    ========================== --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const addResourceButton = document.getElementById('add-resource-btn');
            const resourcesContainer = document.getElementById('resources-container');
            const resourcesEmpty = document.getElementById('resources-empty');

            if (!addResourceButton || !resourcesContainer) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Add Resource
            |--------------------------------------------------------------------------
            */

            addResourceButton.addEventListener('click', function() {

                const index =
                    resourcesContainer.querySelectorAll('.resource-item').length;

                const resource = document.createElement('div');

                resource.classList.add('resource-item');

                resource.innerHTML = `
                    <div class="row g-3 align-items-start">

                        <div class="col-auto">

                            <div class="d-flex flex-column align-items-center gap-2">

                                <div class="resource-order">
                                    ${index + 1}
                                </div>

                                <div class="order-controls d-flex flex-column gap-1">

                                    <button
                                        type="button"
                                        class="move-resource-up"
                                        title="Move up"
                                    >
                                        <i class="bi bi-chevron-up"></i>
                                    </button>

                                    <button
                                        type="button"
                                        class="move-resource-down"
                                        title="Move down"
                                    >
                                        <i class="bi bi-chevron-down"></i>
                                    </button>

                                </div>

                            </div>

                        </div>


                        <div class="col">

                            <div class="row g-3">

                                {{-- Type --}}
                                <div class="col-md-3">

                                    <label
                                        class="form-label"
                                        style="font-size: 0.75rem;"
                                    >
                                        Type
                                    </label>

                                    <select
                                        name="resources[${index}][type]"
                                        class="form-select form-select-sm"
                                        required
                                    >
                                        <option value="video">
                                            Video
                                        </option>

                                        <option value="documentation">
                                            Documentation
                                        </option>

                                        <option value="article">
                                            Article
                                        </option>

                                        <option value="link">
                                            Link
                                        </option>

                                        <option value="other">
                                            Other
                                        </option>
                                    </select>

                                </div>


                                {{-- Title --}}
                                <div class="col-md-4">

                                    <label
                                        class="form-label"
                                        style="font-size: 0.75rem;"
                                    >
                                        Title
                                    </label>

                                    <input
                                        type="text"
                                        name="resources[${index}][title]"
                                        class="form-control form-control-sm"
                                        placeholder="Resource title"
                                        required
                                    >

                                </div>


                                {{-- URL --}}
                                <div class="col-md-5">

                                    <label
                                        class="form-label"
                                        style="font-size: 0.75rem;"
                                    >
                                        URL
                                    </label>

                                    <input
                                        type="url"
                                        name="resources[${index}][url]"
                                        class="form-control form-control-sm"
                                        placeholder="https://..."
                                        required
                                    >

                                </div>


                                {{-- Description --}}
                                <div class="col-12">

                                    <label
                                        class="form-label"
                                        style="font-size: 0.75rem;"
                                    >
                                        Description
                                    </label>

                                    <input
                                        type="text"
                                        name="resources[${index}][description]"
                                        class="form-control form-control-sm"
                                        placeholder="Brief description..."
                                        required
                                    >

                                </div>

                            </div>

                        </div>


                        {{-- Remove --}}
                        <div class="col-auto">

                            <button
                                type="button"
                                class="action-btn btn-delete remove-resource"
                                title="Remove resource"
                            >
                                <i class="bi bi-x-lg"></i>
                            </button>

                        </div>

                    </div>
                `;

                resourcesContainer.appendChild(resource);

                updateResources();

            });


            /*
            |--------------------------------------------------------------------------
            | Resource Actions
            |--------------------------------------------------------------------------
            */

            resourcesContainer.addEventListener('click', function(event) {

                const removeButton =
                    event.target.closest('.remove-resource');

                if (removeButton) {

                    const resource =
                        removeButton.closest('.resource-item');

                    if (resource) {
                        resource.remove();
                        updateResources();
                    }

                    return;
                }


                const moveUpButton =
                    event.target.closest('.move-resource-up');

                if (moveUpButton) {

                    const resource =
                        moveUpButton.closest('.resource-item');

                    const previousResource =
                        resource.previousElementSibling;

                    if (previousResource) {

                        resourcesContainer.insertBefore(
                            resource,
                            previousResource
                        );

                        updateResources();

                    }

                    return;
                }


                const moveDownButton =
                    event.target.closest('.move-resource-down');

                if (moveDownButton) {

                    const resource =
                        moveDownButton.closest('.resource-item');

                    const nextResource =
                        resource.nextElementSibling;

                    if (nextResource) {

                        resourcesContainer.insertBefore(
                            nextResource,
                            resource
                        );

                        updateResources();

                    }

                }

            });


            /*
            |--------------------------------------------------------------------------
            | Update Resource Indexes / Order
            |--------------------------------------------------------------------------
            */

            function updateResources() {

                const resources =
                    resourcesContainer.querySelectorAll('.resource-item');


                resources.forEach(function(resource, index) {

                    const order =
                        resource.querySelector('.resource-order');

                    if (order) {
                        order.textContent = index + 1;
                    }


                    resource
                        .querySelectorAll('[name^="resources["]')
                        .forEach(function(field) {

                            field.name = field.name.replace(
                                /resources\[\d+\]/,
                                `resources[${index}]`
                            );

                        });


                    const moveUpButton =
                        resource.querySelector('.move-resource-up');

                    const moveDownButton =
                        resource.querySelector('.move-resource-down');


                    if (moveUpButton) {
                        moveUpButton.disabled = index === 0;
                    }

                    if (moveDownButton) {
                        moveDownButton.disabled =
                            index === resources.length - 1;
                    }

                });


                if (resourcesEmpty) {

                    resourcesEmpty.classList.toggle(
                        'd-none',
                        resources.length > 0
                    );

                }

            }


            /*
            |--------------------------------------------------------------------------
            | Initial State
            |--------------------------------------------------------------------------
            */

            updateResources();

        });
    </script>

@endsection

@section('footer')
    @include('components.footers.footer')
@endsection
