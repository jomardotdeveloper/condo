
<div class="form-group">
    <label class="form-label" for="{{ $name }}">{{ $label }}</label>
    <div class="form-control-wrap">
        <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $label }}" {{ $isRequired ? "required" : ""}} value="{{ $defaultValue == 'BOXZ123__223' ? request()->old($name) : $defaultValue }}" {{  $isReadonly ? "readonly" : "" }}/>
    </div>
</div>
