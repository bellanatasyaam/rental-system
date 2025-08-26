@extends('layouts.app')

@section('title', 'Payment List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Payment List</h3>
    <div class="d-flex">
        <button onclick="window.location.href='http://127.0.0.1:8000'" class="btn btn-secondary me-2">Home</button>
        <a href="{{ route('payments.create') }}" class="btn btn-primary">+ Add Payment</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Contract</th>
            <th>Payment Date</th>
            <th>Amount</th>
            <th>Method</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($payments as $payment)
        <tr>
            <td>{{ $payment->id }}</td>
            <td>{{ $payment->contract->tenant_name ?? 'N/A' }}</td>
            <td>{{ $payment->payment_date }}</td>
            <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
            <td>{{ ucfirst($payment->method) }}</td>
            <td>{{ ucfirst($payment->status) }}</td>
            <td>
                <a href="{{ route('payments.edit', $payment) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('payments.destroy', $payment) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this payment?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
                <a href="{{ route('payments.show', $payment->id) }}" class="btn btn-info btn-sm">View Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $payments->links() }}
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush
