<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name',$company->name ?? '') }}" required>
</div>
<div class="mb-3">
    <label>Address</label>
    <textarea name="address" class="form-control">{{ old('address',$company->address ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label>Phone</label>
    <input type="text" name="phone" class="form-control" value="{{ old('phone',$company->phone ?? '') }}">
</div>
<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email',$company->email ?? '') }}">
</div>
<div class="mb-3">
    <label>Tax Number</label>
    <input type="text" name="tax_number" class="form-control" value="{{ old('tax_number',$company->tax_number ?? '') }}">
</div>

<div class="mb-3">
    <label for="logo" class="form-label">Company Logo</label>
    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror">
    @error('logo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if(!empty($company->logo))
        <img src="{{ asset('storage/'.$company->logo) }}" alt="Logo" width="100" class="mt-2">
    @endif
</div>

@push('scripts')
<script>
$(function(){
    $('select').select2();
});
</script>
@endpush