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
            fontFamily: {
                sans: ['Inter Var', 'Montserrat', ...defaultTheme.fontFamily.sans],
                      'montserrat': ['Montserrat', 'sans-serif'],
            },
            colors: {
                'gradient-yellow': '#F9CD32',
                'gradient-pink': '#7533A9',
                'gradient-purple': '#7533A9',
                'gradient-blue': '#151BB9',
                'gold': '#FFD700',
                'silver': '#C0C0C0',
                'bronze': '#CD7F32',	
            }
        },
    },

    darkMode: 'class',

    plugins: [forms, typography],
};
