<x-layout>
    <div class="max-w-2xl mx-auto mt-10 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">My Todos</h1>
            <form action="{{ route('todos.index') }}" method="GET">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <input type="text" placeholder="Search todos" class="border" name="search" value="{{ $search }}">
                <button type="submit">Search</button>
            </form>
            <a href="{{ route('todos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                + New Todo
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex gap-4 mb-4">
            <a href="{{ route('todos.index') }}" class="{{ $status === null ? 'font-bold' : '' }}">All</a>
            <a href="{{ route('todos.index', ['status' => 'active']) }}" class="{{ $status === 'active' ? 'font-bold' : '' }}">Active</a>
            <a href="{{ route('todos.index', ['status' => 'completed']) }}" class="{{ $status === 'completed' ? 'font-bold' : '' }}">Completed</a>
        </div>
        
        <div class="space-y-3">
            @forelse ($todos as $todo)
                <div class="border rounded p-4 flex justify-between items-center {{ $todo->is_done ? 'bg-gray-50' : '' }}">
                    <div>
                        <h2 class="font-semibold {{ $todo->is_done ? 'line-through text-gray-400' : '' }}">
                            {{ $todo->title }}
                        </h2>
                        @if ($todo->due_date)
                            <p class="text-sm text-gray-500">Due: {{ $todo->due_date->format('M d, Y') }}</p>
                        @endif
                        @if ($todo->priority)
                            <p class="text-sm {{ match ($todo->priority) {
                                'high' => 'text-red-600',
                                'medium' => 'text-yellow-600',
                                'low' => 'text-green-600',
                            } }}">
                                Priority: {{ $todo->priority }}
                            </p>
                        @endif
                    </div>

                    <div class="flex gap-2">
                        <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="is_done" value="0">
                            <input type="checkbox" onchange="this.form.submit()" name="is_done" value="1" {{ $todo->is_done ? 'checked' : '' }}>
                        </form>
                    </div>

                    <div class="flex gap-2">
                        <a href="{{ route('todos.edit', $todo) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('Delete this Todo?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Delete</button>
                        </form>
                    </div>
                </div>

            @empty
                <p class="text-gray-500">No todos yet. Add one!</p>
            @endforelse
        </div>
    </div>
</x-layout>]
