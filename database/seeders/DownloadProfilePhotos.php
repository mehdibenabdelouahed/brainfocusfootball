<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class DownloadProfilePhotos extends Seeder
{
    public function run(): void
    {
        $unsplashIds = [
            'photo-1539571696357-5a69c17a67c6',
            'photo-1507003211169-0a1dd7228f2d',
            'photo-1500648767791-00dcc994a43e',
            'photo-1519085360753-af0119f7cbe7',
            'photo-1522075469751-3a6694fb2f61',
            'photo-1542206395-9feb3edaa68d',
            'photo-1531427186611-ecfd6d936c79',
            'photo-1492562080023-ab3db95bfbce',
            'photo-1506794778202-cad84cf45f1d',
            'photo-1517841905240-472988babdf9',
            'photo-1530268729831-4b0b9e170218',
            'photo-1501196354995-cbb51c65aaea',
            'photo-1504257404762-b23b758af7b1',
            'photo-1513956589380-bad6acb9b9d4',
            'photo-1527980965255-d3b416303d12',
            'photo-1535713875002-d1d0cf377fde',
            'photo-1560250097-0b93528c311a',
            'photo-1489980508314-941910ded1f4',
            'photo-1512485694743-9c9538b4e6e0',
            'photo-1500048993953-d23a436266cf'
        ];

        // Ensure directory exists
        Storage::disk('public')->makeDirectory('profile_photos');

        $this->command->info("Downloading 20 profile photos from Unsplash...");

        foreach ($unsplashIds as $index => $id) {
            $url = "https://images.unsplash.com/{$id}?auto=format&fit=crop&w=256&h=256&q=80";
            $filename = "profile_photos/" . ($index + 1) . ".jpg";
            
            try {
                $response = Http::get($url);
                if ($response->successful()) {
                    Storage::disk('public')->put($filename, $response->body());
                    $this->command->info("Downloaded photo " . ($index + 1) . "/20");
                } else {
                    $this->command->error("Failed to download photo " . ($index + 1));
                }
            } catch (\Exception $e) {
                $this->command->error("Error downloading photo " . ($index + 1) . ": " . $e->getMessage());
            }
        }
    }
}
