<div class="{{ $colSpan }}">
    <div class="form-group">
        <label class="control-label" for="{{ $name }}">
            @if($required)
                <span class="text-danger">*</span>
            @endif
            {{ $labelCaption }}
        </label>

        <select
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-control"
        >
            @foreach($options as $key => $value)
                <option
                    value="{{ $key }}"
                    {{ old($name, $selectedData) == $key ? 'selected' : '' }}
                >
                    {{ $value }}
                </option>
            @endforeach
        </select>
    </div>
</div>