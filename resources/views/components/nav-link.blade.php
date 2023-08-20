@props(['url','active'])

@php
    $styles = $active ?? false ? 'padding:-25px;' : 'padding:25px;';
@endphp

<a style="margin-left:50px;" href="{{ $url }}">
    {{ $slot }}
</a>
