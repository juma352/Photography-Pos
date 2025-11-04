<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collections = Collection::withCount('photos')->orderBy('sort_order')->paginate(10);
        return view('admin.collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.collections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Images'), $filename);
            $validated['cover_image'] = $filename;
        }

        Collection::create($validated);

        return redirect()->route('admin.collections.index')
            ->with('success', 'Collection created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection)
    {
        $collection->load(['photos' => function ($query) {
            $query->orderBy('sort_order');
        }]);
        
        return view('admin.collections.show', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection)
    {
        return view('admin.collections.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Collection $collection)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'is_active' => 'boolean'
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['is_active'] = $request->has('is_active');

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($collection->cover_image && file_exists(public_path('Images/' . $collection->cover_image))) {
                unlink(public_path('Images/' . $collection->cover_image));
            }
            
            $file = $request->file('cover_image');
            $filename = time() . '_' . Str::slug($validated['title']) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('Images'), $filename);
            $validated['cover_image'] = $filename;
        }

        $collection->update($validated);

        return redirect()->route('admin.collections.index')
            ->with('success', 'Collection updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        // Delete cover image if exists
        if ($collection->cover_image && file_exists(public_path('Images/' . $collection->cover_image))) {
            unlink(public_path('Images/' . $collection->cover_image));
        }

        $collection->delete();

        return redirect()->route('admin.collections.index')
            ->with('success', 'Collection deleted successfully!');
    }

    /**
     * Toggle collection status
     */
    public function toggleStatus(Collection $collection)
    {
        $collection->update(['is_active' => !$collection->is_active]);

        $status = $collection->is_active ? 'activated' : 'deactivated';
        return back()->with('success', "Collection {$status} successfully!");
    }
}
