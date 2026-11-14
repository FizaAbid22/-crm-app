<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">TimeLogs Details</h2>
            <a href="/time-logs" class="text-sm text-indigo-600 hover:underline">← Back to Time Log</a>
        </div>
    </x-slot>
     <div class="py-12 max-w-2xl mx-auto px-4 space-y-6">
         <div class="bg-indigo-600 px-6 py-5">
            <h3 class="text-white text-lg font-semibold">{{ $timeLog->user->name }}</h3>
            <p class="text-indigo-100 text-sm">Time Log #{{ $timeLog->user->id  }}</p>
        </div>
        <div class="p-6 space-y-4">

            <div>
                <p class="text-xs uppercase text-gray-400">Deal Name</p>
                <p class="text-gray-800">{{ $timeLog->deal->title }}</p>
            </div>
             <div>
                <p class="text-xs uppercase text-gray-400">Name</p>
                <p class="text-gray-800">{{ $timeLog->user->name }}</p>
            </div>
             <div>
                <p class="text-xs uppercase text-gray-400">Date</p>
                <p class="text-gray-800">{{ $timeLog->date }}</p>
            </div>
             <div>
                <p class="text-xs uppercase text-gray-400">Start Date</p>
                <p class="text-gray-800">{{ $timeLog->sstart_time }}</p>
            </div>
             <div>
                <p class="text-xs uppercase text-gray-400">End Date</p>
                <p class="text-gray-800">{{ $timeLog->end_time }}</p>
            </div>
             <div>
                <p class="text-xs uppercase text-gray-400">Notes</p>
                <p class="text-gray-800">{{ $timeLog->notes }}</p>
            </div>
        </div>
     </div>
</x-app-layout>