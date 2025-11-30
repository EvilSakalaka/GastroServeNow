<x-app-layout>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gold-700 leading-tight">
            Étlapunk
        </h2>
    </x-slot>

    <div class="py-12" x-data="menuData()" x-cloak>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <!-- HEADER SZEKCIÓ -->
            <div class="mb-12 text-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Fedezd fel kulináris kincseinket!</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Friss, ízletes ételek és italok, amelyeket szeretettel készítünk neked. Vendégként is megtekintheted teljes étlapunkat – nincs regisztrációs kötelezettség, csak nyitott szív és tátott száj!
                </p>
            </div>

            <!-- KATEGÓRIA FÜLEK -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="border-b border-gray-200 bg-gold-50">
                    <nav class="flex space-x-1 px-6" aria-label="Tabs">
                        <button 
                            type="button" 
                            @click="activeTab = 'all'" 
                            :class="{ 'border-gold-500 text-gold-700 bg-white': activeTab === 'all', 'border-transparent text-gray-500': activeTab !== 'all' }" 
                            class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm transition">
                            Összes (<span x-text="products.length"></span>)
                        </button>
                        <button 
                            type="button" 
                            @click="activeTab = 'food'" 
                            :class="{ 'border-gold-500 text-gold-700 bg-white': activeTab === 'food', 'border-transparent text-gray-500': activeTab !== 'food' }" 
                            class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm transition">
                            Ételek (<span x-text="food.length"></span>)
                        </button>
                        <button 
                            type="button" 
                            @click="activeTab = 'drinks'" 
                            :class="{ 'border-gold-500 text-gold-700 bg-white': activeTab === 'drinks', 'border-transparent text-gray-500': activeTab !== 'drinks' }" 
                            class="whitespace-nowrap py-4 px-4 border-b-2 font-medium text-sm transition">
                            Italok (<span x-text="drinks.length"></span>)
                        </button>
                    </nav>
                </div>

                <!-- TERMÉKEK GRID -->
                <div class="p-8">
                    
                    <!-- ÖSSZES TERMÉK -->
                    <div x-show="activeTab === 'all'">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <template x-for="product in products" :key="product.product_id">
                                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    <!-- KÉP -->
                                    <div class="relative h-56 bg-gradient-to-br from-gold-50 to-gray-100 overflow-hidden">
                                        <img 
                                            x-show="product.photo_url"
                                            :src="product.photo_url" 
                                            :alt="product.name"
                                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                            loading="lazy">
                                        <div x-show="!product.photo_url" class="flex items-center justify-center w-full h-full">
                                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- TARTALOM -->
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2" x-text="product.name"></h3>
                                        
                                        <!-- KATEGÓRIA -->
                                        <p class="text-sm text-gray-500 mb-3" x-text="product.category"></p>
                                        
                                        <!-- ÁR + KIEMELT BADGE -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <span class="text-2xl font-bold text-gold-600" x-text="Number(product.price).toLocaleString('hu-HU') + ' Ft'"></span>
                                            <template x-if="product.is_featured">
                                                <span class="inline-block px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-semibold">⭐ Kiemelt</span>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- CSAK ÉTELEK -->
                    <div x-show="activeTab === 'food'" style="display: none;">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <template x-for="product in food" :key="product.product_id">
                                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    <div class="relative h-56 bg-gradient-to-br from-orange-50 to-gray-100 overflow-hidden">
                                        <img 
                                            x-show="product.photo_url"
                                            :src="product.photo_url" 
                                            :alt="product.name"
                                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                            loading="lazy">
                                        <div x-show="!product.photo_url" class="flex items-center justify-center w-full h-full">
                                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2" x-text="product.name"></h3>
                                        <p class="text-sm text-gray-500 mb-3" x-text="product.category"></p>
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <span class="text-2xl font-bold text-orange-600" x-text="Number(product.price).toLocaleString('hu-HU') + ' Ft'"></span>
                                            <span class="inline-block px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-semibold">🍽️ Étel</span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- CSAK ITALOK -->
                    <div x-show="activeTab === 'drinks'" style="display: none;">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <template x-for="product in drinks" :key="product.product_id">
                                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                    <div class="relative h-56 bg-gradient-to-br from-blue-50 to-gray-100 overflow-hidden">
                                        <img 
                                            x-show="product.photo_url"
                                            :src="product.photo_url" 
                                            :alt="product.name"
                                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                                            loading="lazy">
                                        <div x-show="!product.photo_url" class="flex items-center justify-center w-full h-full">
                                            <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2" x-text="product.name"></h3>
                                        <p class="text-sm text-gray-500 mb-3" x-text="product.category"></p>
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <span class="text-2xl font-bold text-blue-600" x-text="Number(product.price).toLocaleString('hu-HU') + ' Ft'"></span>
                                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">🥤 Ital</span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- ÜRES ÁLLAPOT -->
                    <div x-show="products.length === 0" class="text-center py-12">
                        <p class="text-gray-500 text-lg">Jelenleg nincs elérhető termék.</p>
                    </div>
                </div>
            </div>

            <!-- FOOTER INFO -->
            <div class="bg-gold-50 rounded-lg p-8 text-center mt-8">
                <p class="text-gray-700 text-lg">
                    📞 <strong>Tetszett valami? Hívj minket vagy foglalj asztalt! Telefonszám: +36 20 456 7892</strong>
                </p>
            </div>
        </div>
    </div>

    <script>
        function menuData() {
            return {
                activeTab: 'all',
                products: @json($products),
                food: @json($food),
                drinks: @json($drinks),
            };
        }
    </script>
</x-app-layout>