{{-- /views/manager/workers.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager oldal') }}
        </h2>
    </x-slot>
    @include('manager.partials.sidebar')
    <div>
        <button id="add_form_show" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Új dolgozó hozzáadása</button>
        <table class="mt-6 w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Dolgozó Név</th>
                    <th class="px-4 py-2">Beosztás</th>
                    <th class="px-4 py-2">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $worker->name }}</td>
                    <td class="px-4 py-2">{{ $worker->role }}</td>
                    <td class="px-4 py-2">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded mr-2">Szerkesztés</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded">Törlés</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal overlay -->
        <div id="add_form" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <!-- Modal box -->
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <h3 class="text-lg font-bold mb-4">Új dolgozó hozzáadása</h3>
                <form id="add_form" action="{{ route('manager.add_worker') }}">
                    <div class="mb-3">
                        <label for="name" class="block text-sm font-medium text-gray-700">Név:</label>
                        <input type="text" id="name" name="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="block text-sm font-medium text-gray-700">Username:</label>
                        <input type="text" id="username" name="username" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="block text-sm font-medium text-gray-700">Beosztás:</label>
                        <input type="text" id="role" name="role" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button id="add_form_hide" type="button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Mégse</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Hozzáadás</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>