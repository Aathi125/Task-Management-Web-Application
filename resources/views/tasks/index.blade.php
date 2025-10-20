<x-app-layout>
  <x-slot name="header">
    <div class="my-3 flex justify-between items-center">
      <!-- Search Bar -->
      <form method="get" class="w-full sm:w-auto flex">
        <input
          name="search"
          class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200 p-2 w-full sm:w-64 rounded-l-md focus:ring-2 focus:ring-blue-500"
          placeholder="Search Tasks..."
          value="{{ request('search') }}"
        />
        <button
          type="submit"
          class="px-4 py-2 bg-blue-600 text-white rounded-r-md hover:bg-blue-700 dark:hover:bg-blue-500 transition duration-200"
        >
          Search
        </button>
      </form>

      <!-- New Task Button -->
      <a
        href="{{ route('tasks.create') }}"
        class="px-4 py-2 bg-blue-600 text-white rounded shadow-md hover:bg-blue-700 dark:hover:bg-blue-500 transition duration-200"
      >
        + New Task
      </a>
    </div>
  </x-slot>

  <!-- Flash Message for Success -->
  @if (session('ok'))
    <div class="p-3 bg-green-100 dark:bg-green-800 dark:text-green-100 text-green-800 rounded-md shadow-sm text-center mb-6">
      {{ session('ok') }}
    </div>
  @endif

  <!-- Dashboard Stats Section -->
  <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 my-6">
    <!-- Total Tasks Card -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
      <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Tasks</h3>
      <p class="text-3xl font-bold text-center text-blue-600 dark:text-blue-400 mt-4">{{ $totalTasks }}</p>
    </div>

    <!-- Completed Tasks Card -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
      <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Completed Tasks</h3>
      <p class="text-3xl font-bold text-center text-green-600 dark:text-green-400 mt-4">{{ $completedTasks }}</p>
    </div>

    <!-- Pending Tasks Card -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
      <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Pending Tasks</h3>
      <p class="text-3xl font-bold text-center text-yellow-600 dark:text-yellow-400 mt-4">{{ $pendingTasks }}</p>
    </div>
  </div>

  <!-- Tasks Table -->
  <div class="max-w-7xl mx-auto bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 mt-6">
    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Tasks</h3>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-100 dark:bg-gray-800">
            <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300">Name</th>
            <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300">Category</th>
            <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300">Assigned</th>
            <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300">Deadline</th>
            <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300">Status</th>
            <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($tasks as $task)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
              <td class="p-3 border-b border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200">{{ $task->name }}</td>
              <td class="p-3 border-b border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200">{{ $task->category->name }}</td>
              <td class="p-3 border-b border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200">{{ $task->user->name }}</td>
              <td class="p-3 border-b border-gray-200 dark:border-gray-700 text-gray-800 dark:text-gray-200">{{ $task->deadline->format('Y-m-d H:i') }}</td>
              <td class="p-3 border-b border-gray-200 dark:border-gray-700">
                @if($task->status == 'Completed')
                  <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-300">{{ $task->status }}</span>
                @elseif($task->status == 'In-Progress')
                  <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-800 dark:text-yellow-300">{{ $task->status }}</span>
                @else
                  <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-300">{{ $task->status }}</span>
                @endif
              </td>
              <td class="p-3 border-b border-gray-200 dark:border-gray-700">
                <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 dark:text-blue-400 hover:underline">View</a> |
                <a href="{{ route('tasks.edit', $task) }}" class="text-yellow-600 dark:text-yellow-400 hover:underline">Edit</a> |
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 dark:text-red-400 hover:underline ml-1" onclick="return confirm('Delete this task?')">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="p-4 text-center text-gray-500 dark:text-gray-400">No tasks available.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
      {{ $tasks->links() }}
    </div>
  </div>
</x-app-layout>
