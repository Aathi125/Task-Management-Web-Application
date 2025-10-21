<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\User;

class TaskController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // Base query: get only user's tasks if not admin
    $query = Task::with(['category', 'user'])
        ->when(auth()->user()->role !== 'admin', fn($q) => $q->where('user_id', auth()->id()))
        ->latest();

    // Clone query for counts
    $baseQuery = clone $query;

    // Count totals safely — if no tasks exist, it’ll return 0 automatically
    $totalTasks = (clone $baseQuery)->count();
    $completedTasks = (clone $baseQuery)->where('status', 'Completed')->count();
    $pendingTasks = (clone $baseQuery)->where('status', 'Pending')->count();

    // Get paginated results
    $tasks = $query->paginate(10);

    return view('tasks.index', compact('tasks', 'totalTasks', 'completedTasks', 'pendingTasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 'Active')->orderBy('name')->get();
        $users = auth()->user()->role==='admin' ? \App\Models\User::orderBy('name')->get() : collect([auth()->user()]);
        return view('tasks.create', compact('categories', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            // Validate the incoming request
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id'     => ['required', 'exists:users,id'],// Ensure user_id is provided
            'deadline'    => ['required', 'date', 'after:now'],
            'status'      => ['required', 'in:Pending,In-Progress,Completed'],


            ]);

        // If normal user, force self-assignment
        if (auth()->user()->role !== 'admin') { $data['user_id'] = auth()->id(); }
        Task::create($data);
        return redirect()->route('tasks.index')->with('ok', 'Task created');

     }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Load the task with its category and assigned user for better performance
        $task->load('category', 'user');

        // Return the task view with the task object
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
         $categories = Category::where('status', 'Active')->orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('tasks.edit', compact('task', 'categories', 'users'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'deadline' => 'required|date|after:now',
            'status' => 'required|in:Pending,In-Progress,Completed',
            'user_id' => 'required|exists:users,id'
        ]);

        $task->update($data);
        return redirect()->route('tasks.index')->with('ok', 'Task updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
         $task->delete();
        return redirect()->route('tasks.index')->with('ok', 'Task deleted');
    }
}
