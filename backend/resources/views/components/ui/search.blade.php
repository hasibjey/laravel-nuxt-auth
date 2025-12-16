@props(['action' => '', 'className' => '!w-52'])
<form action="{{ $action }}" method="get">
    <div class="relative ml-3.5">
        <input type="text" class="form-control form-control-sm !pr-7 {{ $className }}" name="src"
            placeholder="Search items..." value="{{ Request('src') }}">
        <button type="submit" class="absolute top-1/2 right-1.5 -translate-y-1/2 text-gray-600 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
        </button>
        @empty(!Request('src'))
            <a href="{{ url()->current() }}"
                class="clear absolute top-1/2 -left-4 -translate-y-1/2 text-red-600 opacity-50 cursor-pointer transition-all duration-300 hover:opacity-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </a>
        @endempty
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="{{ $action }}"]');
            const input = form.querySelector('input[name="src"]');

            form.addEventListener('submit', function(e) {
                if (input.value.trim() === '') {
                    e.preventDefault();
                    alert('Please enter a search term');
                    input.focus();
                }
            });
        });
    </script>
</form>
