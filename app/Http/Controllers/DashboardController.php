<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Total categories
        $totalCategories = Category::count();

        // Total tasks
        $totalTasks = Task::count();

        // Tasks assigned to the logged-in user
        $assignedTasks = Task::where('user_id', auth()->id())->count();

        // Recent tasks (last 5 tasks for example)
        $recentTasks = Task::latest()->take(5)->get();

        // Pass the data to the view
        return view('category-dashboard', compact('totalCategories', 'totalTasks', 'assignedTasks', 'recentTasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
