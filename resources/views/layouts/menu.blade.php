{{-- layouts/menu.blade.php --}}
@php
    use Illuminate\Support\Facades\Auth;
@endphp

<ul class="navbar-nav me-auto mb-2 mb-lg-0">

    {{-- Menu Dashboard - Semua user bisa lihat --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Dashboard</a>
    </li>

    {{-- Menu Users - Hanya Admin yang bisa lihat --}}
    @role('Admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('users.index') }}">Manage Users</a>
        </li>
    @endrole

    {{-- Menu Tenants - Hanya Staff & Admin --}}
    @hasanyrole('Staff|Admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tenants.index') }}">Manage Tenants</a>
        </li>
    @endhasanyrole

    {{-- Menu Properties - Khusus Admin --}}
    @role('Admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('properties.index') }}">Manage Properties</a>
        </li>
    @endrole

    {{-- Menu Contracts - Admin & Staff --}}
    @hasanyrole('Admin|Staff')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('contracts.index') }}">Contracts</a>
        </li>
    @endhasanyrole

    {{-- Menu Reports - Hanya Admin --}}
    @can('view reports')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('reports.index') }}">Reports</a>
        </li>
    @endcan

</ul>
{{-- End of layouts/menu.blade.php --}}

{{-- layouts/app.blade.php --}}