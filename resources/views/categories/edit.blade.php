<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100">Edit Category</h2>
  </x-slot>

  <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 transition duration-300">

      <!-- Form -->
      <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-6">
        @csrf
        @method('PUT') <!-- PUT method for updating -->

        <!-- Category Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Name</label>
          <input
            type="text"
            name="name"
            value="{{ old('name', $category->name) }}"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm
                   bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200
                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            required
          >
          @error('name')
            <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Category Description -->
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
          <textarea
            name="description"
            rows="4"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm
                   bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200
                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
          >{{ old('description', $category->description) }}</textarea>
          @error('description')
            <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Category Status -->
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
          <select
            name="status"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm
                   bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-200
                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            required
          >
            <option value="Active" @selected(old('status', $category->status) == 'Active')>Active</option>
            <option value="Inactive" @selected(old('status', $category->status) == 'Inactive')>Inactive</option>
          </select>
          @error('status')
            <div class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Submit Button -->
        <div>
          <button
            type="submit"
            class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-500
                   text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all"
          >
            Update Category
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
