import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "primary": {
                    50: "#E8E8E8",
                    100: "#CFCFCF",
                    200: "#9E9E9E",
                    300: "#6E6E6E",
                    400: "#3D3D3D",
                    500: "#0E0E0E",
                    600: "#0A0A0A",
                    700: "#080808",
                    800: "#050505",
                    900: "#030303",
                    950: "#030303"
                }
            }
        },
    },

    plugins: [forms],
};
