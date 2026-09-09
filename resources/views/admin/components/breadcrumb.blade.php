@props(['current'])

<nav class="admin-breadcrumb mb-3 small text-secondary" aria-label="Breadcrumb">
    <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $current }}</li>
    </ol>
</nav>
