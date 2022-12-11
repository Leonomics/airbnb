module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      colors: {
        gray: {
          300: '#C3C6D1',
          500: '#5F697D',
          700: '#183153',
        },
        brand: {
          300: '#FF9CAE',
          400: '#FF6A85',
          500: '#FF385C',
        },
      }
    },
    fontSize: {
      sm: ['0.875rem', '1.25rem'],
      base: ['1rem', '1.5rem'],
      xl: ['1.25rem', '1.75rem'],
      '2xl': ['1.5rem', '2rem'],
      '3xl': ['1.875rem', '2.25rem'],
      '4xl': ['2.25rem', '2.5rem'],
      '5xl': ['3rem', '1'],
      '6xl': ['3.75rem', '1'],
    },
    container: {
      center: true,
      padding: {
        default: '1rem',
        sm: '1.5rem',
        lg: '2rem',
        xl: '2.5rem',
        '2xl': '3rem',
      }
    },
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
