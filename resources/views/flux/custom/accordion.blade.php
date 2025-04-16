@props(['data'])

@for($i = 0; $i < count($data); $i++)
    <div class="">
        <button onclick="toggleAccordion({{ $i + 1 }})" class="w-full flex justify-between items-center {{ $i != 0 ? 'pt-3' : '' }}">
            <span>{{ $data[$i]['title'] }}</span>
            {{-- <span>{{ $data[$i]['title'] }}</span> --}}
            <span id="icon-{{ $i + 1 }}" class="transition-transform duration-300">
                {{-- default: plus icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
                    <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
                </svg>
            </span>
        </button>
        <div id="content-{{ $i + 1 }}" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
            <div class="pb-2 text-sm">
                <div class="relative flex flex-col rounded-lg">
                    <nav class="flex flex-col gap-1 p-1.5">
                        @foreach($data[$i]['steps'] as $value)
                            <div role="button" class="flex w-full items-center rounded-md transition-all">
                                <div class="mr-2 grid place-items-center">
                                    {{ $loop->iteration }}.
                                </div>
                                <div>
                                    <h6>{!! $value !!}</h6>
                                </div>
                            </div>
                        @endforeach
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endfor

<script>
    function toggleAccordion(index) {
    const content = document.getElementById(`content-${index}`);
    const icon = document.getElementById(`icon-${index}`);

    // SVG for Minus icon
    const minusSVG = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
        <path d="M3.75 7.25a.75.75 0 0 0 0 1.5h8.5a.75.75 0 0 0 0-1.5h-8.5Z" />
        </svg>
    `;

    // SVG for Plus icon
    const plusSVG = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
        <path d="M8.75 3.75a.75.75 0 0 0-1.5 0v3.5h-3.5a.75.75 0 0 0 0 1.5h3.5v3.5a.75.75 0 0 0 1.5 0v-3.5h3.5a.75.75 0 0 0 0-1.5h-3.5v-3.5Z" />
        </svg>
    `;

    // Toggle the content's max-height for smooth opening and closing
    if (content.style.maxHeight && content.style.maxHeight !== '0px') {
        content.style.maxHeight = '0';
        icon.innerHTML = plusSVG;
    } else {
        content.style.maxHeight = content.scrollHeight + 'px';
        icon.innerHTML = minusSVG;
    }
    }
</script>
