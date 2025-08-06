MainWP Plugin Icons
===================

A community-driven icon library for WordPress plugins used in
[MainWP](https://mainwp.com). This repository allows users to override plugin
icons in their MainWP dashboard via custom filters.

How to Use
----------

You can integrate this repo into your WordPress installation using the following
JSON map:

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
https://raw.githubusercontent.com/stingray82/mainwp-plugin-icons/main/icons-map.json
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Replace `yourusername` with your actual GitHub username or organization name.

### Example PHP Integration

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ php
add_filter('mainwp_before_save_cached_icons', function ($cached_icons, $icon, $slug, $type, $custom_icon, $noexp) {

    // Determine correct JSON source based on type
    $json_url = '';
    if ($type === 'plugin') {
        $json_url = 'https://raw.githubusercontent.com/stingray82/mainwp-plugin-icons/main/icons-map.json';
    } elseif ($type === 'theme') {
        $json_url = 'https://raw.githubusercontent.com/stingray82/mainwp-plugin-icons/main/themes-icons-map.json';
    } else {
        return $cached_icons;
    }

    // Fetch JSON data
    $response = wp_remote_get($json_url);
    if (is_wp_error($response)) {
        error_log("[MainWP ICONS] Failed to fetch {$type} icon map: " . $response->get_error_message());
        return $cached_icons;
    }

    $icons_map = json_decode(wp_remote_retrieve_body($response), true);
    if (!is_array($icons_map)) {
        error_log("[MainWP ICONS] Invalid JSON for {$type} icons.");
        return $cached_icons;
    }

    // Inject custom icons if not already cached
    foreach ($icons_map as $custom_slug => $custom_icon_url) {
        if (!isset($cached_icons[$custom_slug])) {
            $cached_icons[$custom_slug] = [
                'lasttime_cached' => time(),
                'path_custom'     => '',
                'path'            => urlencode($custom_icon_url),
            ];

            error_log("[MainWP ICONS] Injected {$type} icon for: {$custom_slug}");
        }
    }

    return $cached_icons;

}, 10, 6);


~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Repository Structure
----------------------

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
mainwp-plugin-icons/
│
├── icons/              ← Plugin icon images (.png, 64x64 or 128x128)
│   └── akismet.png
│
├── icons-map.json      ← JSON map of plugin slugs to icon URLs
├── README.md
└── CONTRIBUTING.md
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

## Licensing & Copyright

All plugin logos and icons included in this repository are provided **as-is** for the purpose of improving the user experience in the MainWP dashboard.

- The icons remain the **copyright** of their respective plugin authors or organizations.
- No ownership or rights are claimed by this repository or its contributors.
- If you are a plugin author and wish to have your icon **added**, **updated**, or **removed**, please [open an issue](https://github.com/stingray82/mainwp-plugin-icons/issues) or submit a pull request.

This repository is community-driven and intended solely for personal and non-commercial customization.


Contribute
------------

We welcome community contributions! Help us grow the icon collection by
submitting icons for your favorite plugins. See
[CONTRIBUTING.md](CONTRIBUTING.md) for full guidelines.


Build.bat & Build.php
------------
These new additionals allow you to quickly and easily automatically build your json based on properly named files in the two applicable folders


