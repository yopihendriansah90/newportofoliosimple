@props(['platform'])

@php($platform = strtolower(trim((string) $platform)))

@switch($platform)
    @case('linkedin')
        <x-simpleicon-linkedin {{ $attributes->merge(['class' => 'h-5 w-5']) }} />
        @break
    @case('instagram')
        <x-simpleicon-instagram {{ $attributes->merge(['class' => 'h-5 w-5']) }} />
        @break
    @case('facebook')
        <x-simpleicon-facebook {{ $attributes->merge(['class' => 'h-5 w-5']) }} />
        @break
    @case('github')
        <x-simpleicon-github {{ $attributes->merge(['class' => 'h-5 w-5']) }} />
        @break
    @case('youtube')
        <x-simpleicon-youtube {{ $attributes->merge(['class' => 'h-5 w-5']) }} />
        @break
    @case('whatsapp')
        <x-simpleicon-whatsapp {{ $attributes->merge(['class' => 'h-5 w-5']) }} />
        @break
    @default
        <span {{ $attributes->merge(['class' => 'material-symbols-outlined text-xl']) }}>link</span>
@endswitch
