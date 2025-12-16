@props(['url' => '', 'update' => ''])

<div class="flex flex-row justify-center items-center gap-5">
    @empty($update)
        <button type="reset" class="btn btn-danger w-full">Clear</button>
    @else
        <a href="{{ route($url ?? '') }}" class="btn btn-danger w-full text-center">Clear</a>
    @endempty
    <button type="submit" class="btn btn-success w-full">{{ $update ? 'Update' : 'Save' }}</button>
</div>
