<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Leave Details</h2>
            <a href="/leaves" class="text-sm text-indigo-600 hover:underline">← Back to Leaves</a>
        </div>
    </x-slot>
    <div class="py-12 max-w-2xl mx-auto px-4 space-y-6">

    {{-- Leave card --}}
    <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">

        <div class="bg-indigo-600 px-6 py-5">
            <h3 class="text-white text-lg font-semibold">{{ $leave->user->name }}</h3>
            <p class="text-indigo-100 text-sm">Leave #{{ $leave->id }}</p>
        </div>

        <div class="p-6 space-y-4">
            <div>
                <p class="text-xs uppercase text-gray-400">Name</p>
                <p class="text-gray-800">{{ $leave->user->name }}</p>
            </div>
            
            <div>
                <p class="text-xs uppercase text-gray-400">Start Date</p>
                <p class="text-gray-800">{{ $leave->start_date }}</p>
            </div>
            <div>
                <p class="text-xs uppercase text-gray-400">End Date</p>
                <p class="text-gray-800">{{ $leave->end_date }}</p>
            </div>
            <div>
                <p class="text-xs uppercase text-gray-400">Reason</p>
                <p class="text-gray-800">{{ $leave->reason }}</p>
            </div>
            <div>
                <p class="text-xs uppercase text-gray-400">status</p>
                <p class="text-gray-800">{{ $leave->status }}</p>
            </div>
        </div>

        <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t border-gray-100">
            <a href="/leave/{{ $leave->id }}/edit" class="text-emerald-600 hover:underline text-sm">Edit</a>
            <form action="/leave/{{ $leave->id }}" method="POST" onsubmit="return confirm('Delete this client?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
            </form>
        </div>
    </div>

    

</div>

    
</x-app-layout>