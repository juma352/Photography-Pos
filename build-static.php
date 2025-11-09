<?php
/**
 * Static Site Generator for Netlify Deployment
 * This script generates static HTML files from your Laravel application
 */

require_once 'vendor/autoload.php';

use App\Models\Collection;
use App\Models\Photo;

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Create build directory
$buildDir = __DIR__ . '/netlify-build';
if (!is_dir($buildDir)) {
    mkdir($buildDir, 0755, true);
}

// Create subdirectories
mkdir($buildDir . '/gallery', 0755, true);
mkdir($buildDir . '/assets', 0755, true);

echo "🚀 Building static site for Netlify...\n";

// Copy assets
echo "📁 Copying assets...\n";
$publicAssets = [
    'public/build' => 'build',
    'public/Images' => 'Images',
    'public/font-preview.html' => 'font-preview.html'
];

foreach ($publicAssets as $source => $destination) {
    if (file_exists($source)) {
        if (is_dir($source)) {
            copyDirectory($source, $buildDir . '/' . $destination);
        } else {
            copy($source, $buildDir . '/' . $destination);
        }
        echo "✅ Copied $source\n";
    }
}

// Generate collections data as JSON for client-side rendering
echo "📊 Generating collections data...\n";
try {
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

    file_put_contents($buildDir . '/collections.json', json_encode($collections, JSON_PRETTY_PRINT));
    echo "✅ Generated collections.json\n";
} catch (Exception $e) {
    echo "⚠️ Could not generate collections data: " . $e->getMessage() . "\n";
    echo "📝 Creating sample collections data...\n";
    
    // Create sample data for demonstration
    $sampleCollections = [
        [
            'id' => 1,
            'title' => 'Chromatic Rebellion',
            'description' => 'A visual manifesto of color erupting where it "shouldn\'t." In alleyways, on crumbling walls, beneath overpasses and behind forgotten corners, graffiti and street art bloom like wildflowers through concrete.',
            'cover_image' => 'Grace Matu photography samples/Blooming.jpg',
            'photos' => [
                ['src' => 'Grace Matu photography samples/Blooming.jpg', 'title' => 'Blooming', 'description' => 'Colors bursting through urban decay'],
                ['src' => 'Grace Matu photography samples/Becoming.jpg', 'title' => 'Becoming', 'description' => 'Transformation through street art'],
                ['src' => 'Grace Matu photography samples/Beyond the elements.jpg', 'title' => 'Beyond the Elements', 'description' => 'Art transcending nature'],
                ['src' => 'Grace Matu photography samples/City.jpg', 'title' => 'City', 'description' => 'Urban canvas of expression'],
                ['src' => 'Grace Matu photography samples/Mùthùngu in Art.jpg', 'title' => 'Mùthùngu in Art', 'description' => 'Cultural identity in color'],
                ['src' => 'Grace Matu photography samples/Resistance.jpg', 'title' => 'Resistance', 'description' => 'Defiant beauty against conformity'],
                ['src' => 'Grace Matu photography samples/S.H.E.jpg', 'title' => 'S.H.E.', 'description' => 'Feminine power in street expression']
            ]
        ],
        [
            'id' => 2,
            'title' => 'Echoes in Motion',
            'description' => 'A celebration of the human spirit in performance captured mid-song, mid-dance, mid-roar. These photographs document the fleeting moments when people become more than themselves.',
            'cover_image' => 'Grace Matu photography samples/Enjoyment.jpeg',
            'photos' => [
                ['src' => 'Grace Matu photography samples/Enjoyment.jpeg', 'title' => 'Enjoyment', 'description' => 'Pure joy captured in motion'],
                ['src' => 'Grace Matu photography samples/Bugman.jpg', 'title' => 'Bugman', 'description' => 'Performance as transformation'],
                ['src' => 'Grace Matu photography samples/Bugman 2.jpg', 'title' => 'Bugman II', 'description' => 'The continued metamorphosis'],
                ['src' => 'Grace Matu photography samples/Powerjoyment.jpg', 'title' => 'Powerjoyment', 'description' => 'Explosive energy and celebration']
            ]
        ]
    ];
    
    file_put_contents($buildDir . '/collections.json', json_encode($sampleCollections, JSON_PRETTY_PRINT));
    echo "✅ Generated sample collections.json\n";
}

echo "\n🎉 Static site build complete!\n";
echo "📁 Files generated in: $buildDir\n";
echo "🌐 Ready for Netlify deployment!\n\n";

echo "Next steps:\n";
echo "1. Zip the contents of '$buildDir' folder\n";
echo "2. Deploy to Netlify by dragging the zip file to netlify.com\n";
echo "3. Or connect your GitHub repo to Netlify for continuous deployment\n";

function copyDirectory($source, $destination) {
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);
    }
    
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($iterator as $item) {
        $target = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        
        if ($item->isDir()) {
            if (!is_dir($target)) {
                mkdir($target, 0755, true);
            }
        } else {
            copy($item, $target);
        }
    }
}