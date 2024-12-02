import formsPlugin from '@tailwindcss/forms';
import prelinePlugin from 'preline/plugin.js';

/** @type {import('tailwindcss').Config} */
// @ts-ignore
export default {
  darkMode: "class",
  mode: "jit",
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    'node_modules/preline/dist/*.js',
  ],
  theme: {
    extend: {
      container: {
        padding: "1rem",
        center: true
      },
      colors: {
        "primary": "#2A342E",
        "secondary": "#46564D",
        "tertiary": "#657A6E",
        "accent": "#AAC8A7",
        "primary-dark": "#D5EFDF",
        "secondary-dark": "#A7C8B5",
        "tertiary-dark": "#85A091",
        "success": "#22c55e",
        "caution": "#eab308",
        "danger": "#ef4444",
        "info": "#60a5fa",
      }
    },
  },
  plugins: [
    formsPlugin, prelinePlugin
  ],
  safelist: [
    "bg-cover",
  ],
}