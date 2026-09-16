<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class DownloadImages extends Seeder
{
    private $imageUrls = [
        // apartment-rent
        1 => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800&q=80',
        2 => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800&q=80',
        3 => 'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&q=80',
        // apartment-sale
        4 => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&q=80',
        5 => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800&q=80',
        6 => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&q=80',
        // villa-sale
        7 => 'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=800&q=80',
        8 => 'https://images.unsplash.com/photo-1613490493576-7fde63acd811?w=800&q=80',
        9 => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&q=80',
        // villa-short-rent
        10 => 'https://images.unsplash.com/photo-1510798881967-1b9d79383e6c?w=800&q=80',
        11 => 'https://images.unsplash.com/photo-1587061949409-02df41d5e562?w=800&q=80',
        12 => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=800&q=80',
        // commercial-rent
        13 => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80',
        14 => 'https://images.unsplash.com/photo-1497366811353-6870744d04b2?w=800&q=80',
        15 => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800&q=80',
        // commercial-sale
        16 => 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=800&q=80',
        17 => 'https://images.unsplash.com/photo-1554469384-e58fac16e23a?w=800&q=80',
        18 => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?w=800&q=80',
        // land
        19 => 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800&q=80',
        20 => 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&q=80',
        21 => 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=800&q=80',
        // pre-sale
        22 => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=800&q=80',
        23 => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800&q=80',
        24 => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80',
        // other
        25 => 'https://images.unsplash.com/photo-1558618666-fcd25c85f82e?w=800&q=80',
        26 => 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=800&q=80',
        27 => 'https://images.unsplash.com/photo-1449844908441-8829872d2607?w=800&q=80',
    ];

    public function run(): void
    {
        $this->command->info('Downloading real property images from Unsplash...');

        foreach ($this->imageUrls as $propertyId => $url) {
            $this->command->info("  Downloading image for property #{$propertyId}...");

            $uploadDir = public_path('upload/property/' . $propertyId);
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $filepath = $uploadDir . '/sample_1.jpg';

            try {
                $response = Http::timeout(30)->get($url);
                if ($response->successful()) {
                    File::put($filepath, $response->body());
                    $this->command->info("    ✓ Downloaded successfully");
                } else {
                    $this->command->warn("    ✗ HTTP {$response->status()}");
                }
            } catch (\Exception $e) {
                $this->command->warn("    ✗ Failed: " . $e->getMessage());
            }
        }

        $this->command->info('✅ Done downloading images!');
    }
}
