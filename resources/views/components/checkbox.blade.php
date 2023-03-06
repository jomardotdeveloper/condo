<div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{ $value }}" id="{{ $name }}" name="{{ $name }}" {{ $isChecked ? "checked" : "" }}>
    <label class="form-check-label">
      {{ $label }}
    </label>
</div>