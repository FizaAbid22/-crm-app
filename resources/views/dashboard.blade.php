<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4">

        {{-- Top stats row --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">

            <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6">
                <p class="text-xs uppercase text-gray-400 mb-1">Total Clients</p>
                <p class="text-3xl font-bold text-gray-800">{{ $allClients }}</p>
            </div>

            <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6">
                <p class="text-xs uppercase text-gray-400 mb-1">Active Deals</p>
                <p class="text-3xl font-bold text-indigo-600">{{ $activeDeals }}</p>
            </div>

            <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6">
                <p class="text-xs uppercase text-gray-400 mb-1">Total Pipeline Value</p>
                <p class="text-3xl font-bold text-green-600">${{ number_format($totalDealValue, 2) }}</p>
            </div>

        </div>

        {{-- Task breakdown --}}
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Task Breakdown</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-gray-100">

                <div class="p-6 text-center">
                    <p class="text-2xl font-bold text-gray-600">{{ $tasksToDo }}</p>
                    <p class="text-sm text-gray-400 mt-1">To Do</p>
                </div>

                <div class="p-6 text-center">
                    <p class="text-2xl font-bold text-amber-600">{{ $tasksInProgress }}</p>
                    <p class="text-sm text-gray-400 mt-1">In Progress</p>
                </div>

                <div class="p-6 text-center">
                    <p class="text-2xl font-bold text-green-600">{{ $tasksCompleted }}</p>
                    <p class="text-sm text-gray-400 mt-1">Completed</p>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>