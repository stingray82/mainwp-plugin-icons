<?php

function generateIconsMap($directory, $baseUrl, $outputFile) {
    $supportedExtensions = ['png', 'jpg', 'jpeg', 'gif', 'ico'];
    $map = [];

    if (!is_dir($directory)) {
        echo "Directory not found: $directory\n";
        return;
    }

    $files = scandir($directory);

    foreach ($files as $file) {
        $path = $directory . '/' . $file;

        if (!is_file($path)) {
            continue;
        }

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (!in_array($ext, $supportedExtensions)) {
            continue;
        }

        $key = pathinfo($file, PATHINFO_FILENAME);
        $url = rtrim($baseUrl, '/') . '/' . $file;
        $map[$key] = $url;
    }

    // Save JSON
    $json = json_encode($map, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($outputFile, $json);

    echo "Generated $outputFile with " . count($map) . " entries.\n";
}

// === CONFIGURE HERE ===
$pluginDir = __DIR__ . '/icons';
$themeDir = __DIR__ . '/themes';

$pluginBaseUrl = 'https://raw.githubusercontent.com/stingray82/mainwp-plugin-icons/main/icons';
$themeBaseUrl = 'https://raw.githubusercontent.com/stingray82/mainwp-plugin-icons/main/themes';

generateIconsMap($pluginDir, $pluginBaseUrl, __DIR__ . '/icons-map.json');
generateIconsMap($themeDir, $themeBaseUrl, __DIR__ . '/themes-icons-map.json');
