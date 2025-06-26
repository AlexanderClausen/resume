# 💼 Multilingual PHP Résumé

This project is a minimalist, responsive, and print-optimised résumé/CV built using plain PHP, HTML, and CSS. It supports both English and German (and of course any other language you may want to add), modular content organisation, and customisation via simple config files.

## ✨ Features

- 🗂️ Fully modular: content stored in `languages/en.php` and `languages/de.php`
- 🌐 Multilingual (EN/DE switcher with query parameter)
- 🌓 Theme support (light/dark) based on system/browser setting or manually set
- 🖨️ Print-friendly with layout tweaks using `?print`
- 📋 Toggleable contact details via `?contactdetails`
- ⭐ Highlight favourite classes using `fav:` prefix
- 📱 Responsive layout with minimal styling

## 🚀 Getting Started

### 1. 📥 Clone the repository

```bash
git clone https://github.com/AlexanderClausen/resume.git
cd resume
```

### 2. 🎨 Set up your content

Copy the sample language files and fill in your own data:

```bash
cp languages/en.php.sample languages/en.php
cp languages/de.php.sample languages/de.php
```

Then open them in a text editor and fill in your personal data. Each array is well-structured. Feel free to add your own language by just copying the file and give it the appropriate name.

### 3. 🧩 Add Font Awesome

Download Font Awesome (free) from [fontawesome.com](https://fontawesome.com/download) and place it in the following directory structure **relative to `index.php`**:

```
languages/
fontawesome/
├── css/
│   └── all.css
└── webfonts/
    └── ... (font files)
index.php
styles.css
```

Make sure `fontawesome/css/all.css` is available at runtime.

## 🧑‍💻 Configuration Parameters

You can modify the résumé behaviour using simple **URL query parameters**:

| Parameter         | Usage Example                    | Effect                                           |
|------------------|----------------------------------|--------------------------------------------------|
| `?lang=en`        | `index.php?lang=en`              | Switches language (either `en` or `de`)          |
| `?theme=dark`     | `index.php?theme=dark`           | Forces dark mode (`light` also available)        |
| `?print`          | `index.php?print`                | Enables print-optimised layout (forces light)    |
| `?contactdetails` | `index.php?contactdetails`       | Shows extended contact info (e.g. phone, address)|
| Combined          | `index.php?lang=de&theme=dark`   | Combine multiple options freely                  |

## 📚 Courses Feature (Optional)

In the `education` section, courses can be defined with a special `fav:` prefix to visually highlight your favourites.

```php
'courses' => [
  'fav:Machine Learning (1,0)',
  'Advanced Databases (1,3)',
]
```

If you don’t want to list any courses, you can leave the `courses` array empty or remove it entirely.

## Screenshots
### Light Mode
![Resume in light mode](https://alexanderclausen.com/portfolio/projects/resume/resume_light.png)

### Dark Mode
![Resume in dark mode](https://alexanderclausen.com/portfolio/projects/resume/resume_dark.png)

## 📄 Print-Optimised Layout

To get a clean, printable layout:

1. Open your résumé using `?print`
2. Press `Ctrl+P` or use your browser’s print dialog
3. Font colours, underlines, and sections are adjusted for better paper readability
4. You might have to adjust the scale or manually change the stylesheet to have page breaks where you prefer them

## 💡 Customisation Tips

- The structure supports any number of sections (`projects`, `skills`, etc.)
- Icons for skills, contacts, and tech stacks use Font Awesome classes
- You can fully localise content in `languages/*.php` (e.g. `education_section`, `contact_section`, etc.)
- You can set the contact information that should be hidden without the `?contactdetails` URL parameter by setting `'extended-only'` to true (usually hidden) or false (always shown) - you have to individually set it for every language, though

## 🙋‍♂️ Author

Created by [Alexander Clausen](https://alexanderclausen.com)  
README.md was partly written by Generative AI.
Feel free to fork, customise, and share.
