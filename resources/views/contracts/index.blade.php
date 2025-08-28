@extends('layouts.app')

@section('title', 'Contracts List')

@section('content')
    <div class="d-flex justify-content-between mb-3">
    <h3>Contracts List</h3>
    <div class="d-flex">
        <button onclick="window.location.href='http://127.0.0.1:8000'" class="btn btn-secondary me-2">Home</button>
        <div class="d-flex justify-content-center gap-2">
        <td><a href="{{ route('contracts.create') }}" class="btn btn-primary">+ Add Contract</a></td>
        <td><a href="{{ route('contracts.print') }}" class="btn btn-primary">Print Contract</a></td>
        </div>
    </div>
</div>

{{-- Success Message --}}
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Property Unit</th>
            <th>Tenant</th>
            <th hidden>Contract No</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Monthly Rent</th>
            <th>Deposit</th>
            <th>Payment Due</th>
            <th>Status</th>
            <th width="180">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contracts as $contract)
        <tr>
            <td>{{ $contract->id }}</td>
            <td>
                {{ $contract->propertyUnit->unit_code ?? '-' }}
                <br>
                <small class="text-muted">{{ $contract->propertyUnit->name ?? '-' }}</small>
            </td>
            <td>{{ $contract->tenant->name ?? '-' }}</td>
            <td hidden>{{ $contract->contract_number ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($contract->start_date)->format('d M Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($contract->end_date)->format('d M Y') }}</td>
            <td>Rp {{ number_format($contract->monthly_rent, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($contract->deposit_amount, 0, ',', '.') }}</td>
            <td>{{ $contract->payment_due_day }}</td>
            <td>
                @if($contract->status === 'active')
                    <span class="badge bg-success">Active</span>
                @elseif($contract->status === 'ended')
                    <span class="badge bg-secondary">Ended</span>
                @else
                    <span class="badge bg-warning text-dark">Pending</span>
                @endif
            </td>

            <td class="text-center">
                <div class="d-flex">
                    {{-- Tombol Edit --}}
                    <a href="{{ route('contracts.edit', $contract) }}" 
                       class="btn btn-warning btn-sm me-1">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    {{-- Tombol Detail --}}
                    <a href="{{ route('contracts.show', $contract->id) }}" 
                       class="btn btn-info btn-sm me-1 text-white">
                        <i class="bi bi-eye"></i> Detail
                    </a>    

                    {{-- Tombol Print --}}
                    <a href="{{ route('contracts.print.one', $contract->id) }}" 
                       class="btn btn-info btn-sm me-1 text-white">
                        <i class="bi bi-eye"></i> 🖨 Print
                    </a>

                    {{-- Tombol Delete --}}
                    <form action="{{ route('contracts.destroy', $contract) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete this contract?')"
                            class="btn btn-danger btn-sm">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- Pagination --}}
{{ $contracts->links() }}
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush
