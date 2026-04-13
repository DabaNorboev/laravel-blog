@props(['href' => null, 'value' => '']) {{-- Проверяем, передана ли ссылка --}}

@php
    // Если есть href — это ссылка, иначе — кнопка
    $tag = $href ? 'a' : 'button';

    $classes = 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-normal text-base text-white hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150';
@endphp

<{{ $tag }} {{ $href ? 'href='.$href : 'type=submit' }} {{ $attributes->merge(['class' => $classes]) }}>
{{ $value ?: $slot }}
</{{ $tag }}>
