@props([
    'action' => '',
    'method' => 'POST',
    'update' => null,
    'hasFiles' => false,
])

<form action="{{ $action }}" method="{{ in_array(strtoupper($method), ['GET', 'POST']) ? $method : 'POST' }}"
    @if ($hasFiles) enctype="multipart/form-data" @endif>
    @csrf

    {{-- Support PUT, PATCH, DELETE --}}
    @if (!in_array(strtoupper($method), ['GET', 'POST']))
        @method($method)
    @endif

    {{-- Hidden id for update --}}
    @if ($update)
        <input type="hidden" name="id" value="{{ is_object($update) ? $update->id : $update }}">
    @endif

    {{ $slot }}
</form>
