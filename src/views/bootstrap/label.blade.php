<label for="{{ $identifier }}" class="form-label">
    {{ $label }}

    @if ($required ?? false)
        <span class="text-danger">*</span>
    @endif
</label>
