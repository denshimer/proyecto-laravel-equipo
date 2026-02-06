import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Instrument Sans', ...defaultTheme.fontFamily.sans],
                display: ['Instrument Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'sici-dark': '#0a0a0a',
                'sici-card': '#1a1a1a',
                'sici-red': '#dc2626',
                'sici-redDark': '#991b1b',
                'sici-muted': '#9ca3af',
                'sici-light': '#e5e7eb',
            },
        },
    },
    plugins: [forms],
};
