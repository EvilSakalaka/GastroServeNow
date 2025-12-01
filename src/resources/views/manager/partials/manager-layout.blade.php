<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager oldal') }}
        </h2>
    </x-slot>
    <div class="flex flex-row w-full gap-3" style="background-image: url('/images/main_img.png'); background-size: cover; min-height: calc(100vh - 9rem);">
        <div class="h-full min-h-[calc(100vh-9rem)]">
            @include('manager.partials.sidebar')
        </div>
        <div class="flex-1 h-full min-h-[calc(100vh-9rem)] overflow-auto">
            @yield('manager_content')
        </div>
    </div>
</x-app-layout>