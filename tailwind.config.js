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
                'crew': {
                    '50': '#fff8eb',
                    '100': '#ffebc6',
                    '200': '#ffd388',
                    '300': '#ffb74a',
                    '400': '#ff9919',
                    '500': '#f97707',
                    '600': '#dd5302',
                    '700': '#b73606',
                    '800': '#94290c',
                    '900': '#7a220d',
                    '950': '#460f02',
                },
                'participant': {
                    '50': '#eef4ff',
                    '100': '#d9e5ff',
                    '200': '#bcd2ff',
                    '300': '#8eb5ff',
                    '400': '#598dff',
                    '500': '#3666ff',
                    '600': '#1b40f5',
                    '700': '#142de1',
                    '800': '#1726b6',
                    '900': '#19268f',
                    '950': '#141a57',
                },
                'partner': {
                    '50': '#fbf6fd',
                    '100': '#f6ebfc',
                    '200': '#edd7f7',
                    '300': '#e0b7f0',
                    '400': '#ce8ce6',
                    '500': '#b862d6',
                    '600': '#9c40b9',
                    '700': '#833299',
                    '800': '#6c2b7d',
                    '900': '#5c2867',
                    '950': '#390f43',
                },
            }
        },
    },

    darkMode: 'class',

    plugins: [forms, typography],
};
