@props([
    'title' => 'No records found',
    'description' => null,
    'icon' => 'bi-inbox',
])

<section {{ $attributes->class(['admin-empty-state', 'border', 'rounded-3', 'bg-light', 'p-5', 'text-center']) }}>
    <i class="bi {{ $icon }} display-6 text-secondary" aria-hidden="true"></i>
    <h2 class="h5 mt-3 mb-2">{{ $title }}</h2>

    @if ($description)
        <p class="text-secondary mb-0">{{ $description }}</p>
    @endif

    {{ $slot }}
</section>
