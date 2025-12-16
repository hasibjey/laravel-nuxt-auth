@props(['breadcrumbs' => []])
<ul class="px-3 py-3 flex flex-row justify-end items-center gap-1">
    @foreach ($breadcrumbs as $key => $url)
        @empty($url)
            <li class="relative after:content-['/'] last:after:content-['']">
                {{ $key }}
            </li>
        @else
            <li class="relative after:content-['/'] last:after:content-['']">
                <a href="{{ $url }}" class="text-blue-500">{{ $key }}</a>
            </li>
        @endempty
    @endforeach

</ul>
