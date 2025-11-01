{{-- /views/waiter/dashboard.blade.php --}}
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-arany-700 leading-tight">
            {{ __('Asztalok Kezelése') }}
        </h2>
    </x-slot>


    <div class="py-12 bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/main_img.png') }}')">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg shadow-md">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white shadow-xl sm:rounded-lg overflow-hidden">
                

                <table class="min-w-full divide-y divide-gray-200">
                    
                    <thead class="bg-arany-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-arany-800 uppercase tracking-wider">
                                Asztal
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-arany-800 uppercase tracking-wider">
                                Leírás
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-arany-800 uppercase tracking-wider">
                                Státusz
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-arany-800 uppercase tracking-wider">
                                Művelet
                            </th>
                        </tr>
                    </thead>
                    
                    <tbody class="bg-white divide-y divide-gray-200">
                        
                        @forelse ($tables as $table)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $table->table_number }}
                                    </div>
                                </td>
                                
                                
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700">
                                        {{ $table->location_description ?? 'Nincs leírás' }}
                                    </div>
                                </td>
                                
                                
                                <td class="px-6 py-4 whitespace-nowrap text-xs">
                                    @switch($table->status)
                                        @case('available')
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-green-100 text-green-800">
                                                Szabad
                                            </span>
                                            @break
                                        @case('occupied')
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-red-100 text-red-800">
                                                Foglalt
                                            </span>
                                            @break
                                        @case('reserved')
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Foglalva
                                            </span>
                                            @break
                                        @case('out_of_service')
                                            <span class="px-3 py-1 inline-flex font-semibold rounded-full bg-gray-200 text-gray-800">
                                                Szervizen kívül
                                            </span>
                                            @break
                                    @endswitch
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    @if ($table->status !== 'available')
                                        
                                        <form method="POST" action="{{ route('waiter.tables.makeAvailable', $table) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-arany-600 hover:text-arany-800 font-medium">
                                                Elérhetővé tesz
                                            </button>
                                        </form>
                                    @else
                                        
                                        <a href="#" class="text-gray-400 cursor-not-allowed" aria-disabled="true">
                                            (Szabad)
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                           
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    Jelenleg nincsenek asztalok a rendszerben.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>

            </div> 
        </div> 
    </div> 
</x-app-layout>