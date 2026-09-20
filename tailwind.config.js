/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/views/**/*.php"],
  theme: {
    extend: {
      colors: {
        desaPrimary: '#2F855A',
        desaSecondary: '#2563EB',
        desaThird: '#F2F8F4',
        desaAltBg: '#F7F9FC',
        desaHighlight: '#E2E8F0',
        desaHighlightText: '#172033',
      },
      fontFamily: {
        jakarta: ['"Plus Jakarta Sans"', 'sans-serif'],
      }
    },
  },
  plugins: [],
}