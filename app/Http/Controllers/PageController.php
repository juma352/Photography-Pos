<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Photo;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function gallery()
    {
        $collections = Collection::where('is_active', true)
            ->with('photos')
            ->orderBy('sort_order')
            ->get()
            ->map(function ($collection) {
                return [
                    'id' => $collection->id,
                    'title' => $collection->title,
                    'description' => $collection->description,
                    'cover_image' => str_replace('Images/', '', $collection->cover_image),
                    'photos' => $collection->photos->map(function ($photo) {
                        return [
                            'src' => str_replace('Images/', '', $photo->filename),
                            'title' => $photo->title,
                            'description' => $photo->description
                        ];
                    })->toArray()
                ];
            })
            ->toArray();
            
        return view('gallery', compact('collections'));
    }

    public function showCollection($collectionId)
    {
        $collectionModel = Collection::with('photos')->findOrFail($collectionId);
        
        $collection = [
            'id' => $collectionModel->id,
            'title' => $collectionModel->title,
            'description' => $collectionModel->description,
            'cover_image' => str_replace('Images/', '', $collectionModel->cover_image),
            'photos' => $collectionModel->photos->map(function ($photo) {
                return [
                    'src' => str_replace('Images/', '', $photo->filename),
                    'title' => $photo->title,
                    'description' => $photo->description
                ];
            })->toArray()
        ];
        
        return view('gallery.collection', compact('collection'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendContact(Request $request)
    {
        // Handle contact form submission
        // ...
    }
}