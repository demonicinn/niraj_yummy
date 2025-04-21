@php
    $segment2 = request()->segment(2);

@endphp

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('ab') }}" class="brand-link">
            <span class="brand-text fw-light">{{ $app }}</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('ab.dashboard') }}"
                        class="nav-link{{ $segment2=='' || $segment2=='dashboard' ? ' active':'' }}">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ab.users') }}"
                        class="nav-link{{ $segment2=='users' ? ' active':'' }}">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Users</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ab.restaurants') }}"
                        class="nav-link{{ $segment2=='restaurants' ? ' active':'' }}">
                        <i class="nav-icon bi bi-palette"></i>
                        <p>Restaurants</p>
                    </a>
                </li>

                

            </ul>
        </nav>
    </div>
</aside>
