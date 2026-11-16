/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./projects/**/*.html",
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
        ink: '#0B1120',
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
      }
    },
  },
  plugins: [],
}
