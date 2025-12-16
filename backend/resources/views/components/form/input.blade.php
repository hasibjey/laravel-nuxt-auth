@props([
    'label' => '',
    'name' => '',
    'id' => null,
    'type' => 'text',
    'placeholder' => '',
    'class' => '',
    'value' => '',
])

<div class="form-group">
    @if($label)
        <label for="{{ $id ?? $name }}" class="capitalize">
            {{ ucfirst($label) }}
        </label>
    @endif

    <input
        type="{{ $type }}"
        name="{{ strtolower($name) }}"
        id="{{ $id ?? $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        class="form-control {{ $class }}"
    >

    <x-form-error :title="strtolower($name)" />
</div>
