<?php
namespace App\Helpers;

use Crypt;
use File;

class SiteConfig {
    public static function get(): array
    {
        $path = resource_path('metadata.json');
        $exists = File::exists($path);
        $data = [
            'title' => config('app.name'),
            'tagline' => '',
            'description' => '',
            'icon' => public_path('favicon.ico'),
        ];
        if (!$exists) {
            File::put($path, Crypt::encryptString(json_encode($data)));
            return $data;
        }
        $file = File::get($path);
        $text = Crypt::decryptString($file);
        $data = json_decode($text, true);
        return $data;
    }

    public static function save(array $data = [])
    {
        $path = resource_path('metadata.json');
        $json = json_encode($data);
        $encrypted = Crypt::encryptString($json);
        File::put($path, $encrypted);
    }
}
