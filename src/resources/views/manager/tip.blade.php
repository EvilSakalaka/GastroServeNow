<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager oldal') }}
        </h2>
    </x-slot>
    @include('manager.partials.sidebar')
    <div>Tip Content</div>
</x-app-layout>