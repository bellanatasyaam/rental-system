@extends('layouts.app')

@section('title', 'Tenant Details')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tenant Details</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Nama</th>
                <td>{{ $tenant->name }}</td>
            </tr>
            <tr>
                <th>Contact Name</th>
                <td>{{ $tenant->contact_name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $tenant->phone ?? '-' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $tenant->email ?? '-' }}</td>
            </tr>
            <tr>
                <th>ID Card Number</th>
                <td>{{ $tenant->id_card_number ?? '-' }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $tenant->address ?? '-' }}</td>
            </tr>
            <tr>
                <th>Created At</th>
                <td>{{ $tenant->created_at ? $tenant->created_at->format('d M Y H:i') : '-' }}</td>
            </tr>
            <tr>
                <th>Updated At</th>
                <td>{{ $tenant->updated_at ? $tenant->updated_at->format('d M Y H:i') : '-' }}</td>
            </tr>
        </table>
        <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
