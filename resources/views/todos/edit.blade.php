<x-layout>
    <div class="max-w-2xl mx-auto mt-10 px-4">
        <h1 class="text-2xl font-bold mb-6">Edit Todo</h1>

        <form action="{{ route('todos.update', $todo) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title', $todo->title) }}" class="w-full border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded p-2">{{ old('description', $todo->description) }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date', $todo->due_date?->format('Y-m-d')) }}" class="border rounded p-2">
            </div>

            <label class="flex items-center gap-2">
                <input type="hidden" name="is_done" value="0">
                <input type="checkbox" name="is_done" value="1" {{ $todo->is_done ? 'checked' : '' }}>
                Completed
            </label>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Todo</button>
        </form>
    </div>
</x-layout>