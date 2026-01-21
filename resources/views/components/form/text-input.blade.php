<div class="{{ $colSpan }}">
    <div class="form-group">
        <label class="control-label" for="{{ $name }}">
            @if($required)
                <span class="text-danger">*</span>
            @endif
            {{ $labelCaption }}
        </label>

        <input
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name) }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => 'form-control ' 
                    . $extraClass . " "
                    . ($errors->has($name) ? 'is-invalid' : '')
                ]) 
            }}
        />

        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>