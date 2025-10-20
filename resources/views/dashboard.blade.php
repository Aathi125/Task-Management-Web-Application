<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Content Container -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Welcome Card -->
                    <div class="bg-gradient-to-r from-blue-500 to-teal-500 p-6 rounded-lg shadow-md text-white mb-6">
                        @if(auth()->user()->role === 'admin')
                            <h3 class="text-3xl font-semibold">Welcome, Admin!</h3>
                            <p class="mt-2">You have full control over the task management system.</p>


                        @else
                            <h3 class="text-3xl font-semibold">Welcome, User!</h3>
                            <p class="mt-2">You can view and manage your tasks here.</p>

                        @endif
                    </div>

                    <!-- Action Cards for Admin and User -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Task Management Card -->
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md border border-gray-300 hover:shadow-xl transition duration-300 ease-in-out">
                            <h4 class="text-xl font-semibold">Task Management</h4>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">Manage and organize tasks easily.</p>
                            <a href="{{ route('tasks.index') }}" class="text-blue-500 hover:text-blue-400 mt-4 block">Go to Tasks</a>
                        </div>

                        <!-- Category Management Card -->
                        @if(auth()->user()->role === 'admin')
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md border border-gray-300 hover:shadow-xl transition duration-300 ease-in-out">
                            <h4 class="text-xl font-semibold">Category Management</h4>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">Create and organize categories for tasks.</p>
                            <a href="{{ route('categories.index') }}" class="text-blue-500 hover:text-blue-400 mt-4 block">Go to Categories</a>
                        </div>
                        @endif

                        <!-- User Management Card -->
                        @if(auth()->user()->role === 'admin')
                        <div class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md border border-gray-300 hover:shadow-xl transition duration-300 ease-in-out">
                            <h4 class="text-xl font-semibold">User Management</h4>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">Manage users and their roles.</p>
                            <a href="{{ route('categories.index') }}" class="text-blue-500 hover:text-blue-400 mt-4 block">Go to Users</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
