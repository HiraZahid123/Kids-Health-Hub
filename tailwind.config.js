import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                khh: {
                    coral:   '#de6148',
                    yellow:  '#f3ce66',
                    blue:    '#79a2cc',
                    green:   '#0dc066',
                    red:     '#e64738',
                    lime:    '#98e762',
                    amber:   '#fcc333',
                    salmon:  '#e78572',
                    sage:    '#a8cf77',
                },
            },
        },
    },

    plugins: [forms],
};
