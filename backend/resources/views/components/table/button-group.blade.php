@props(['url' => []])
<div class="btn-group justify-center">
    @if (isset($url['delete']))
        <button type="button" class="btn btn-danger" onclick="destroyItem('{{ $url['delete'] }}')">
            <i class="far fa-trash-alt"></i>
        </button>
    @endif
    @if (isset($url['update']))
        <a href="{{ $url['update'] }}" class="btn btn-info">
            <i class="fas fa-pencil-alt"></i>
        </a>
    @endif

    {{ $slot }}
</div>
