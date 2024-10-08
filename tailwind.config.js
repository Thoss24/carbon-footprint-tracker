import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                greenBorder: '#badbcc',
                greenBg: '#d1e7dd',
                greenText: '#0f5132'
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            screens: { 
                'sm': '900px', 
                'md': '1024px', 
                'lg': '1280px', 
                'xl': '1920px', 
              }, 
        },
        variants: {

        },
    },

    plugins: [forms, typography],
};
