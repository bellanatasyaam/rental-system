@extends('layouts.app')

@section('title', 'Tambah Tenant')

@section('content')
<div class="container">
    <h3 class="mb-3">Tambah Tenant Baru</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tenants.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="contact_name" class="form-label">Contact Name</label>
            <input type="text" name="contact_name" id="contact_name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>

        <div class="mb-3">
            <label for="id_card_number" class="form-label">ID Card Number</label>
            <input type="text" name="id_card_number" id="id_card_number" class="form-control">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
