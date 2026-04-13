@props(['href' => null, 'value' => '']) {{-- Проверяем, передана ли ссылка --}}

@php
    // Если есть href — это ссылка, иначе — кнопка
    $tag = $href ? 'a' : 'button';

    $classes = 'inline-flex items-center px-4 py-2 bg-white border font-normal border-gray-300 rounded-md text-base text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150';
@endphp

<{{ $tag }} {{ $href ? 'href='.$href : 'type=submit' }} {{ $attributes->merge(['class' => $classes]) }}>
{{ $value ?: $slot }}
</{{ $tag }}>
