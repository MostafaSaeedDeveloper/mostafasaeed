@csrf
<div class="card card-outline card-primary"><div class="card-body"><div class="row g-3">
<div class="col-md-6"><label>Name</label><input type="text" name="name" class="form-control" value="{{ old('name',$method->name) }}" required></div>
<div class="col-md-6"><label>Customer Label</label><input type="text" name="customer_label" class="form-control" value="{{ old('customer_label',$method->customer_label) }}"></div>
<div class="col-md-6"><label>Description</label><textarea name="description" class="form-control">{{ old('description',$method->description) }}</textarea></div>
<div class="col-md-6"><label>Payment Instructions</label><textarea name="instructions" class="form-control">{{ old('instructions',$method->instructions) }}</textarea></div>
<div class="col-md-6"><label>Logo</label><input type="file" name="logo" class="form-control"></div>
<div class="col-md-3"><div class="custom-control custom-switch mt-4"><input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1" @checked(old('is_active',$method->is_active))><label class="custom-control-label" for="is_active">Active</label></div></div>
<div class="col-md-3"><div class="custom-control custom-switch mt-4"><input type="checkbox" class="custom-control-input" id="is_default" name="is_default" value="1" @checked(old('is_default',$method->is_default))><label class="custom-control-label" for="is_default">Default</label></div></div>
</div></div><div class="card-footer text-right"><button class="btn btn-primary">Save</button></div></div>
