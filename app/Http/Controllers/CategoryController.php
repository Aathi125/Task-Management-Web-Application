<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Total categories
        $totalCategories = Category::count();

        // Calculate active categories
        $activeCategories = Category::where('status', 'Active')->count();

        // Calculate inactive categories
        $inactiveCategories = Category::where('status', 'Inactive')->count();
        $categories = Category::orderBy('name')->paginate(10);
        return view('categories.index', compact('categories', 'totalCategories', 'activeCategories', 'inactiveCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         //$this->authorize('admin');
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$this->authorize('admin');
        $data = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'status' => 'required|in:Active,Inactive',
        ]);

        Category::create($data);
        return redirect()->route('categories.index')->with('ok', 'Category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //$this->authorize('admin');
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //$this->authorize('admin');

            $data = $request->validate([
                'name' => 'required|string|max:150',
                'description' => 'nullable|string',
                'status' => 'required|in:Active,Inactive',
            ]);

            $category->update($data);
            return redirect()->route('categories.index')->with('ok', 'Category updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //$this->authorize('admin');
        $category->delete();
        return redirect()->route('categories.index')->with('ok', 'Category deleted');

    }
}
