@if ($errors->has($key))
    <div class="help-block animation-slideDown" style="color: #ff0000">{{ $errors->first($key) }}</div>
@endif
