<?php

namespace App\Traits;
use Illuminate\Support\Facades\File;
trait HandlesBase64Image
{
    //
    public function saveBase64Image(string $base64, string $folder, string $prefix = 'image_'): ?string
    {
        $directory = storage_path("app/public/$folder");

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        [$meta, $imageData] = explode(';', $base64);
        [$_, $imageData] = explode(',', $imageData);

        $image = base64_decode($imageData);
        if (!$image) return null;

        $imageName = $prefix . time() . '.png';
        file_put_contents("$directory/$imageName", $image);

        return "$folder/$imageName";
    }
}
