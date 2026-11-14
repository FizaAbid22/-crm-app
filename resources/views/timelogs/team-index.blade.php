<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Time Logs</h2>
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto px-4">

        @if(session('success'))
            <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="/time-logs/create"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                Log Time
            </a>
        </div>

        {{-- Results table --}}
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs uppercase text-gray-500">
                        <th class="p-4">Project</th>
                        <th class="p-4">Date</th>
                        <th class="p-4">Start</th>
                        <th class="p-4">End</th>
                        <th class="p-4">Hours</th>
                        <th class="p-4">Notes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($myLogs as $log)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4">{{ $log->deal?->title }}</td>
                            <td class="p-4">{{ $log->date }}</td>
                            <td class="p-4">{{ $log->start_time }}</td>
                            <td class="p-4">{{ $log->end_time }}</td>
                            <td class="p-4">
                                {{ round(\Carbon\Carbon::parse($log->start_time)->diffInMinutes(\Carbon\Carbon::parse($log->end_time)) / 60, 2) }}h
                            </td>
                            <td class="p-4">{{ $log->notes }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-400 text-sm">
                                No time logs yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>