@if(session()->has('error') || ($errors->count() && $errors->has('error')))
    <p class="alert alert-danger text-center">{{ session('error') ?? $errors->first('error') ?? '' }}</p>
@endif
@if(session()->has('warning'))
    <p class="alert alert-warning text-center">{{ session('warning') }}</p>
@endif
@if(session()->has('success') || isset($success))
    <p class="alert alert-success text-center">{{ session('success') ?? $success }}</p>
@endif