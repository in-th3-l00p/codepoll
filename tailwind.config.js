/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/**/*.php',
    './public/**/*.css',
    './views/**/*.php'
  ],
  theme: {
    extend: {},
  },
  plugins: [
      require('@tailwindcss/forms'),
  ],
}

