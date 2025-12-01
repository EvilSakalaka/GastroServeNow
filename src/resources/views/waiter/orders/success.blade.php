<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gold-700 leading-tight">
            Rendelés megerősítése ({{ $order->guestSession->table_number }}. asztal)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
                
                {{-- Fejléc --}}
                <div class="p-6 border-b-2 border-gold-500 bg-gold-50">
                    <h3 class="text-xl font-bold text-gray-900">Rendelt ételek:</h3>
                </div>

                {{-- Tételek lista --}}
                <div class="divide-y divide-gray-200">
                    @foreach($order->items as $item)
                        <div class="p-6 hover:bg-gray-50 transition">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">
                                        {{ $item->product->name }}
                                    </h4>
                                    <p class="text-sm text-gray-600 mt-1">
                                        {{ $item->quantity }} x {{ number_format($item->unit_price, 0) }} Ft
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-gray-900">
                                        {{ number_format($item->unit_price * $item->quantity, 0) }} Ft
                                    </p>
                                </div>
                            </div>

                            {{-- Allergének --}}
                            @if($item->product->allergens->count() > 0)
                                <div class="mt-3 ml-0">
                                    <p class="text-xs font-semibold text-gray-600 mb-2">Allergének:</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($item->product->allergens as $allergen)
                                            <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full">
                                                {{ $allergen->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="mt-3 ml-0">
                                    <p class="text-xs font-semibold text-green-600 flex items-center gap-1">
                                        ✅ Nincs allergén
                                    </p>
                                </div>
                            @endif

                            {{-- Megjegyzés --}}
                            @if($item->comment)
                                <div class="mt-3 p-3 bg-blue-50 rounded border-l-4 border-blue-500">
                                    <p class="text-sm text-gray-700">
                                        <strong>Megjegyzés:</strong> {{ $item->comment }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Összegzés --}}
                <div class="bg-gray-50 p-6 border-t-2 border-gold-500">
                    <div class="space-y-3">
                        <div class="flex justify-between text-base text-gray-700">
                            <span>Részösszeg:</span>
                            <span class="font-medium">{{ number_format($order->total_amount, 0) }} Ft</span>
                        </div>
                        
                        @if($order->tip_percent && $order->tip_percent > 0)
                            <div class="flex justify-between text-base text-gray-700">
                                <span>Borravaló ({{ $order->tip_percent }}%):</span>
                                <span class="font-medium">
                                    {{ number_format($order->total_amount * ($order->tip_percent / 100), 0) }} Ft
                                </span>
                            </div>
                        @endif

                        <div class="flex justify-between text-xl font-bold text-gray-900 pt-3 border-t border-gray-300">
                            <span>Végösszeg:</span>
                            <span>{{ number_format($order->total_amount, 0) }} Ft</span>
                        </div>
                    </div>
                </div>

                {{-- Műveleti gombok --}}
                <div class="bg-white px-6 py-4 flex justify-between items-center border-t border-gray-200">
                    <a href="{{ route('waiter.orders.payment-request', $order->order_id) }}" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gold-500 hover:bg-gold-700 transition">
                         Fizetés
                     </a>
                    
                    <div class="flex gap-3">
                        <a href="{{ route('waiter.orders.add-item', $order) }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Tétel hozzáadása
                        </a>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
