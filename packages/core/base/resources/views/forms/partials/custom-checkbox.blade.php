@php
$values = (array)$values;
@endphp
    @foreach ($values as $value)
    @php
        $name = isset($value[0]) ? $value[0] : '';
        $currentValue = isset($value[1]) ? $value[1] : '';
        $label = isset($value[2]) ? $value[2] : '';
        $selected = isset($value[3]) ? (bool)$value[3] : false;
        $disabled = isset($value[4]) ? (bool)$value[4] : false;
    @endphp
    <label class="m-checkbox m-checkbox--state-success">
        <input type="checkbox"
               value="{{ $currentValue }}"
               {{ $selected ? 'checked' : '' }}
               name="{{ $name }}" {{ $disabled ? 'disabled' : '' }}>
        {{ $label }}
        <span></span>
    </label>
@endforeach
