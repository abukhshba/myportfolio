/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./**/*.html",
    "./assets/js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {
        primary: '#111827',
        textMain: '#1F2937',
        accent: '#2563EB',
        bgMain: '#FFFFFF',
        bgSecondary: '#F9FAFB',
        borderMain: '#E5E7EB',
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
