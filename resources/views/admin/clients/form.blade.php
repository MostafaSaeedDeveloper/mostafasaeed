@csrf
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Name</label><input type="text" name="name" class="form-control" value="{{ old('name', $client->name) }}" required></div>
    <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" value="{{ old('email', $client->email) }}"></div>
    <div class="col-md-6"><label class="form-label">Phone</label><input type="text" name="phone" class="form-control" value="{{ old('phone', $client->phone) }}"></div>
    <div class="col-md-6"><label class="form-label">Company</label><input type="text" name="company" class="form-control" value="{{ old('company', $client->company) }}"></div>
    <div class="col-md-6"><label class="form-label">Country</label><input type="text" name="country" class="form-control" value="{{ old('country', $client->country) }}"></div>
    <div class="col-md-6"><label class="form-label">Website</label><input type="url" name="website" class="form-control" value="{{ old('website', $client->website) }}"></div>
    <div class="col-12"><label class="form-label">Address</label><textarea name="address" class="form-control">{{ old('address', $client->address) }}</textarea></div>
    <div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control">{{ old('notes', $client->notes) }}</textarea></div>
</div>
