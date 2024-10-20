require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Tailwind Dark Mode. Credit: https://flowbite.com/docs/customize/dark-mode/
var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Force dark mode icons to be visible if present
if (themeToggleLightIcon) {
    themeToggleLightIcon.classList.remove('hidden');  // Always show the dark mode icon
}
if (themeToggleDarkIcon) {
    themeToggleDarkIcon.classList.add('hidden');  // Hide the light mode icon
}

// Force dark mode for everyone, regardless of localStorage or system preference
document.documentElement.classList.add('dark');