@props(['value'])

<label style="margin-top:10px;" {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-700']) }} for="formFile" class="form-label">
    {{ $value ?? $slot }}
</label>
