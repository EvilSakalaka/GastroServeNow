<x-app-layout>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gold-700 leading-tight">
            Újabb tétel hozzáadása ({{ $order->guestSession->table_number }}. asztal)
        </h2>
    </x-slot>

    <div class="py-12" x-data="orderData()" x-init="init()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
                
                {{-- Aktuális rendelés --}}
                <div class="p-6 border-b border-gray-200 bg-blue-50">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktuális rendelés:</h3>
                    <ul class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <li class="py-2 flex justify-between">
                                <span class="text-sm text-gray-700">
                                    {{ $item->product->name }} ({{ $item->quantity }} x)
                                </span>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ number_format($item->unit_price * $item->quantity, 0) }} Ft
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <form method="POST" action="{{ route('waiter.orders.store-add-item', $order) }}">
                    @csrf
                    <input type="hidden" name="cart_json" x-bind:value="JSON.stringify(cart)">
                    <input type="hidden" name="total_additional" x-bind:value="subtotal">

                    {{-- FÜLEK + ALLERGÉN SZŰRŐ --}}
                    <div class="border-b border-gray-200 bg-gold-50">
                        <div class="flex justify-between items-center px-6">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <button type="button" @click="tab = 'food'" :class="{ 'border-gold-500 text-gold-700': tab === 'food', 'border-transparent text-gray-500': tab !== 'food' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Ételek</button>
                                <button type="button" @click="tab = 'drinks'" :class="{ 'border-gold-500 text-gold-700': tab === 'drinks', 'border-transparent text-gray-500': tab !== 'drinks' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Italok</button>
                                <button type="button" @click="tab = 'summary'" :class="{ 'border-gold-500 text-gold-700': tab === 'summary', 'border-transparent text-gray-500': tab !== 'summary' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                    Új tételek 
                                    <span x-show="cart.length > 0" x-text="cart.length" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"></span>
                                </button>
                            </nav>
                            
                            {{-- ALLERGÉN SZŰRŐ GOMB - CSAK ÉTELEK ÉS ITALOK FÜLEKNÉL --}}
                        <button type="button" x-show="tab !== 'summary'" @click="openDropdown = !openDropdown" class="flex items-center gap-1 px-3 py-2 text-sm bg-white border border-gray-300 rounded hover:border-gold-500 hover:text-gold-700 transition">
                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            <span class="text-xs" x-text="selectedAllergens.length === 0 ? 'Szűrő' : selectedAllergens.length"></span>
                        </button>
                        </div>
                    </div>

                    {{-- DROPDOWN LISTA - FIXED POSITIONED --}}
                    <div x-show="openDropdown" @click.away="openDropdown = false" 
                        class="fixed bg-white border border-gray-300 rounded shadow-2xl z-50 w-56 max-h-96 overflow-y-auto"
                        style="top: 150px; right: 20px;">
                        <div class="p-2">
                            @foreach($allergens as $allergen)
                                <label class="flex items-center gap-2 text-sm py-2 px-2 rounded cursor-pointer hover:bg-gold-50 transition">
                                    <input type="checkbox" 
                                        :checked="selectedAllergens.includes({{ $allergen->allergen_id }})"
                                        @change="
                                            if ($event.target.checked) {
                                                if (!selectedAllergens.includes({{ $allergen->allergen_id }})) {
                                                    selectedAllergens.push({{ $allergen->allergen_id }});
                                                }
                                            } else {
                                                selectedAllergens = selectedAllergens.filter(id => id !== {{ $allergen->allergen_id }});
                                            }
                                        "
                                        class="accent-gold-500 w-4 h-4">
                                    <span class="text-gray-700">{{ $allergen->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-6">
                        {{-- Ételek fül --}}
                        <div x-show="tab === 'food'">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Ételek</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <template x-for="product in filteredFood()" :key="product.product_id">
                                    <div class="border rounded-lg p-4 flex justify-between items-center hover:shadow-md transition">
                                        <div class="flex items-center space-x-2 flex-1">
                                            <button type="button" @click="openModal(product)" class="flex-shrink-0 w-6 h-6 rounded-full bg-gold-100 text-gold-600 hover:bg-gold-200 flex items-center justify-center font-bold text-sm transition">i</button>
                                            <div class="flex-1">
                                                <div class="font-medium text-gray-900" x-text="product.name"></div>
                                                <div class="text-sm text-gray-600" x-text="product.price + ' Ft'"></div>
                                                <div class="mt-1 flex flex-wrap gap-1">
                                                    <template x-if="product.allergens.length > 0">
                                                        <template x-for="a in product.allergens" :key="a.allergen_id">
                                                            <span class="inline-block text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded" x-text="a.name"></span>
                                                        </template>
                                                    </template>
                                                    <span x-show="product.allergens.length === 0" class="text-xs text-green-600"> Allergénmentes</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex items-center space-x-2">
                                            <button type="button" x-show="getQuantity(product.product_id) > 0" @click="removeFromCart(product.product_id)" class="bg-gold-500 text-white w-8 h-8 rounded-full text-lg font-bold hover:bg-gold-700 transition">-</button>
                                            <span x-show="getQuantity(product.product_id) > 0" x-text="getQuantity(product.product_id)" class="w-8 text-center font-medium text-lg text-gold-700"></span>
                                            <button type="button" @click="addToCart(product)" class="bg-gold-500 text-white w-8 h-8 rounded-full text-lg font-bold hover:bg-gold-700 transition">+</button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Italok fül --}}
                        <div x-show="tab === 'drinks'" style="display: none;">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Italok</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <template x-for="product in filteredDrinks()" :key="product.product_id">
                                    <div class="border rounded-lg p-4 flex justify-between items-center hover:shadow-md transition">
                                        <div class="flex items-center space-x-2 flex-1">
                                            <button type="button" @click="openModal(product)" class="flex-shrink-0 w-6 h-6 rounded-full bg-gold-100 text-gold-600 hover:bg-gold-200 flex items-center justify-center font-bold text-sm transition">i</button>
                                            <div class="flex-1">
                                                <div class="font-medium text-gray-900" x-text="product.name"></div>
                                                <div class="text-sm text-gray-600" x-text="product.price + ' Ft'"></div>
                                                <div class="mt-1 flex flex-wrap gap-1">
                                                    <template x-if="product.allergens.length > 0">
                                                        <template x-for="a in product.allergens" :key="a.allergen_id">
                                                            <span class="inline-block text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded" x-text="a.name"></span>
                                                        </template>
                                                    </template>
                                                    <span x-show="product.allergens.length === 0" class="text-xs text-green-600">Allergénmentes</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ml-4 flex items-center space-x-2">
                                            <button type="button" x-show="getQuantity(product.product_id) > 0" @click="removeFromCart(product.product_id)" class="bg-gold-500 text-white w-8 h-8 rounded-full text-lg font-bold hover:bg-gold-700 transition">-</button>
                                            <span x-show="getQuantity(product.product_id) > 0" x-text="getQuantity(product.product_id)" class="w-8 text-center font-medium text-lg text-gold-700"></span>
                                            <button type="button" @click="addToCart(product)" class="bg-gold-500 text-white w-8 h-8 rounded-full text-lg font-bold hover:bg-gold-700 transition">+</button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Összesítő fül --}}
                        <div x-show="tab === 'summary'" style="display: none;">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Új tételek összesítése</h3>
                            <div x-show="cart.length === 0" class="text-gray-500 text-center py-8">
                                Nincs tétel hozzáadva.
                            </div>
                            <div x-show="cart.length > 0">
                                <ul class="divide-y divide-gray-200">
                                    <template x-for="item in cart" :key="item.id">
                                        <li class="py-4 flex items-center justify-between">
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900" x-text="item.name"></p>
                                                <p class="text-sm text-gray-500" x-text="item.price + ' Ft'"></p>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <button type="button" @click="removeFromCart(item.id)" class="bg-gold-500 text-white px-2 py-1 rounded-md hover:bg-gold-700">-</button>
                                                <span x-text="item.quantity" class="w-8 text-center font-medium"></span>
                                                <button type="button" @click="addToCart({product_id: item.id, price: item.price, area_id: item.area_id})" class="bg-gold-500 text-white px-2 py-1 rounded-md hover:bg-gold-700">+</button>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900 w-24 text-right" x-text="(item.price * item.quantity) + ' Ft'"></div>
                                        </li>
                                    </template>
                                </ul>
                                <div class="mt-6 border-t border-gray-200 pt-4">
                                    <div class="flex justify-between text-lg font-bold text-gray-900">
                                        <p>Hozzáadni kívántak:</p>
                                        <p x-text="subtotal.toFixed(0) + ' Ft'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- LÁBLÉC ÉS GOMBOK --}}
                    <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3">
                        <a href="{{ route('waiter.orders.success', $order) }}" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Mégse
                        </a>
                        <button 
                            type="submit" 
                            x-show="tab === 'summary' && cart.length > 0"
                            class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 transition">
                            Tételek hozzáadása
                        </button>
                        <button 
                            type="button" 
                            x-show="tab !== 'summary'"
                            @click="tab = 'summary'"
                            class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gold-500 hover:bg-gold-700 transition">
                            Tovább az összesítőhöz
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- === ALLERGIA MODAL === --}}
        <div x-show="isModalOpen" x-transition class="fixed z-10 inset-0 overflow-y-auto" style="display: none;">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div x-show="isModalOpen" x-transition class="fixed inset-0 bg-gray-500 bg-opacity-75" @click="closeModal()" aria-hidden="true"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div x-show="isModalOpen" x-transition class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-gold-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-gold-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" x-text="selectedProduct.name"></h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 font-semibold">Allergének:</p>
                                    <ul x-show="selectedProduct.allergens && selectedProduct.allergens.length > 0" class="list-disc list-inside mt-2 text-gray-700">
                                        <template x-for="allergen in selectedProduct.allergens" :key="allergen.allergen_id">
                                            <li x-text="allergen.name" class="font-medium text-gold-700"></li>
                                        </template>
                                    </ul>
                                    <p x-show="!selectedProduct.allergens || selectedProduct.allergens.length === 0" class="mt-2 text-green-600 italic font-medium">Nincs allergia</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Bezárás</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function orderData() {
            return {
                tab: 'food',
                cart: [],
                isModalOpen: false,
                selectedProduct: { name: '', allergens: [] },
                selectedAllergens: [],
                openDropdown: false,
                init() {},
                openModal(product) {
                    this.selectedProduct = product;
                    this.isModalOpen = true;
                },
                closeModal() {
                    this.isModalOpen = false;
                    setTimeout(() => { this.selectedProduct = { name: '', allergens: [] }; }, 300);
                },
                addToCart(product) {
                    const existing = this.cart.find(item => item.id === product.product_id);
                    if (existing) {
                        existing.quantity++;
                    } else {
                        this.cart.push({
                            id: product.product_id,
                            name: product.name,
                            price: product.price,
                            quantity: 1,
                            area_id: product.area_id,
                            comment: ''
                        });
                    }
                },
                removeFromCart(productId) {
                    const item = this.cart.find(item => item.id === productId);
                    if (item && item.quantity > 1) {
                        item.quantity--;
                    } else {
                        this.cart = this.cart.filter(item => item.id !== productId);
                    }
                },
                deleteItem(productId) {
                    this.cart = this.cart.filter(item => item.id !== productId);
                },
                getQuantity(productId) {
                    const item = this.cart.find(i => i.id === productId);
                    return item ? item.quantity : 0;
                },
                filteredFood() {
                    const allFood = @json($food);
                    if (this.selectedAllergens.length === 0) return allFood;
                    return allFood.filter(product =>
                        !product.allergens.some(a =>
                            this.selectedAllergens.includes(a.allergen_id)
                        )
                    );
                },
                filteredDrinks() {
                    const allDrinks = @json($drinks);
                    if (this.selectedAllergens.length === 0) return allDrinks;
                    return allDrinks.filter(product =>
                        !product.allergens.some(a =>
                            this.selectedAllergens.includes(a.allergen_id)
                        )
                    );
                },
                get subtotal() {
                    return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
                }
            };
        }
    </script>
</x-app-layout>