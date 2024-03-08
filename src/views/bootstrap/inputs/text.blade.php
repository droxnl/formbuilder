<div class="mb-3">

    @include('components.forms.label', [
        $identifier,
        $label,
        $required ?? false
    ])

    <input
            type="{{ \Droxnl\FormBuilder\Helpers\Constants::TEXT }}"
            class="
        form-control
        @if(isset($addClass)) {{ $addClass }} @endif
        "
            id="{{ $attributes['id'] }}"
            name="{{ $identifier }}"
            @if (isset ($help))
                aria-describedby="{{ $identifier }}"
            @endif

            @if (isset($value))
                value="{{ $value }}"
            @else
                value="{{ old($identifier) }}"
            @endif
    >

    @if (isset ($help))
        <div id="{{ $attributes['id'] }}" class="form-text">{{ $help }}</div>
    @endif
</div>
