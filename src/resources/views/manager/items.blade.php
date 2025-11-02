{{-- /views/manager/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager oldal') }}
        </h2>
    </x-slot>
    @include('manager.partials.sidebar')
    <div>Items Content</div>
    <form id="add_form" action="{{ route("manager.add_worker") }}" style="display: block">
            <h3>Új étel hozzáadása</h3>
            <label for="name">Név:</label>
            <input type="text" id="name" name="name" required>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="role">Beosztás:</label>
            <input type="text" id="role" name="role" required>
            <button type="submit">Hozzáadás</button> 
        </form>
</x-app-layout>