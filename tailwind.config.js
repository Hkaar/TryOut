/** @type {import('tailwindcss').Config} */
export default {
  darkMode: "selector",
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
        primary: "#2A342E",
        secondary: "#46564D",
        tertiary: "#657A6E",
        primary_dark: "#D5EFDF",
        secondary_dark: "#A7C8B5",
        tertiary_dark: "#85A091",
        success: "#22c55e",
        caution: "#eab308",
        danger: "#ef4444",
        info: "#60a5fa",
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('preline/plugin'),
  ],
}