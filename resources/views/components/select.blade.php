<div class="form-group">
    <label class="form-label">{{ $label }}</label>
    <div class="form-control-wrap">
        <select class="form-select js-select2" id="{{ $name }}" onchange="{{ $onchange }}" name="{{ $name }}" data-search="on" {{ $isRequired ? "required" : "" }}>
            <option></option>
            @foreach ($options as $option)
                @if($defaultValue == $option['id'])
                    <option value="{{ $option['id'] }}" selected>{{ $option['name'] }}</option>
                @else
                    <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>