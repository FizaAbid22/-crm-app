<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Deal Details</h2>
            <a href="/deals" class="text-sm text-indigo-600 hover:underline">← Back to Deals</a>
        </div>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto px-4" x-data="{ activeTab: 'overview' }"> 
 
 {{-- Overview tab --}}

        <div x-show="activeTab === 'overview'">
            <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">

                <div class="bg-indigo-600 px-6 py-5">
                    <h3 class="text-white text-lg font-semibold">{{$lead->name }}</h3>
                    <p class="text-indigo-100 text-sm">Lead #{{$lead->id }}</p>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs uppercase text-gray-400">name</p>
                        <p class="text-gray-800">{{ $lead->name }}</p>
                    </div>
                    <div>
                       <span class="@if($lead->status == 'Won') bg-green-100 text-green-700
                        @elseif($lead->status == 'Lost') bg-red-100 text-red-700
                        @elseif($lead->status == 'Intersted') bg-amber-100 text-amber-700
                        @else bg-gray-100 text-gray-700
                        @endif px-2 py-1 rounded-full text-xs font-medium">
                        {{$lead->status }}
                    </span>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-400">Email</p>
                        <p class="text-gray-800">{{ $lead->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-400">Phone</p>
                        <p class="text-gray-800">{{ $lead->phone }}</p>
                    </div>
                    
                </div>

                <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t border-gray-100">
                    <a href="/leads/{{ $lead->id }}/edit" class="text-emerald-600 hover:underline text-sm">Edit</a>
                    <form action="/leads/{{ $lead->id }}" method="POST" onsubmit="return confirm('Delete this deal?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>

        </div>
</x-app-layout>