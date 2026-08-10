<x-layout>
    <div class="max-w-2xl mx-auto mt-10 px-4">
        <h1 class="text-2xl font-bold mb-6">New Todo</h1>

        <form action="{{ route('todos.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded p-2">
                @error('title')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium">Description</label>
                <textarea name="description" class="w-full border rounded p-2">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block font-medium">Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date') }}" class="border rounded p-2">
            </div>

            <div>
                <label class="block font-medium">Priority</label>
                <select name="priority">
                    <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div>
                <label class="block font-medium">Category</label>
                <select name="category_id">
                    <option value="">-- None --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save Todo</button>
        </form>
    </div>
</x-layout>