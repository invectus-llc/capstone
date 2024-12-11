/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
        backgroundImage:{
            'hero-pattern': "url('/public/images/peoples-center-and-library.jpg')"
        },
    },
  },
  darkMode: 'media',
  plugins: [
    require('flowbite/plugin')
  ],
}

