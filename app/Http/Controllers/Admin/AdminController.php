<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Photo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_collections' => Collection::count(),
            'active_collections' => Collection::active()->count(),
            'total_photos' => Photo::count(),
            'featured_photos' => Photo::featured()->count(),
            'recent_photos' => Photo::latest()->limit(5)->with('collection')->get(),
            'recent_collections' => Collection::latest()->limit(3)->withCount('photos')->get()
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
