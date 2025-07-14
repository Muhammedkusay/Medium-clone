@props(['disabled' => false])

<textarea @disabled($disabled) {{ $attributes->merge(['class' => 'resize-y min-h-24 md:min-h-64 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
{{ $slot }}</textarea>