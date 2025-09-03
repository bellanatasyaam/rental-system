{{-- layouts/menu.blade.php --}}
@php
    use Illuminate\Support\Facades\Auth;
@endphp

<ul class="navbar-nav me-auto mb-2 mb-lg-0">

    {{-- Menu Dashboard - Semua user bisa lihat --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">Dashboard</a>
    </li>

    {{-- Menu - Hanya Admin yang bisa lihat --}}
    @role('Admin')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('companies.index') }}">Manage Companies</a>
            <a class="nav-link" href="{{ route('facilities.index') }}">Manage Facilities</a>
            <a class="nav-link" href="{{ route('tenants.index') }}">Manage Tenants</a>
            <a class="nav-link" href="{{ route('properties.index') }}">Manage Properties</a>
            <a class="nav-link" href="{{ route('property_units.index') }}">Manage Property Units</a>
            <a class="nav-link" href="{{ route('contracts.index') }}">Manage Contracts</a>
            <a class="nav-link" href="{{ route('payments.index') }}">Manage Payments</a>
            <a class="nav-link" href="{{ route('property_unit_facilities.index') }}">Manage Property Unit Facilities</a>
            <a class="nav-link" href="{{ route('facility_usages.index') }}">Manage Facility Usages</a>
            <a class="nav-link" href="{{ route('users.index') }}">Manage Users</a>
            <a class="nav-link" href="{{ route('roles.index') }}">Manage Roles</a>
            <a class="nav-link" href="{{ route('reports.index') }}">Reports</a>
        </li>
    @endrole

    {{-- Menu - Hanya Staff --}}
    @hasanyrole('Staff')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tenants.index') }}">Manage Tenants</a>
            <a class="nav-link" href="{{ route('contracts.index') }}">Contracts</a>
        </li>
    @endhasanyrole

    {{-- Menu - Khusus Tenants --}}
    @role('Tenant')
        <li class="nav-item">
            <a class="nav-link" href="{{ route('tenants.index') }}">Manage Tenants</a>
        </li>
    @endrole

</ul>
{{-- End of layouts/menu.blade.php --}}

{{-- layouts/app.blade.php --}}