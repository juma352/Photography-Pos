<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function gallery()
    {
        $collections = $this->getCollections();
        return view('gallery', compact('collections'));
    }

    public function showCollection($collectionId)
    {
        $collections = $this->getCollections();
        $collection = collect($collections)->firstWhere('id', $collectionId);
        
        if (!$collection) {
            abort(404);
        }
        
        return view('gallery.collection', compact('collection'));
    }

    private function getCollections()
    {
        return [
            [
                'id' => 'portraits',
                'title' => 'Portrait Photography',
                'description' => 'Capturing the essence and personality of individuals through intimate and expressive portraits.',
                'cover_image' => 'Grace Matu photography samples/20250720_224531.jpg',
                'photos' => [
                    [
                        'src' => 'Grace Matu photography samples/20250720_224531.jpg',
                        'title' => 'Urban Portrait',
                        'description' => 'A captivating portrait showcasing natural lighting and authentic expressions.'
                    ],
                    [
                        'src' => 'Grace Matu photography samples/20250720_224918.jpg',
                        'title' => 'Artistic Expression',
                        'description' => 'Bold and creative portrait capturing unique personality and style.'
                    ],
                    [
                        'src' => 'Grace Matu photography samples/S.H.E.jpg',
                        'title' => 'S.H.E.',
                        'description' => 'Empowering portrait celebrating strength, beauty, and confidence.'
                    ]
                ]
            ],
            [
                'id' => 'nature',
                'title' => 'Nature & Landscapes',
                'description' => 'Breathtaking natural scenes and landscapes that showcase the beauty of our world.',
                'cover_image' => 'Grace Matu photography samples/Blooming.jpg',
                'photos' => [
                    [
                        'src' => 'Grace Matu photography samples/Blooming.jpg',
                        'title' => 'Blooming',
                        'description' => 'Delicate flowers in full bloom, capturing nature\'s perfect timing.'
                    ],
                    [
                        'src' => 'Grace Matu photography samples/pink flower4.JPG',
                        'title' => 'Pink Blossom',
                        'description' => 'Soft pink petals dancing in the gentle breeze of spring.'
                    ],
                    [
                        'src' => 'Grace Matu photography samples/Berlin sunset.jpeg',
                        'title' => 'Berlin Sunset',
                        'description' => 'Golden hour magic painting the sky in warm, vibrant colors.'
                    ]
                ]
            ],
            [
                'id' => 'urban',
                'title' => 'Urban Photography',
                'description' => 'City life, architecture, and the dynamic energy of urban environments.',
                'cover_image' => 'Grace Matu photography samples/City.jpg',
                'photos' => [
                    [
                        'src' => 'Grace Matu photography samples/City.jpg',
                        'title' => 'City Life',
                        'description' => 'The bustling energy and architectural beauty of modern urban landscapes.'
                    ],
                    [
                        'src' => 'Grace Matu photography samples/Lights Camera Darkness.jpg',
                        'title' => 'Lights Camera Darkness',
                        'description' => 'Night photography capturing the dramatic interplay of light and shadow.'
                    ]
                ]
            ],
            [
                'id' => 'artistic',
                'title' => 'Artistic Concepts',
                'description' => 'Creative and conceptual photography exploring themes of identity, culture, and emotion.',
                'cover_image' => 'Grace Matu photography samples/Becoming.jpg',
                'photos' => [
                    [
                        'src' => 'Grace Matu photography samples/Becoming.jpg',
                        'title' => 'Becoming',
                        'description' => 'A transformative journey captured through artistic vision and storytelling.'
                    ],
                    [
                        'src' => 'Grace Matu photography samples/Beyond the elements.jpg',
                        'title' => 'Beyond the Elements',
                        'description' => 'Transcending physical boundaries through creative composition and lighting.'
                    ],
                    [
                        'src' => 'Grace Matu photography samples/Mùthùngu in Art.jpg',
                        'title' => 'Mùthùngu in Art',
                        'description' => 'Cultural identity expressed through contemporary artistic photography.'
                    ],
                    [
                        'src' => 'Grace Matu photography samples/Resistance.jpg',
                        'title' => 'Resistance',
                        'description' => 'Powerful imagery exploring themes of strength and perseverance.'
                    ],
                    [
                        'src' => 'Grace Matu photography samples/Resistance 2.jpg',
                        'title' => 'Resistance II',
                        'description' => 'Continuation of the resistance series with deeper emotional impact.'
                    ]
                ]
            ]
        ];
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