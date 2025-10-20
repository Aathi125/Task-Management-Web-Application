<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-900">Edit Category</h2>
  </x-slot>

  <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">

      <!-- Form -->
      <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-6">
        @csrf
        @method('PUT') <!-- Since this is an update, we use the PUT method -->

        <!-- Category Name -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
          <input type="text" name="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" value="{{ old('name', $category->name) }}" required>
          @error('name')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Category Description -->
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
          <textarea name="description" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" rows="4">{{ old('description', $category->description) }}</textarea>
          @error('description')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Category Status -->
        <div>
          <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
          <select name="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" required>
            <option value="Active" @selected(old('status', $category->status) == 'Active')>Active</option>
            <option value="Inactive" @selected(old('status', $category->status) == 'Inactive')>Inactive</option>
          </select>
          @error('status')
            <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
          @enderror
        </div>

        <!-- Submit Button -->
        <div>
          <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50">
            Update Category
          </button>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>
