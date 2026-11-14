<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Time Logs Report</h2>
    </x-slot>

    <div class="py-12 max-w-6xl mx-auto px-4">

        {{-- Filter form --}}
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 p-6 mb-6">
            <form method="GET" action="/time-logs" class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Employee</label>
                    <select name="user_id" class="w-full border border-gray-300 rounded-lg p-2">
                        <option value="">All Employees</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Project</label>
                    <select name="deal_id" class="w-full border border-gray-300 rounded-lg p-2">
                        <option value="">All Projects</option>
                        @foreach ($deals as $deal)
                            <option value="{{ $deal->id }}" @selected(request('deal_id') == $deal->id)>
                                {{ $deal->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="w-full border border-gray-300 rounded-lg p-2">
                </div>

                <div class="sm:col-span-4">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        Apply Filters
                    </button>
                    <a href="/time-logs" class="text-sm text-gray-500 hover:underline ml-3">Clear Filters</a>
                </div>

            </form>
        </div>


        {{-- Active filters bar --}}
        @if (request('user_id') || request('deal_id') || request('start_date'))
            <div class="flex flex-wrap gap-2 mb-4">
                @if (request('user_id'))
                    <span class="bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full">
                        Employee: {{ $users->find(request('user_id'))->name }}
                    </span>
                @endif
                @if (request('deal_id'))
                    <span class="bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full">
                        Project: {{ $deals->find(request('deal_id'))->title }}
                    </span>
                @endif
                @if (request('start_date') && request('end_date'))
                    <span class="bg-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full">
                        {{ request('start_date') }} → {{ request('end_date') }}
                    </span>
                @endif
            </div>
        @endif
        <div class="flex flex-wrap gap-2 mb-4">
     <a href ="/time-logs/export?{{http_build_query(request()->all())}}" class= "text-sm text-indigo-600 hover:underline ml-3"> Export CSV</a>
           
        </div>

        {{-- Results table --}}
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr class="text-left text-xs uppercase text-gray-500">
                        <th class="p-4">Employee</th>
                        <th class="p-4">Project</th>
                        <th class="p-4">Date</th>
                        <th class="p-4">Start</th>
                        <th class="p-4">End</th>
                        <th class="p-4">Hours</th>
                        <th class="p-4">Notes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($timeLogs as $log)
                        <tr>
                            <td class="p-4">{{ $log->user->name }}</td>
                            <td class="p-4">{{ $log->deal->title }}</td>
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
                            <td colspan="7" class="p-6 text-center text-gray-400 text-sm">
                                No results yet — apply a filter above to see time logs.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>