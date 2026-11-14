<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Deal Details</h2>
            <a href="/deals" class="text-sm text-indigo-600 hover:underline">← Back to Deals</a>
        </div>
    </x-slot>

    <div class="py-12 max-w-2xl mx-auto px-4" x-data="{ activeTab: 'overview' }">

        {{-- Tab buttons --}}
        <div class="flex gap-2 mb-4">
            <button @click="activeTab = 'overview'"
                :class="activeTab === 'overview' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-800 border border-gray-300'"
                class="px-4 py-2 rounded-lg text-sm font-medium">
                Overview
            </button>
            <button @click="activeTab = 'tasks'"
                :class="activeTab === 'tasks' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-800 border border-gray-300'"
                class="px-4 py-2 rounded-lg text-sm font-medium">
                Tasks
            </button>
            <button @click="activeTab = 'comments'"
                :class="activeTab === 'comments' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-800 border border-gray-300'"
                class="px-4 py-2 rounded-lg text-sm font-medium">
                Comments
            </button>
            <button @click="activeTab = 'activity'"
                :class="activeTab === 'activity' ? 'bg-indigo-600 text-white' : 'bg-white text-gray-800 border border-gray-300'"
                class="px-4 py-2 rounded-lg text-sm font-medium">
                Activity
            </button>
        </div>

        {{-- Overview tab --}}
        <div x-show="activeTab === 'overview'">
            <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">

                <div class="bg-indigo-600 px-6 py-5">
                    <h3 class="text-white text-lg font-semibold">{{ $deals->title }}</h3>
                    <p class="text-indigo-100 text-sm">Deal #{{ $deals->id }}</p>
                </div>

                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs uppercase text-gray-400">Title</p>
                        <p class="text-gray-800">{{ $deals->title }}</p>
                    </div>
                    <div>
                       <span class="@if($deals->status == 'Won') bg-green-100 text-green-700
                        @elseif($deals->status == 'Lost') bg-red-100 text-red-700
                        @elseif($deals->status == 'In Progress') bg-amber-100 text-amber-700
                        @else bg-gray-100 text-gray-700
                        @endif px-2 py-1 rounded-full text-xs font-medium">
                        {{ $deals->status }}
                    </span>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-400">Amount</p>
                        <p class="text-gray-800">{{ $deals->amount }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-400">Client Name</p>
                        <p class="text-gray-800">{{ $deals->client->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-400">Start Date</p>
                        <p class="text-gray-800">{{ $deals->start_date }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-400">Due Date</p>
                        <p class="text-gray-800">{{ $deals->due_date }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase text-gray-400">Deal Started at</p>
                        <p class="text-gray-800">{{ $deals->created_at->format('d M, Y') }}</p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 border-t border-gray-100">
                    <a href="/deals/{{ $deals->id }}/edit" class="text-emerald-600 hover:underline text-sm">Edit</a>
                    <form action="/deals/{{ $deals->id }}" method="POST" onsubmit="return confirm('Delete this deal?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline text-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Tasks tab --}}
        <div x-show="activeTab === 'tasks'">
            <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-800">Tasks</h3>
                </div>

                <form action="/deals/{{ $deals->id }}/tasks" method="POST" class="p-6 space-y-4 border-b border-gray-100">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input type="text" name="title" class="w-full border border-gray-300 rounded-lg p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" class="w-full border border-gray-300 rounded-lg p-2"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                        <input type="date" name="due_date" class="w-full border border-gray-300 rounded-lg p-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full border border-gray-300 rounded-lg p-2">
                            <option value="To Do">To Do</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Assign To</label>
                        @foreach ($users as $user)
                            <label class="flex items-center gap-2 mb-1">
                                <input type="checkbox" name="users[]" value="{{ $user->id }}">
                                {{ $user->name }}
                            </label>
                        @endforeach
                    </div>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        Add Task
                    </button>
                </form>

                <div class="divide-y divide-gray-100">
                    @forelse ($deals->tasks as $task)
                        <div class="px-6 py-4">
                            <p class="font-medium text-gray-800">{{ $task->title }}</p>
                            <p class="text-sm text-gray-500">{{ $task->status }} · Due {{ $task->due_date }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                Assigned: @foreach ($task->users as $user){{ $user->name }} @endforeach
                            </p>
                        </div>
                    @empty
                        <p class="px-6 py-4 text-sm text-gray-400">No tasks yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Comments tab --}}
        <div x-show="activeTab === 'comments'">
            <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-800">Comments</h3>
                </div>

                <form action="/deals/{{ $deals->id }}/comments" method="POST" class="p-6 border-b border-gray-100">
                    @csrf
                    <textarea name="body" rows="3" placeholder="Add a comment..."
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none"></textarea>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium mt-2">
                        Post Comment
                    </button>
                </form>

                <div class="divide-y divide-gray-100">
                    @forelse ($deals->comments as $comment)
                        <div class="px-6 py-4">
                            <p class="text-sm text-gray-800">{{ $comment->body }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $comment->user->name }} · {{ $comment->created_at->format('d M, Y g:i A') }}
                            </p>
                        </div>
                    @empty
                        <p class="px-6 py-4 text-sm text-gray-400">No comments yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Activity tab --}}
        <div x-show="activeTab === 'activity'">
            <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-800">Activity</h3>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse ($deals->activities->sortByDesc('created_at') as $activity)
                        <div class="px-6 py-4">
                            <p class="text-sm text-gray-800">
                                <span class="font-medium">{{ $activity->user->name }}</span>
                                {{ $activity->description }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $activity->created_at->format('d M, Y g:i A') }}
                            </p>
                        </div>
                    @empty
                        <p class="px-6 py-4 text-sm text-gray-400">No activity yet.</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
</x-app-layout>