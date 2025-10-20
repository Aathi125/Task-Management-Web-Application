<x-app-layout>
  <x-slot name="header">
    <div class="my-3 flex justify-between items-center">
      <!-- Search Bar -->
      <form method="get" class="w-full sm:w-auto flex">
        <input
          name="search"
          class="border p-2 w-full sm:w-64 rounded-l-md"
          placeholder="Search Tasks..."
          value="{{ request('search') }}"
        />
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-md">Search</button>
      </form>

      <!-- New Task Button -->
      <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded shadow-md hover:bg-blue-700 transition duration-200">+ New Task</a>
    </div>
  </x-slot>

  <!-- Flash Message for Success -->
  @if (session('ok'))
    <div class="p-3 bg-green-100 rounded-md shadow-sm text-center mb-6">{{ session('ok') }}</div>
  @endif

  <!-- Dashboard Stats Section -->
  <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 my-6">
    <!-- Total Tasks Card -->
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
      <h3 class="text-lg font-semibold text-gray-700">Total Tasks</h3>
      <p class="text-3xl font-bold text-center text-blue-600 mt-4">{{ $totalTasks }}</p>
    </div>

    <!-- Completed Tasks Card -->
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
      <h3 class="text-lg font-semibold text-gray-700">Completed Tasks</h3>
      <p class="text-3xl font-bold text-center text-blue-600 mt-4">{{ $completedTasks }}</p>
    </div>

    <!-- Pending Tasks Card -->
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
      <h3 class="text-lg font-semibold text-gray-700">Pending Tasks</h3>
      <p class="text-3xl font-bold text-center text-blue-600 mt-4">{{ $pendingTasks }}</p>
    </div>
  </div>

  <!-- Tasks Table -->
  <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md border border-gray-200 mt-6">
    <h3 class="text-xl font-semibold text-gray-700">Tasks</h3>
    <table class="w-full mt-4 text-left border-collapse">
      <thead>
        <tr class="bg-gray-100">
          <th class="p-3 border-b text-sm font-medium text-gray-600">Name</th>
          <th class="p-3 border-b text-sm font-medium text-gray-600">Category</th>
          <th class="p-3 border-b text-sm font-medium text-gray-600">Assigned</th>
          <th class="p-3 border-b text-sm font-medium text-gray-600">Deadline</th>
          <th class="p-3 border-b text-sm font-medium text-gray-600">Status</th>
          <th class="p-3 border-b text-sm font-medium text-gray-600">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tasks as $task)
          <tr class="hover:bg-gray-50">
            <td class="p-3 border-b text-sm">{{ $task->name }}</td>
            <td class="p-3 border-b text-sm">{{ $task->category->name }}</td>
            <td class="p-3 border-b text-sm">{{ $task->user->name }}</td>
            <td class="p-3 border-b text-sm">{{ $task->deadline->format('Y-m-d H:i') }}</td>
            <td class="p-3 border-b text-sm">{{ $task->status }}</td>
            <td class="p-3 border-b text-sm">
              <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 hover:text-blue-800 mr-2">View</a> |
              <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a> |
              <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 ml-2" onclick="return confirm('Delete this task?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
      {{ $tasks->links() }}
    </div>
  </div>

</x-app-layout>
