<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gold-700 leading-tight">
            Rendelés megerősítése ({{ optional($order->guestSession)->table_number }}. asztal)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">

                @if(session('status'))
                    <div class="p-4 bg-green-50 border-l-4 border-green-400 text-green-800">
                        {{ session('status') }}
                    </div>
                @endif

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

                {{-- Fizetési opciók + Fizetés gomb (Alpine komponenshez igazítva) --}}
                <div class="bg-white px-6 py-4 flex justify-between items-center border-t border-gray-200" x-data="paymentData()" x-init="init()">
                    <div class="flex gap-3 items-center">
                        {{-- Fizetési opciók gombjai (kotelezo egyet valasztani) --}}
                        <button type="button" @click="toggle('cash')" :class="buttonClass('cash')" class="payment-option rounded px-4 py-2">Készpénz</button>
                        <button type="button" @click="toggle('card')" :class="buttonClass('card')" class="payment-option rounded px-4 py-2">Bankkártya</button>
                        <button type="button" @click="toggle('szep')" :class="buttonClass('szep')" class="payment-option rounded px-4 py-2">Szép-kártya</button>
                    </div>

                    <div class="flex items-center gap-3">
                        {{-- Fizetes gomb aktiv, ha van kivalasztott fizetes --}}
                        <form id="payment-submit-form" method="POST" action="{{ route('waiter.orders.request-payment', $order) }}">
                            @csrf
                            <input type="hidden" name="payment_method" x-model="selected" />
                            <button id="do-payment-btn" type="submit" :disabled="!selected" :class="submitClass()" class="inline-flex items-center px-4 py-2 rounded">
                                Fizetés
                            </button>
                        </form>

                        {{-- Tetel hozzadasa gomb --}}
                        <a href="{{ route('waiter.orders.add-item', $order) }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                            Tétel hozzáadása
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function paymentData() {
            return {
                selected: null,
                init() {
                    @if(!empty($order->payment_method))
                        this.selected = ($order->payment_method);
                    @endif
                },
                toggle(method) {
                    this.selected = (this.selected === method) ? null : method;
                },
                buttonClass(method) {
                    return [
                        'rounded', 'px-4', 'py-2',
                        (this.selected === method) ? 'bg-green-600 text-white' : 'bg-yellow-300 text-gray-900'
                    ].join(' ');
                },
                submitClass() {
                    return this.selected
                        ? 'inline-flex items-center px-4 py-2 bg-gold-500 text-white hover:bg-gold-700 rounded'
                        : 'inline-flex items-center px-4 py-2 bg-gray-300 text-gray-600 rounded cursor-not-allowed';
                }
            }
        }
    </script>
</x-app-layout>
