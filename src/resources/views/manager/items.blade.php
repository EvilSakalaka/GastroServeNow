{{-- /views/manager/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager oldal') }}
        </h2>
    </x-slot>
    @include('manager.partials.sidebar')
    <button id="addProductButton" class="bg-yellow-500 text-white px-2 py-1 rounded mr-2">Hozzáadás</button>

    <table class="mt-6 w-full border border-gray-300 rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2">Név</th>
                <th class="px-4 py-2">Kategória</th>
                <th class="px-4 py-2">Ár</th>
                <th class="px-4 py-2">Státusz</th> 
                <th class="px-4 py-2">Hely</th>
                <th class="px-4 py-2">Kép</th>
                <th class="px-4 py-2">Műveletek</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr class="border-t {{ $product->is_featured ? 'bg-blue-100' : '' }}">
                <td class="px-4 py-2">{{ $product->name }}</td>
                <td class="px-4 py-2">{{ $product->category }}</td>
                <td class="px-4 py-2">{{ $product->price }}</td>
                <td class="px-4 py-2">{{ $product->status }}</td>
                <td class="px-4 py-2">{{ $product->area->name ?? 'N/A' }}</td>
                <td class="px-4 py-2">
                    @if ($product->photo_url)
                        <img src="{{ $product->photo_url }}" alt="{{ $product->name }}" class="h-12 w-12 object-cover rounded">
                    @else
                        N/A
                    @endif
                </td>
                <td class="px-4 py-2">
                    <button class="bg-yellow-500 text-white px-2 py-1 rounded mr-2" 
                        onclick="editProduct( {{ $product->product_id }}, '{{ $product->name }}', '{{ $product->category }}', {{ $product->price }}, '{{ $product->status }}', '{{ $product->photo_url }}', {{ $product->is_featured }}, {{ $product->area->area_id }},  @json($product->allergens->pluck('allergen_id')))">Szerkesztés</button>
                    <button class="bg-red-500 text-white px-2 py-1 rounded" onclick="deleteProduct({{ $product->product_id }}, '{{ $product->name }}')">Törlés</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal overlay -->
    <div id="add_product_form_overlay" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative" style="max-height:80vh; overflow-y:auto;">
            <h3 class="text-lg font-bold mb-4">Termék hozzáadása</h3>
            <form id="add_product_form" method="post" action="{{ route('manager.add_product') }}">
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
                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Név:</label>
                    <input type="text" id="name" name="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategória:</label>
                    <input type="text" id="category" name="category" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('category') }}">
                </div>
                <div class="mb-3">
                    <label for="price" class="block text-sm font-medium text-gray-700">Ár:</label>
                    <input type="number" step="0.01" id="price" name="price" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('price') }}">
                </div>
                <div class="mb-3">
                    <label for="status" class="block text-sm font-medium text-gray-700">Státusz:</label>
                    <select id="status" name="status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Elérhető</option>
                        <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Nem elérhető</option>
                        <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archivált</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="photo_url" class="block text-sm font-medium text-gray-700">Fotó URL:</label>
                    <input type="text" id="photo_url" name="photo_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('photo_url') }}">
                </div>
                <div class="mb-3">
                    <label for="is_featured" class="block text-sm font-medium text-gray-700">Kiemelt:</label>
                    <input type="checkbox" id="is_featured" name="is_featured" value="1" class="form-checkbox text-blue-600" {{ old('is_featured') ? 'checked' : '' }}>
                </div>
                <div class="mb-3">
                    <label for="area_id">Terület (area_id):</label>
                    <select id="area_id" name="area_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Válassz területet --</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->area_id }}" {{ old('area_id') == $area->area_id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Allergének:</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($allergens as $allergen)
                            <label class="flex items-center">
                                <input type="checkbox" name="allergens[]" value="{{ $allergen->allergen_id }}" class="form-checkbox text-blue-600" {{ (is_array(old('allergens')) && in_array($allergen->allergen_id, old('allergens'))) ? 'checked' : '' }}>
                                <span class="ml-2">{{ $allergen->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button id="add_product_form_hide" type="button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Mégse</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mentés</button>
                </div>
            </form>
        </div>
    </div>

    <div id="edit_product_form_overlay" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative" style="max-height:80vh; overflow-y:auto;">
            <h3 class="text-lg font-bold mb-4">Termék szerkesztése</h3>
            <form id="edit_product_form" action="{{ route('manager.edit_product') }}" method="post">
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
                <input id="product_id" type="hidden" name="product_id" value="{{ old('product_id') }}">
                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Név:</label>
                    <input type="text" id="name" name="name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategória:</label>
                    <input type="text" id="category" name="category" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('category') }}">
                </div>
                <div class="mb-3">
                    <label for="price" class="block text-sm font-medium text-gray-700">Ár:</label>
                    <input type="number" step="0.01" id="price" name="price" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('price') }}">
                </div>
                <div class="mb-3">
                    <label for="status" class="block text-sm font-medium text-gray-700">Státusz:</label>
                    <select id="status" name="status" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Elérhető</option>
                        <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Nem elérhető</option>
                        <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archivált</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="photo_url" class="block text-sm font-medium text-gray-700">Fotó URL:</label>
                    <input type="text" id="photo_url" name="photo_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ old('photo_url') }}">
                </div>
                <div class="mb-3">
                    <label for="is_featured" class="block text-sm font-medium text-gray-700">Kiemelt:</label>
                    <input type="checkbox" id="is_featured" name="is_featured" value="1" class="form-checkbox text-blue-600" {{ old('is_featured') ? 'checked' : '' }}>
                </div>
                <div class="mb-3">
                    <label for="area_id">Terület (area_id):</label>
                    <select id="area_id" name="area_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Válassz területet --</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->area_id }}" {{ old('area_id') == $area->area_id ? 'selected' : '' }}>{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Allergének:</label>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach($allergens as $allergen)
                            <label class="flex items-center">
                                <input id="Allergen-{{ $allergen->allergen_id }}" type="checkbox" name="allergens[]" value="{{ $allergen->allergen_id }}" class="form-checkbox text-blue-600" {{ (is_array(old('allergens')) && in_array($allergen->allergen_id, old('allergens'))) ? 'checked' : '' }}>
                                <span class="ml-2">{{ $allergen->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-4">
                    <button id="edit_product_form_hide" type="button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Mégse</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Mentés</button>
                </div>
            </form>
        </div>
    </div>

    <div id="delete_product_form_overlay" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
            <!-- Modal box -->
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
                <h3 class="text-lg font-bold mb-4">Termék törlése</h3>
                <form id="delete_product_form" method="post" action="{{ route('manager.delete_product') }}">
                    @csrf
                    <input id="product_id" type="hidden" name="product_id" value="">
                    <div class="mb-3">
                        Biztos törölni szeretnéd <span id="delete_product_name"></span> dolgozót?
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <button id="delete_product_form_hide" type="button" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-red-600">Mégse</button>
                        <button type="submit" class=" bg-red-500 text-white px-4 py-2 rounded hover:bg-blue-700">Törlés</button>
                    </div>
                </form>
            </div>
        </div>
</x-app-layout>