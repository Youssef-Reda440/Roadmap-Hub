

@props(['status'])

@php
    $normalizedStatus = str($status)->lower()->replace(['_', '-'], ' ')->trim()->value();
    $variants = [
        'approved' => 'success',
        'published' => 'success',
        'resolved' => 'success',
        'pending' => 'warning text-dark',
        'pending review' => 'warning text-dark',
        'rejected' => 'danger',
        'draft' => 'secondary',
    ];
    $variant = $variants[$normalizedStatus] ?? 'secondary';
@endphp

<span {{ $attributes->class(['badge', 'admin-status-badge', "bg-{$variant}"]) }}>
    {{ \Illuminate\Support\Str::headline($status) }}
</span>
