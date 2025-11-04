<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::with('collection')
            ->orderBy('created_at', 'desc')
            ->paginate(12);
            
        return view('admin.photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $collections = Collection::active()->orderBy('title')->get();
        return view('admin.photos.create', compact('collections'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'collection_id' => 'required|exists:collections,id',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'alt_text' => 'nullable|string|max:255',
            'is_featured' => 'boolean'
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $originalName = $file->getClientOriginalName();
            $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            
            // Move to Images directory to match existing structure
            $file->move(public_path('Images'), $filename);
            
            $validated['filename'] = $filename;
            $validated['original_filename'] = $originalName;
        }

        Photo::create($validated);

        return redirect()->route('admin.photos.index')
            ->with('success', 'Photo uploaded successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        $collections = Collection::all();
        
        // Get previous and next photos for navigation
        $previousPhoto = Photo::where('id', '<', $photo->id)
            ->orderBy('id', 'desc')
            ->first();
            
        $nextPhoto = Photo::where('id', '>', $photo->id)
            ->orderBy('id', 'asc')
            ->first();
        
        return view('admin.photos.show', compact('photo', 'collections', 'previousPhoto', 'nextPhoto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        $collections = Collection::active()->orderBy('title')->get();
        return view('admin.photos.edit', compact('photo', 'collections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'collection_id' => 'required|exists:collections,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'alt_text' => 'nullable|string|max:255',
            'is_featured' => 'boolean'
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($photo->filename && file_exists(public_path('Images/' . $photo->filename))) {
                unlink(public_path('Images/' . $photo->filename));
            }
            
            $file = $request->file('photo');
            $originalName = $file->getClientOriginalName();
            $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            
            $file->move(public_path('Images'), $filename);
            
            $validated['filename'] = $filename;
            $validated['original_filename'] = $originalName;
        }

        $photo->update($validated);

        return redirect()->route('admin.photos.index')
            ->with('success', 'Photo updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        // Delete photo file
        if ($photo->filename && file_exists(public_path('Images/' . $photo->filename))) {
            unlink(public_path('Images/' . $photo->filename));
        }

        $photo->delete();

        return redirect()->route('admin.photos.index')
            ->with('success', 'Photo deleted successfully!');
    }

    /**
     * Toggle featured status
     */
    public function toggleFeatured(Photo $photo)
    {
        $photo->update(['is_featured' => !$photo->is_featured]);

        $status = $photo->is_featured ? 'featured' : 'unfeatured';
        return back()->with('success', "Photo marked as {$status} successfully!");
    }

    /**
     * Handle bulk photo upload
     */
    public function upload(Request $request)
    {
        $request->validate([
            'collection_id' => 'required|exists:collections,id',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240'
        ]);

        $uploadedCount = 0;
        
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $originalName = $file->getClientOriginalName();
                $filename = time() . '_' . Str::random(8) . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                
                $file->move(public_path('Images'), $filename);
                
                Photo::create([
                    'title' => pathinfo($originalName, PATHINFO_FILENAME),
                    'description' => 'Uploaded via bulk upload',
                    'filename' => $filename,
                    'original_filename' => $originalName,
                    'collection_id' => $request->collection_id,
                    'sort_order' => 0,
                    'is_featured' => false
                ]);
                
                $uploadedCount++;
            }
        }

        return back()->with('success', "{$uploadedCount} photos uploaded successfully!");
    }

    /**
     * Bulk update photos
     */
    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'photo_ids' => 'required|array',
            'photo_ids.*' => 'exists:photos,id',
            'action' => 'required|in:delete,feature,unfeature,move'
        ]);

        $photos = Photo::whereIn('id', $request->photo_ids);

        switch ($request->action) {
            case 'delete':
                foreach ($photos->get() as $photo) {
                    if ($photo->filename && file_exists(public_path('Images/' . $photo->filename))) {
                        unlink(public_path('Images/' . $photo->filename));
                    }
                }
                $photos->delete();
                $message = 'Selected photos deleted successfully!';
                break;
                
            case 'feature':
                $photos->update(['is_featured' => true]);
                $message = 'Selected photos marked as featured!';
                break;
                
            case 'unfeature':
                $photos->update(['is_featured' => false]);
                $message = 'Selected photos unmarked as featured!';
                break;
                
            case 'move':
                $request->validate(['new_collection_id' => 'required|exists:collections,id']);
                $photos->update(['collection_id' => $request->new_collection_id]);
                $message = 'Selected photos moved to new collection!';
                break;
        }

        return back()->with('success', $message);
    }
}
