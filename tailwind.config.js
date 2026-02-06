import defaultTheme from 'tailwindcss/defaultTheme';

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
            colors: {
                //Variables de estilo
                sici: {
                    dark: '#0B0E14',      // Fondo principal
                    card: '#1B2230',      // Fondo secundario/tarjetas
                    red: '#EF4444',       // Botones
                    redDark: '#DC2626',   // Hover botones
                    light: '#F3F4F6',     // Texto principal
                    muted: '#9CA3AF',     // Texto secundario
                }
            }
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
