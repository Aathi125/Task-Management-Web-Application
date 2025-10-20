<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-900">New Task</h2>
  </x-slot>

  <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
      <!-- Form -->
      <form method="POST" action="{{ route('tasks.store') }}" class="space-y-6">
        @csrf

        <!-- Task Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Task Name</label>
          <input type="text" name="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('name') }}" required>
          @error('name')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Task Description -->
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea name="description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" rows="4">{{ old('description') }}</textarea>
          @error('description')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Category Selection -->
        <div>
          <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
          <select name="category_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            @foreach ($categories as $c)
              <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>{{ $c->name }}</option>
            @endforeach
          </select>
          @error('category_id')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Assign Task to User (Only for Admin) -->
        @if (auth()->user()->role === 'admin')
          <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700">Assign To</label>
            <select name="user_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" required>
              @foreach ($users as $u)
                <option value="{{ $u->id }}" @selected(old('user_id') == $u->id)>{{ $u->name }}</option>
              @endforeach
            </select>
            @error('user_id')
              <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
            @enderror
          </div>
        @else
          <!-- Hidden User ID for non-admin (auto-assigned to logged-in user) -->
          <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        @endif

        <!-- Task Deadline -->
        <div>
          <label for="deadline" class="block text-sm font-medium text-gray-700">Deadline</label>
          <input type="datetime-local" name="deadline" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('deadline') }}" required>
          @error('deadline')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Task Status -->
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
          <select name="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            <option value="Pending" @selected(old('status') == 'Pending')>Pending</option>
            <option value="In-Progress" @selected(old('status') == 'In-Progress')>In-Progress</option>
            <option value="Completed" @selected(old('status') == 'Completed')>Completed</option>
          </select>
          @error('status')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Submit Button -->
        <div>
          <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
            Save Task
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
