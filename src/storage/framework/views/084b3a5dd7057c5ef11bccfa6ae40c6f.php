
<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gold-700 leading-tight">
            Új rendelés felvétele (<?php echo e($guest_session->table_number); ?>. asztal)
        </h2>
     <?php $__env->endSlot(); ?>

    <div 
        class="py-12"
        x-data="{ 
            tab: 'food',
            cart: [],
            tipPercent: 0,
            isModalOpen: false,
            selectedProduct: { name: '', allergens: [] },
            openModal(product) {
                this.selectedProduct = product;
                this.isModalOpen = true;
            },
            closeModal() {
                this.isModalOpen = false;
                setTimeout(() => { this.selectedProduct = { name: '', allergens: [] }; }, 300);
            },
            // ... (A többi Alpine.js funkció változatlan) ...
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
            get subtotal() {
                return this.cart.reduce((total, item) => total + (item.price * item.quantity), 0);
            },
            get tipAmount() {
                const tip = parseFloat(this.tipPercent) || 0;
                return this.subtotal * (tip / 100);
            },
            get totalAmount() {
                return this.subtotal + this.tipAmount;
            }
        }"
    >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
                
                <form method="POST" action="<?php echo e(route('waiter.orders.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="guest_session_id" value="<?php echo e($guest_session->session_id); ?>">
                    <input type="hidden" name="cart_json" x-bind:value="JSON.stringify(cart)">
                    <input type="hidden" name="total_amount" x-bind:value="totalAmount">
                    <input type="hidden" name="tip_percent" x-bind:value="tipPercent">

                    
                    <div class="border-b border-gray-200 bg-gold-50">
                        <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
                            <button type="button" @click="tab = 'food'" :class="{ 'border-gold-500 text-gold-700': tab === 'food', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'food' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Ételek</button>
                            <button type="button" @click="tab = 'drinks'" :class="{ 'border-gold-500 text-gold-700': tab === 'drinks', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'drinks' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Italok</button>
                            <button type="button" @click="tab = 'summary'" :class="{ 'border-gold-500 text-gold-700': tab === 'summary', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'summary' }" class="ml-auto whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                                Összesítő 
                                <span x-show="cart.length > 0" x-text="cart.length" class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"></span>
                            </button>
                        </nav>
                    </div>

                    
                    <div class="p-6">
                        
                        
                        <div x-show="tab === 'food'">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Ételek</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <?php $__currentLoopData = $food; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 
                                    <?php
                                      
                                        $product->load('allergens');
                                    ?>
                                  
                                    <div class="border rounded-lg p-4 flex justify-between items-center">
                                        <div class="flex items-center space-x-2">
                                            
                                            <button type="button" @click="openModal(<?php echo e(json_encode($product)); ?>)" class="flex-shrink-0 w-6 h-6 rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 flex items-center justify-center font-bold text-sm">i</button>
                                            <div>
                                                <div class="font-medium"><?php echo e($product->name); ?></div>
                                                <div class="text-sm text-gray-600"><?php echo e($product->price); ?> Ft</div>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="ml-4 flex items-center space-x-2">
                                            <button type="button" x-show="getQuantity(<?php echo e($product->product_id); ?>) > 0" @click="removeFromCart(<?php echo e($product->product_id); ?>)" class="bg-gold-500 text-white w-8 h-8 rounded-full text-lg font-bold hover:bg-gold-700">-</button>
                                            <span x-show="getQuantity(<?php echo e($product->product_id); ?>) > 0" x-text="getQuantity(<?php echo e($product->product_id); ?>)" class="w-8 text-center font-medium text-lg text-gold-700"></span>
                                            <button type="button" @click="addToCart(<?php echo e(json_encode($product)); ?>)" class="bg-gold-500 text-white w-8 h-8 rounded-full text-lg font-bold hover:bg-gold-700">+</button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        
                        
                        <div x-show="tab === 'drinks'" style="display: none;">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Italok</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <?php $__currentLoopData = $drinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    
                                    <?php
                                        $product->load('allergens');
                                    ?>
                                   

                                <div class="border rounded-lg p-4 flex justify-between items-center">
                                    <div class="flex items-center space-x-2">
                                
                                        <button type="button" @click="openModal(<?php echo e(json_encode($product)); ?>)" class="flex-shrink-0 w-6 h-6 rounded-full bg-gray-200 text-gray-600 hover:bg-gray-300 flex items-center justify-center font-bold text-sm">i</button>
                                        <div>
                                            <div class="font-medium"><?php echo e($product->name); ?></div>
                                            <div class="text-sm text-gray-600"><?php echo e($product->price); ?> Ft</div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="ml-4 flex items-center space-x-2">
                                        <button type="button" x-show="getQuantity(<?php echo e($product->product_id); ?>) > 0" @click="removeFromCart(<?php echo e($product->product_id); ?>)" class="bg-gold-500 text-white w-8 h-8 rounded-full text-lg font-bold hover:bg-gold-700">-</button>
                                        <span x-show="getQuantity(<?php echo e($product->product_id); ?>) > 0" x-text="getQuantity(<?php echo e($product->product_id); ?>)" class="w-8 text-center font-medium text-lg text-gold-700"></span>
                                        <button type="button" @click="addToCart(<?php echo e(json_encode($product)); ?>)" class="bg-gold-500 text-white w-8 h-8 rounded-full text-lg font-bold hover:bg-gold-700">+</button>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        
                        <div x-show="tab === 'summary'" style="display: none;">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Kosár összesítése</h3>
                            
                            <div x-show="cart.length === 0" class="text-gray-500 text-center py-8">
                                A kosár jelenleg üres.
                            </div>

                            <div x-show="cart.length > 0">
                                <ul role="list" class="divide-y divide-gray-200">
                                    <template x-for="item in cart" :key="item.id">
                                        <li class="py-4 flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <button type="button" @click="deleteItem(item.id)" class="text-red-500 hover:text-red-700 font-bold text-lg">&times;</button>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate" x-text="item.name"></p>
                                                <p class="text-sm text-gray-500 truncate" x-text="item.price + ' Ft'"></p>
                                                <input type="text" x-model="item.comment" placeholder="Megjegyzés (pl. laktózmentes)" class="mt-1 block w-full text-xs border-gray-300 rounded-md shadow-sm">
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <button type="button" @click="removeFromCart(item.id)" class="bg-gold-500 text-white px-2 py-1 rounded-md hover:bg-gold-700">-</button>
                                                <span x-text="item.quantity" class="w-8 text-center font-medium text-gold-700"></span>
                                                <button type="button" @click="addToCart({product_id: item.id})" class="bg-gold-500 text-white px-2 py-1 rounded-md hover:bg-gold-700">+</button>
                                            </div>
                                            <div class="text-sm font-medium text-gray-900 w-20 text-right" x-text="(item.price * item.quantity) + ' Ft'">
                                            </div>
                                        </li>
                                    </template>
                                </ul>

                                
                                <div class="mt-8 border-t border-gray-200 pt-6">
                                    <div class="flex justify-between text-sm text-gray-600">
                                        <p>Részösszeg</p>
                                        <p class="font-medium" x-text="subtotal + ' Ft'"></p>
                                    </div>
                                    <div class="flex justify-between items-center text-sm text-gray-600 mt-2">
                                        <p>Borravaló (%)</p>
                                        <input type="number" x-model.number="tipPercent" min="0" max="100" class="w-24 border-gray-300 rounded-md shadow-sm text-right">
                                    </div>
                                    <div class="flex justify-between text-sm text-gray-600 mt-2">
                                        <p>Borravaló (Ft)</p>
                                        <p class="font-medium" x-text="tipAmount.toFixed(0) + ' Ft'"></p>
                                    </div>
                                    <div class="flex justify-between text-lg font-bold text-gray-900 mt-4">
                                        <p>Végösszeg</p>
                                        <p x-text="totalAmount.toFixed(0) + ' Ft'"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    
                    <div class="bg-gray-50 px-6 py-4 flex justify-end">
                        <a href="<?php echo e(route('waiter.dashboard')); ?>" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Mégse
                        </a>
                        <button 
                            type="submit" 
                            x-show="tab === 'summary' && cart.length > 0"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700">
                            Rendelés leadása
                        </button>
                        <button 
                            type="button" 
                            x-show="tab !== 'summary'"
                            @click="tab = 'summary'"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gold-500 hover:bg-gold-700">
                            Tovább az összesítőhöz
                        </button>
                    </div>

                </form>

            </div>
        </div>
        <div 
            x-show="isModalOpen" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed z-10 inset-0 overflow-y-auto" 
            aria-labelledby="modal-title" 
            role="dialog" 
            aria-modal="true"
            style="display: none;"
        >
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                
                <div x-show="isModalOpen" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                     @click="closeModal()" 
                     aria-hidden="true">
                </div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div 
                    x-show="isModalOpen"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
                >
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-gold-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-gold-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title" x-text="selectedProduct.name">
                                    Termék neve
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">A termékben található allergének:</p>
                                    
                                    
                                    <ul x-show="selectedProduct.allergens.length > 0" class="list-disc list-inside mt-2 text-gray-700">
                                        <template x-for="allergen in selectedProduct.allergens" :key="allergen.allergen_id">
                                            <li x-text="allergen.name"></li>
                                        </template>
                                    </ul>
                                    
                                    
                                    <p x-show="selectedProduct.allergens.length === 0" class="mt-2 text-gray-700 italic">
                                        Nincs megadott allergén ehhez a termékhez.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="button" @click="closeModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            Bezárás
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div> 
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\Balint\AFP\GastroServeNow\src\resources\views/waiter/orders/create.blade.php ENDPATH**/ ?>