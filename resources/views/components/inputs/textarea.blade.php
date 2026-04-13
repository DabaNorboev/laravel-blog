@props(['value' => ''])
<textarea {{ $attributes->merge(['class' => 'px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none']) }}>{{ $value ?: $slot}}</textarea>
