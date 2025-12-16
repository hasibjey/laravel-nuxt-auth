@props(['title' => ''])
@error(strtolower($title))
    <span class="zb-text-error">{{ $message }}</span>
@enderror
