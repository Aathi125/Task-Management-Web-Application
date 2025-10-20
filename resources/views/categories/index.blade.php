<x-app-layout>
  <x-slot name="header">
    <div class="my-3 flex justify-between items-center">
      <!-- New Category Button -->
      <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded shadow-md hover:bg-blue-700 transition duration-200">+ New Category</a>
    </div>
  </x-slot>

  <!-- Flash Message for Success -->
  @if (session('ok'))
    <div class="p-3 bg-green-100 rounded-md shadow-sm text-center mb-6">{{ session('ok') }}</div>
  @endif

  <!-- Dashboard Stats Section -->
  <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 my-6">
    <!-- Total Categories Card -->
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
      <h3 class="text-lg font-semibold text-gray-700">Total Categories</h3>
      <p class="text-3xl font-bold text-center text-blue-600 mt-4">{{ $totalCategories }}</p>
    </div>

    <!-- Total Tasks Card -->
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
      <h3 class="text-lg font-semibold text-gray-700">Active Categories</h3>
      <p class="text-3xl font-bold text-center text-blue-600 mt-4">{{ $activeCategories ?? '0' }}</p> <!-- Display total tasks if available -->
    </div>

    <!-- Tasks Assigned to Logged-in User Card -->
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
      <h3 class="text-lg font-semibold text-gray-700">In-active Categories</h3>
      <p class="text-3xl font-bold text-center text-blue-600 mt-4">{{ $inactiveCategories ?? '0' }}</p> <!-- Display tasks assigned if available -->
    </div>
  </div>

  <!-- Categories Table -->
  <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md border border-gray-200 mt-6">
    <h3 class="text-xl font-semibold text-gray-700">Categories</h3>
    <table class="w-full mt-4 text-left border-collapse">
      <thead>
        <tr class="bg-gray-100">
          <th class="p-3 border-b text-sm font-medium text-gray-600">Name</th>
          <th class="p-3 border-b text-sm font-medium text-gray-600">Description</th>
          <th class="p-3 border-b text-sm font-medium text-gray-600">Status</th>
          <th class="p-3 border-b text-sm font-medium text-gray-600">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
          <tr class="hover:bg-gray-50">
            <td class="p-3 border-b text-sm">{{ $category->name }}</td>
            <td class="p-3 border-b text-sm">{{ $category->description }}</td>
            <td class="p-3 border-b text-sm">{{ $category->status }}</td>
            <td class="p-3 border-b text-sm">
              <a href="{{ route('categories.edit', $category) }}" class="text-blue-600 hover:text-blue-800 mr-2">Edit</a> |
              <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 ml-2" onclick="return confirm('Delete this category?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
      {{ $categories->links() }}
    </div>
  </div>

</x-app-layout>
