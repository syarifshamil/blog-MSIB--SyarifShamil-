<?php

namespace App\Http\Controllers;

use App\Models\Category; // Jangan lupa import model Category
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'description' => 'nullable',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category) // Menggunakan model binding langsung
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category) // Tidak perlu duplikasi, menggunakan model binding
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category) // Menggunakan model binding
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id . '|max:255',
            'description' => 'nullable',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category) // Menggunakan model binding
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
