<?php

namespace Database\Seeders;

use App\Models\Collection;
use App\Models\Photo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data safely
        Photo::query()->delete();
        Collection::query()->delete();

        // Create Chromatic Rebellion Collection
        $chromaticRebellion = Collection::create([
            'title' => 'Chromatic Rebellion',
            'description' => 'A visual manifesto of color erupting where it "shouldn\'t." In alleyways, on crumbling walls, beneath overpasses and behind forgotten corners, graffiti and street art bloom like wildflowers through concrete. This collection captures the defiant beauty of pigment in unexpected places, a rebellion not just against grayness, but against silence. These images capture Berlin\'s uniqueness in form of memory, protest, and celebration layered with the voices of many cultures claiming space, telling stories, and refusing to be erased.',
            'cover_image' => 'Images/Grace Matu photography samples/Blooming.jpg',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        // Create Echoes in Motion Collection
        $echoesInMotion = Collection::create([
            'title' => 'Echoes in Motion',
            'description' => 'A celebration of the human spirit in performance captured mid-song, mid-dance, mid-roar. These photographs document the fleeting moments when people become more than themselves: when movement, sound, and emotion collide in public ritual. From intimate gestures to explosive energy, each image is a trace of joy, vulnerability, and connection which become echoes that linger long after the lights fade.',
            'cover_image' => 'Images/Grace Matu photography samples/Enjoyment.jpeg',
            'is_active' => true,
            'sort_order' => 2,
        ]);

        // Add photos to Chromatic Rebellion
        $chromaticPhotos = [
            'Blooming.jpg' => 'Blooming - Colors bursting through urban decay',
            'Becoming.jpg' => 'Becoming - Transformation through street art',
            'Beyond the elements.jpg' => 'Beyond the Elements - Art transcending nature',
            'City.jpg' => 'City - Urban canvas of expression',
            'Mùthùngu in Art.jpg' => 'Mùthùngu in Art - Cultural identity in color',
            'Resistance.jpg' => 'Resistance - Defiant beauty against conformity',
            'Resistance 2.jpg' => 'Resistance II - Continued rebellion through art',
            'S.H.E.jpg' => 'S.H.E. - Feminine power in street expression',
        ];

        foreach ($chromaticPhotos as $filename => $title) {
            Photo::create([
                'collection_id' => $chromaticRebellion->id,
                'title' => $title,
                'description' => 'Part of the Chromatic Rebellion series capturing street art and graffiti in Berlin',
                'filename' => 'Images/Grace Matu photography samples/' . $filename,
                'original_filename' => $filename,
                'alt_text' => $title,
                'is_featured' => false,
                'sort_order' => array_search($filename, array_keys($chromaticPhotos)) + 1,
            ]);
        }

        // Add photos to Echoes in Motion
        $echoesPhotos = [
            'Enjoyment.jpeg' => 'Enjoyment - Pure joy captured in motion',
            'Bugman.jpg' => 'Bugman - Performance as transformation',
            'Bugman 2.jpg' => 'Bugman II - The continued metamorphosis',
            'Powerjoyment.jpg' => 'Powerjoyment - Explosive energy and celebration',
        ];

        foreach ($echoesPhotos as $filename => $title) {
            Photo::create([
                'collection_id' => $echoesInMotion->id,
                'title' => $title,
                'description' => 'Part of the Echoes in Motion series documenting human performance and celebration',
                'filename' => 'Images/Grace Matu photography samples/' . $filename,
                'original_filename' => $filename,
                'alt_text' => $title,
                'is_featured' => false,
                'sort_order' => array_search($filename, array_keys($echoesPhotos)) + 1,
            ]);
        }

        // Mark some photos as featured
        Photo::whereIn('filename', [
            'Images/Grace Matu photography samples/Blooming.jpg',
            'Images/Grace Matu photography samples/Enjoyment.jpeg',
            'Images/Grace Matu photography samples/Resistance.jpg',
            'Images/Grace Matu photography samples/Powerjoyment.jpg',
        ])->update(['is_featured' => true]);

        $this->command->info('Collections and photos seeded successfully!');
        $this->command->info('Created 2 collections: Chromatic Rebellion & Echoes in Motion');
        $this->command->info('Added ' . count($chromaticPhotos) . ' photos to Chromatic Rebellion');
        $this->command->info('Added ' . count($echoesPhotos) . ' photos to Echoes in Motion');
    }
}
