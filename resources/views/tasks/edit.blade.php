<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-900">Edit Task</h2>
  </x-slot>

  <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">

      <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Task Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Task Name</label>
          <input type="text" name="name" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" value="{{ old('name', $task->name) }}" required>
          @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Description -->
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea name="description" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm">{{ old('description', $task->description) }}</textarea>
          @error('description') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        </div>

        <!-- Category -->
        <div>
          <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
          <select name="category_id" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" required>
            @foreach ($categories as $c)
              <option value="{{ $c->id }}" @selected(old('category_id', $task->category_id) == $c->id)>{{ $c->name }}</option>
            @endforeach
          </select>
        </div>

        <!-- Assign to User (Admin only) -->
        @if (auth()->user()->role === 'admin')
          <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700">Assign To</label>
            <select name="user_id" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" required>
              @foreach ($users as $u)
                <option value="{{ $u->id }}" @selected(old('user_id', $task->user_id) == $u->id)>{{ $u->name }}</option>
              @endforeach
            </select>
          </div>
        @endif

        <!-- Deadline -->
        <div>
          <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
          <input type="datetime-local" name="deadline" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" value="{{ old('deadline', $task->deadline->format('Y-m-d\TH:i')) }}" required>
        </div>

        <!-- Status -->
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
          <select name="status" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm">
            <option value="Pending" @selected($task->status == 'Pending')>Pending</option>
            <option value="In-Progress" @selected($task->status == 'In-Progress')>In-Progress</option>
            <option value="Completed" @selected($task->status == 'Completed')>Completed</option>
          </select>
        </div>

        <div>
          <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Task</button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
