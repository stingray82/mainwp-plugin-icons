# Contributing to MainWP Plugin Icons

Thank you for considering contributing! This project aims to enhance the visual experience of the MainWP dashboard by offering high-quality, community-curated plugin icons.

---

## 📌 What to Contribute

- PNG icons (64x64 or 128x128 preferred) for WordPress plugins
- File should be named using the **plugin slug**, e.g., `woocommerce.png`

---

## 📁 Where to Put Things

- Add icons to the `icons/` folder
- Update `icons-map.json` in the root directory with the plugin slug and raw GitHub URL to the icon

### Example

If you're adding `wordfence.png`:

1. Place the file at:
   ```
   icons/wordfence.png
   ```

2. Edit `icons-map.json` to include:
   ```json
   {
     "wordfence": "https://raw.githubusercontent.com/stingray82/mainwp-plugin-icons/main/icons/wordfence.png"
   }
   ```

---

## ✅ Requirements

- **Naming:** Use lowercase plugin slugs only (no spaces or special characters)
- **Format:** `.jpeg, jpg, gif, ico, png` only
- **Size:** 64x64 or 128x128 recommended (square)

---

## 🚀 Submitting a Pull Request

1. Fork the repository
2. Create a new branch for your icon
3. Add the icon and update `icons-map.json`
4. Commit your changes
5. Open a pull request with a short description

---

Happy contributing! 🎉
