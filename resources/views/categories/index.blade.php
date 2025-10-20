<x-app-layout>
  <x-slot name="header">
    <div class="my-3 flex justify-between items-center">
      <!-- New Category Button -->
      <a
        href="{{ route('categories.create') }}"
        class="px-4 py-2 bg-blue-600 text-white rounded shadow-md hover:bg-blue-700 dark:hover:bg-blue-500 transition duration-200"
      >
        + New Category
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
    <!-- Total Categories -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
      <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Total Categories</h3>
      <p class="text-3xl font-bold text-center text-blue-600 dark:text-blue-400 mt-4">{{ $totalCategories }}</p>
    </div>

    <!-- Active Categories -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
      <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Active Categories</h3>
      <p class="text-3xl font-bold text-center text-green-600 dark:text-green-400 mt-4">{{ $activeCategories ?? '0' }}</p>
    </div>

    <!-- Inactive Categories -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-xl">
      <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Inactive Categories</h3>
      <p class="text-3xl font-bold text-center text-red-600 dark:text-red-400 mt-4">{{ $inactiveCategories ?? '0' }}</p>
    </div>
  </div>

  <!-- Categories Table -->
  <div class="max-w-7xl mx-auto bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 mt-6">
    <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-300 mb-4">Categories</h3>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-gray-100 dark:bg-gray-800">
            <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300">Name</th>
            <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300">Description</th>
            <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300">Status</th>
            <th class="p-3 border-b border-gray-300 dark:border-gray-700 text-sm font-medium text-gray-600 dark:text-gray-300">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($categories as $category)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 transition">
              <td class="p-3 border-b border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-100">{{ $category->name }}</td>
              <td class="p-3 border-b border-gray-200 dark:border-gray-700 text-gray-700 dark:text-gray-300">{{ $category->description }}</td>
              <td class="p-3 border-b border-gray-200 dark:border-gray-700">
                @if($category->status == 'Active')
                  <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 dark:bg-green-800 dark:text-green-300">{{ $category->status }}</span>
                @else
                  <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-700 dark:bg-red-800 dark:text-red-300">{{ $category->status }}</span>
                @endif
              </td>
              <td class="p-3 border-b border-gray-200 dark:border-gray-700">
                <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 dark:text-blue-400 hover:underline">Edit</a> |
                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="text-red-600 dark:text-red-400 hover:underline ml-1" onclick="return confirm('Delete this category?')">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="p-4 text-center text-gray-500 dark:text-gray-400">No categories available.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
      {{ $categories->links() }}
    </div>
  </div>
</x-app-layout>
