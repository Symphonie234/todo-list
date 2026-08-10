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

            <div>
                <label class="block font-medium">Priority</label>
                <select name="priority">
                    <option value="low" {{ old('priority', $todo->priority) === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority', $todo->priority) === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority', $todo->priority) === 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div>
                <label class="block font-medium">Category</label>
                <select name="category_id">
                    <option value="">-- None --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $todo->category_id) === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Todo</button>
        </form>
    </div>
</x-layout>