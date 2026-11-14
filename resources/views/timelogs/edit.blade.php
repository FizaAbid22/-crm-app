
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Time Log</h2>
            <a href="/time-logs" class="text-sm text-indigo-600 hover:underline">← Back to Time Logs</a>
        </div>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto px-4">

        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">

            <div class="bg-indigo-600 px-6 py-5">
                <h3 class="text-white text-lg font-semibold">Edit Time Log</h3>
                <p class="text-indigo-100 text-sm">Update the Time Log's details below</p>
            </div>

            <form action="/time-logs/{{ $timeLog->id }}" method="POST" class="p-6 space-y-5">

                @csrf
                @method('PUT')

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">User Name</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" name="date" value="{{ $timeLog->date }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                    <input type="time" name="start_time" value="{{ $timeLog->start_time }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                    <input type="time" name="end_time" value="{{ $timeLog->end_time }}"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Select Project
                    </label>

                    <select name="deal_id"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                        @foreach($deals as $deal)
                            <option value="{{ $deal->id }}"
                                @selected($timeLog->deal_id == $deal->id)>
                                {{ $deal->title }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="bg-gray-50 -mx-6 -mb-6 px-6 py-4 flex justify-end gap-3 border-t border-gray-100 mt-6">

                    <a href="/time-logs"
                        class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">
                        Cancel
                    </a>

                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        Update Time Log
                    </button>

                </div>

            </form>

        </div>
    </div>
</x-app-layout>

