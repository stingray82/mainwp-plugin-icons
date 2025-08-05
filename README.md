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
add_filter('mainwp_before_save_cached_icons', function($cached_icons, $icon, $slug, $type, $custom_icon, $noexp) {
    $json_url = 'https://raw.githubusercontent.com/stingray82/mainwp-plugin-icons/main/icons-map.json';
    $json_data = @file_get_contents($json_url);
    if (!$json_data) return $cached_icons;

    $icon_map = json_decode($json_data, true);
    if (!is_array($icon_map)) return $cached_icons;

    if (isset($icon_map[$slug])) {
        $cached_icons[$slug] = $icon_map[$slug];
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


