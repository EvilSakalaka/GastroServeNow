<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Szakács oldal') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if($groupedItems->isEmpty())
                <div class="bg-white shadow sm:rounded-lg p-6">
                    <p class="text-gray-600">Nincs függőben lévő rendelés.</p>
                </div>
            @else
                @foreach($groupedItems as $tableNumber => $items)
                    <section class="bg-white shadow sm:rounded-lg p-4">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    Asztal: <span class="text-gold-700">{{ $tableNumber }}</span>
                                </h3>
                                <p class="text-sm text-gray-500">Nyitott tételek: {{ $items->count() }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($items as $item)
                                @php
                                    // badge szovegek es szinek
                                    $statusLabels = [
                                        'ordered'   => 'Megrendelve',
                                        'preparing' => 'Előkészítés alatt',
                                        'ready'     => 'Kész',
                                        'served'    => 'Felszolgálva',
                                        'cancelled' => 'Törölve',
                                    ];
                                    // halvány háttér a kartyahoz
                                    $cardBg = [
                                        'ordered'   => 'bg-gray-50',
                                        'preparing' => 'bg-yellow-50',
                                        'ready'     => 'bg-green-50',
                                        'served'    => 'bg-blue-50',
                                        'cancelled' => 'bg-red-50',
                                    ];
                                    // erosebb szinek a badge-hez
                                    $badge = [
                                        'ordered'   => 'bg-gray-100 text-gray-800',
                                        'preparing' => 'bg-yellow-100 text-yellow-800',
                                        'ready'     => 'bg-green-100 text-green-800',
                                        'served'    => 'bg-blue-100 text-blue-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                    $label = $statusLabels[$item->status] ?? ucfirst($item->status);
                                    $bgClass = $cardBg[$item->status] ?? 'bg-white';
                                    $badgeClass = $badge[$item->status] ?? 'bg-gray-100 text-gray-800';
                                @endphp

                                {{-- Form köré megy a kartya, igy az egesz kattinthato--}}
                                <form method="POST" action="{{ route('chef.order-items.update-status', $item) }}">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="w-full text-left p-0 group" aria-label="Frissít {{ $item->product->name ?? 'tétel' }}">
                                        <article class="border rounded-lg p-4 shadow-sm hover:shadow-md transition {{ $bgClass }} group-hover:ring-2 group-hover:ring-gold-200">
                                            <div class="flex items-start justify-between">
                                                <div class="pr-4">
                                                    <h4 class="text-md font-medium text-gray-900">
                                                        {{ $item->product->name ?? 'Ismeretlen' }}
                                                    </h4>
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        Mennyiség: <span class="font-semibold text-gray-700">{{ $item->quantity }}</span>
                                                    </p>
                                                    @if($item->comment)
                                                        <p class="text-sm text-gray-500 mt-1">Megjegyzés: {{ $item->comment }}</p>
                                                    @endif
                                                    @if($item->order)
                                                        <p class="text-xs text-gray-400 mt-2">Rendelés #: {{ $item->order->order_id }}</p>
                                                    @endif
                                                </div>

                                                <div class="text-right flex flex-col items-end">
                                                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded {{ $badgeClass }}">
                                                        {{ $label }}
                                                    </span>
                                                </div>
                                            </div>
                                        </article>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            @endif

        </div>
    </div>
</x-app-layout>
