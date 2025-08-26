@extends('layouts.app')

@section('title','Facility Usage List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Facility Usage List</h3>
    <div class="d-flex">
        <button onclick="window.location.href='http://127.0.0.1:8000'" class="btn btn-secondary me-2">Home</button>
        <a href="{{ route('facility_usages.create') }}" class="btn btn-primary">+ Add Usage</a></div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Unit Facility</th>
            <th>Contract</th>
            <th>Period Start</th>
            <th>Period End</th>
            <th>Usage Value</th>
            <th>Rate</th>
            <th>Total Cost</th>
            <th>Invoiced</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usages as $usage)
        <tr>
            <td>{{ $usage->id }}</td>
            <td>{{ $usage->propertyUnitFacility->name ?? '-' }}</td>
            <td>Contract #{{ $usage->contract->id ?? '-' }}</td>
            <td>{{ $usage->period_start }}</td>
            <td>{{ $usage->period_end }}</td>
            <td>{{ $usage->usage_value }}</td>
            <td>{{ $usage->rate }}</td>
            <td>{{ $usage->total_cost }}</td>
            <td>{{ $usage->invoiced ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('facility_usages.edit', $usage) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('facility_usages.destroy', $usage) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this usage?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- $usages = FacilityUsage::with(['propertyUnitFacility','contract'])->paginate(10); // 10 per halaman
return view('facility_usages.index', compact('usages')); -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush
