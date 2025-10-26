<?php
function buildIconsMap(string $directory, string $baseUrl): array {
    $supported = ['png', 'jpg', 'jpeg', 'gif', 'ico', 'svg', 'webp'];
    $map = [];
    $latestMtime = 0;

    if (!is_dir($directory)) {
        echo "Directory not found: $directory\n";
        return [$map, $latestMtime];
    }

    foreach (scandir($directory) ?: [] as $file) {
        $path = $directory . '/' . $file;
        if (!is_file($path)) continue;

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (!in_array($ext, $supported, true)) continue;

        $key = pathinfo($file, PATHINFO_FILENAME);
        $url = rtrim($baseUrl, '/') . '/' . $file;

        $map[$key] = $url;

        $mtime = @filemtime($path);
        if ($mtime && $mtime > $latestMtime) $latestMtime = $mtime;
    }

    return [$map, $latestMtime];
}

function writeJson(string $path, $data): void {
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($path, $json);
    echo "Wrote $path\n";
}

// === CONFIGURE HERE ===
$pluginDir     = __DIR__ . '/icons';
$themeDir      = __DIR__ . '/themes';
$pluginBaseUrl = 'https://raw.githubusercontent.com/stingray82/mainwp-plugin-icons/main/icons';
$themeBaseUrl  = 'https://raw.githubusercontent.com/stingray82/mainwp-plugin-icons/main/themes';

// Build maps
[$pluginMap, $pluginMtime] = buildIconsMap($pluginDir, $pluginBaseUrl);
[$themeMap,  $themeMtime ] = buildIconsMap($themeDir,  $themeBaseUrl);

// Save maps
writeJson(__DIR__ . '/icons-map.json',        $pluginMap);
writeJson(__DIR__ . '/themes-icons-map.json', $themeMap);

// Save lightweight freshness file (prefer JSON, but name it .log if you really want)
$meta = [
    'generated_at' => gmdate('c'),
    'plugin'       => ['count' => count($pluginMap), 'latest_mtime' => $pluginMtime],
    'theme'        => ['count' => count($themeMap),  'latest_mtime' => $themeMtime],
    // If running in GitHub Actions, this is auto-populated:
    'build_sha'    => getenv('GITHUB_SHA') ?: null,
];
writeJson(__DIR__ . '/lastupdate.json', $meta);
// If you insist on .log, you can also write it:
// file_put_contents(__DIR__ . '/lastupdate.log', $meta['generated_at'] . "\n");
