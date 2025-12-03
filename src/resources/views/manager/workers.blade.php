@extends('manager.partials.manager-layout')
@section("manager_content")

    <div>
        <table class="mt-6 w-full border border-gray-300 bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2">Dolgozó Név</th>
                    <th class="px-4 py-2">Felhasználói Név</th>
                    <th class="px-4 py-2">Email cím</th>
                    <th class="px-4 py-2">Beosztás</th>
                    <th class="px-4 py-2">Aktív/Inaktív</th>
                    <th class="px-4 py-2">Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($workers as $worker)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $worker->name }}</td>
                    <td class="px-4 py-2">{{ $worker->username }}</td>
                    <td class="px-4 py-2">{{ $worker->email }}</td>
                    <td class="px-4 py-2">{{ $worker->role }}</td>
                    <td class="px-4 py-2">{{ $worker->status }}</td>
                    <td class="px-4 py-2">
                        <button class="bg-yellow-500 text-white px-2 py-1 rounded mr-2" onclick="editWorker({{ $worker->id }}, '{{ $worker->name }}', '{{ $worker->username }}', '{{ $worker->role }}', '{{ $worker->status }}')">Szerkesztés</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="deleteWorker({{ $worker->id }}, '{{ $worker->name }}')">Törlés</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        

        <div id="edit_form_overlay" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <!-- Modal box -->
            @if ($errors->any() && old('worker_id'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        document.getElementById('edit_form_overlay').classList.remove('hidden');
                    });
                </script>
            @endif
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <h3 class="text-lg font-bold mb-4">Dolgozó Módosítása</h3>
                <form id="edit_form" action="{{ route('manager.edit_worker') }}" method="post">
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-red-600 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <input id="worker_id" type="hidden" name="worker_id" value="{{ old('worker_id') }}">
                    <div class="mb-3">
                        <label for="name" class="block text-sm font-medium text-gray-700">Név:</label>
                        <input type="text" id="name" name="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="block text-sm font-medium text-gray-700">Felhasználói Név::</label>
                        <input type="text" id="username" name="username" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('username') }}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="block text-sm font-medium text-gray-700">Jelszó:</label>
                        <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="block text-sm font-medium text-gray-700">Beosztás:</label>
                        <select id="role" name="role" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="waiter" {{ old('role') == 'waiter' ? 'selected' : '' }}>Pincér</option>
                            <option value="chef" {{ old('role') == 'chef' ? 'selected' : '' }}>Shéf</option>
                            <option value="bartender" {{ old('role') == 'bartender' ? 'selected' : '' }}>Pultos</option>
                            <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Menedzser</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <span class="block text-sm font-medium text-gray-700 mb-1">Státusz:</span>
                        <label class="inline-flex items-center mr-4">
                            <input type="radio" id="status_active" name="status" value="active" class="form-radio text-blue-600" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                            <span class="ml-2">Aktív</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" id="status_inactive" name="status" value="inactive" class="form-radio text-blue-600" {{ old('status') == 'inactive' ? 'checked' : '' }}>
                            <span class="ml-2">Inaktív</span>
                        </label>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button id="edit_form_hide" type="button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Mégse</button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Hozzáadás</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal overlay -->
        <div id="delete_form_overlay" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <!-- Modal box -->
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <h3 class="text-lg font-bold mb-4">Dolgozó törlése</h3>
                <form id="delete_form" method="post" action="{{ route('manager.delete_worker') }}">
                    @csrf
                    <input id="worker_id" type="hidden" name="worker_id" value="">
                    <div class="mb-3">
                        Biztos törölni szeretnéd <span id="delete_worker_name"></span> dolgozót?
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button id="delete_form_hide" type="button" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-red-600">Mégse</button>
                        <button type="submit" class=" bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-700">Törlés</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection