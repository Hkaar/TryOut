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
        "primary": "#435334",
        "secondary": "#9EB384",
        "tertiary": "#F6FFDE",
        "accent": "#AAC8A7",
        "primary-dark": "#D5EFDF",
        "secondary-dark": "#A7C8B5",
        "tertiary-dark": "#85A091",
        "success": "#22c55e",
        "caution": "#eab308",
        "danger": "#ef4444",
        "info": "#60a5fa",
        "exam-bg": "#AAC8A7",
      },
      boxShadow: {
        "dp-sm": "0px 0px 20px 5px rgba(158, 179, 132, 1)",
        "dp": "0px 0px 35px 5px rgba(158, 179, 132, 1)",
        "dp-md": "0px 0px 50px 5px rgba(158, 179, 132, 1)",
        "dp-lg": "0px 0px 75px 5px rgba(158, 179, 132, 1)",
        "dp-xl": "0px 0px 100px 5px rgba(158, 179, 132, 1)",
      }
    },
  },
  plugins: [
    formsPlugin, prelinePlugin
  ],
  safelist: [
    "bg-cover",
    "shadow-dp-sm",
    "shadow-dp",
    "shadow-dp-md",
    "shadow-dp-lg",
    "shadow-dp-xl"
  ],
}