<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Attendance</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

          @if(session('success'))
    <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-800">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-800">{{ session('error') }}</div>
@endif




@if(auth()->user()->role !== 'admin')
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6 flex items-center justify-between">
        <div>
            @if($openSession)
                <span class="inline-block px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-800">Working</span>
                <p class="mt-2 text-gray-600">Checked in since {{ $openSession->check_in->format('H:i') }}</p>
            @else
                <span class="inline-block px-2 py-1 text-xs font-medium rounded bg-gray-100 text-gray-700">Not checked in</span>
                <p class="mt-2 text-gray-600">Press Check In to start your day.</p>
            @endif
        </div>

        @if($openSession)
            <form method="POST" action="{{ route('attendance.checkOut') }}">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg">Check Out</button>
            </form>
        @else
            <form method="POST" action="{{ route('attendance.checkIn') }}">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg">Check In</button>
            </form>
        @endif
    </div>
@endif




<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-gray-50 text-xs uppercase text-gray-500">
            <tr>
                @if(auth()->user()->role === 'admin') <th class="px-6 py-3">Employee</th> @endif
                <th class="px-6 py-3">Date</th>
                <th class="px-6 py-3">Check In</th>
                <th class="px-6 py-3">Check Out</th>
                <th class="px-6 py-3">Hours</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($attendances as $attendance)
                <tr class="hover:bg-gray-50">
                    @if(auth()->user()->role === 'admin') <td class="px-6 py-4">{{ $attendance->user->name }}</td> @endif
                    <td class="px-6 py-4">{{ $attendance->check_in->format('Y-m-d') }}</td>
                    <td class="px-6 py-4">{{ $attendance->check_in->format('H:i') }}</td>
                    <td class="px-6 py-4">
                        @if($attendance->check_out)
                            {{ $attendance->check_out->format('H:i') }}
                        @else
                            <span class="px-2 py-1 text-xs font-medium rounded bg-amber-100 text-amber-800">Still working</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($attendance->check_out)
                            {{ round($attendance->check_in->diffInMinutes($attendance->check_out) / 60, 2) }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No attendance records yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

        </div>
    </div>
</x-app-layout>

















