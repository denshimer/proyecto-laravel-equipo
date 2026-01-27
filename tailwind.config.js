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
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Barlow', 'sans-serif'],
                mono: ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
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
