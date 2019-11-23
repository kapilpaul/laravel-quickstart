@if ($errors->has($key))
    <p class="help-block text-danger">{{ $errors->first($key) }}</p>
@endif
