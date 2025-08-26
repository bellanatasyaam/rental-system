@extends('layouts.app')

@section('title','Payment Detail')

@section('content')
<div class="container">
    <h1>Detail Payment</h1>
    <p><strong>Contract:</strong> {{ $payment->contract->tenant_name ?? 'N/A' }}</p>
    <p><strong>Payment Date:</strong> {{ $payment->payment_date }}</p>
    <p><strong>Amount:</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
    <p><strong>Method:</strong> {{ ucfirst($payment->method) }}</p>
    <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>

    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
