<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-900">Task Details</h2>
  </x-slot>

  <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">

      <!-- Task Header -->
      <div class="px-6 py-5 bg-blue-50 border-b border-gray-200">
        <h3 class="text-2xl font-semibold text-blue-700">{{ $task->name }}</h3>
        <p class="text-sm text-gray-500 mt-1">Assigned on {{ $task->created_at->format('d M Y, h:i A') }}</p>
      </div>

      <!-- Task Details Body -->
      <div class="px-6 py-6 space-y-6">
        <div class="grid sm:grid-cols-2 gap-6 text-sm text-gray-700">
          <div>
            <p class="text-gray-500 font-medium">Description</p>
            <p class="mt-1">{{ $task->description ?? '-' }}</p>
          </div>

          <div>
            <p class="text-gray-500 font-medium">Category</p>
            <p class="mt-1">{{ $task->category->name }}</p>
          </div>

          <div>
            <p class="text-gray-500 font-medium">Assigned User</p>
            <p class="mt-1">{{ $task->user->name }} ({{ $task->user->email }})</p>
          </div>

          <div>
            <p class="text-gray-500 font-medium">Deadline</p>
            <p class="mt-1">{{ $task->deadline->format('d M Y, h:i A') }}</p>
          </div>

          <div>
            <p class="text-gray-500 font-medium">Status</p>
            <span class="inline-block mt-1 px-3 py-1 text-xs font-semibold rounded-full
              @class([
                'bg-yellow-100 text-yellow-700' => $task->status === 'Pending',
                'bg-blue-100 text-blue-700' => $task->status === 'In-Progress',
                'bg-green-100 text-green-700' => $task->status === 'Completed',
              ])">
              {{ $task->status }}
            </span>
          </div>
        </div>
      </div>

      <!-- Actions -->
      <div class="px-6 py-4 bg-gray-50 flex justify-between items-center border-t">
        <a href="{{ route('tasks.index') }}" class="text-gray-600 hover:text-blue-600 transition">← Back to Tasks</a>

        <div class="space-x-3">
          <a href="{{ route('tasks.edit', $task) }}"
             class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition shadow-sm">
            Edit
          </a>
          <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this task?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition shadow-sm">
              Delete
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
