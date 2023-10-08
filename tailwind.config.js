/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        'sand': {
          50: '#fdfcfb',
          100: '#fbf8f4',
          200: '#f6f0e6',
          300: '#f0e8d7',
          400: '#e2d9ba',
          500: '#d4ca9d',
          600: '#bfb48c',
          700: '#a59e7a',
          800: '#8a8868',
          900: '#6e6f57',
        },
      },
      fontFamily: {
        'libre': ['"Libre Baskerville", "Open Sans"', 'sans-serif'],
        'poppins': ['"Poppins", "Open Sans"', 'sans-serif'],
        'sen': ['"Sen", "Open Sans"', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
