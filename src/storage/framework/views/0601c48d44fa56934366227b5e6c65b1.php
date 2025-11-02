
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
            <?php echo e(__('Asztalok Kezelése')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-cover bg-center min-h-screen" style="background-image: url('<?php echo e(asset('images/main_img.png')); ?>')">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <?php if(session('status')): ?>
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-md">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            
            <?php if($errors->any()): ?>
                <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg shadow-md">
                    <ul class="list-disc list-inside">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="bg-white shadow-xl sm:rounded-lg">
                
                <table class="min-w-full divide-y divide-gray-200">
                    
                    <thead class="bg-gold-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gold-700 uppercase tracking-wider sm:rounded-tl-lg">
                                Asztal
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gold-700 uppercase tracking-wider">
                                Leírás
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gold-700 uppercase tracking-wider">
                                Státusz
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gold-700 uppercase tracking-wider sm:rounded-tr-lg">
                                Művelet
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        <?php $__empty_1 = true; $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                
                                <td class="px-6 py-4 whitespace-nowrap <?php if($loop->last): ?> sm:rounded-bl-lg <?php endif; ?>">
                                    <div class="text-sm font-medium text-gray-900">
                                        <?php echo e($table->table_number); ?>

                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700">
                                        <?php echo e($table->location_description ?? 'Nincs leírás'); ?>

                                    </div>
                                </td>
                                
                                <td class="px-6 py-4 whitespace-nowrap text-xs">
                                    <?php switch($table->status):
                                        case ('available'): ?>
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-green-100 text-green-800">
                                                Szabad
                                            </span>
                                            <?php break; ?>
                                        <?php case ('occupied'): ?>
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-red-100 text-red-800">
                                                Foglalt
                                            </span>
                                            <?php break; ?>
                                        <?php case ('reserved'): ?>
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Foglalva
                                            </span>
                                            <?php break; ?>
                                        <?php case ('out_of_service'): ?>
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-gray-200 text-gray-800">
                                                Szervizen kívül
                                            </span>
                                            <?php break; ?>
                                    <?php endswitch; ?>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium <?php if($loop->last): ?> sm:rounded-br-lg <?php endif; ?>">
    
                                    <div x-data="{ open: false }" class="relative inline-block text-left">
                                        
                                        <button @click="open = !open" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold-500" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                            Művelet
                                            <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                
                                        <div 
                                            x-show="open" 
                                            @click.away="open = false"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="transform opacity-0 scale-95"
                                            x-transition:enter-end="transform opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="transform opacity-100 scale-100"
                                            x-transition:leave-end="transform opacity-0 scale-95"
                                            class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10" 
                                            role="menu" 
                                            aria-orientation="vertical" 
                                            aria-labelledby="menu-button" 
                                            tabindex="-1"
                                            style="display: none;"
                                        >
                                            <div class="py-1" role="none">
                                                
                                                <?php if($table->status !== 'occupied'): ?>
                                                <form method="POST" action="<?php echo e(route('waiter.tables.makeOccupied', $table)); ?>" role="menuitem" tabindex="-1">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <button type_ ="submit" class="text-gray-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                                        Felszolgálás (Foglalt)
                                                    </button>
                                                </form>
                                                <?php endif; ?>
                                
                                                <?php if($table->status !== 'reserved'): ?>
                                                <form method="POST" action="<?php echo e(route('waiter.tables.makeReserved', $table)); ?>" role="menuitem" tabindex="-1">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <button type="submit" class="text-yellow-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                                        Foglalás (Lefoglalva)
                                                    </button>
                                                </form>
                                                <?php endif; ?>
                                                
                                                <?php if($table->status !== 'available'): ?>
                                                <form method="POST" action="<?php echo e(route('waiter.tables.makeAvailable', $table)); ?>" role="menuitem" tabindex="-1">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <button type="submit" class="text-green-700 block w-full text-left px-4 py-2 text-sm hover:bg-gray-100">
                                                        Szabaddá tesz
                                                    </button>
                                                </form>
                                                <?php endif; ?>
                                
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500 sm:rounded-b-lg">
                                    Jelenleg nincsenek asztalok a rendszerben.
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>

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
<?php endif; ?><?php /**PATH C:\Users\Balint\AFP\GastroServeNow\src\resources\views/waiter/dashboard.blade.php ENDPATH**/ ?>