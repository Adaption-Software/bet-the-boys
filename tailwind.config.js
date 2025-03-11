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
                },
                "secondary": {
                    50: "#E8E8E8",
                    100: "#D1D1D1",
                    200: "#A1A1A1",
                    300: "#737373",
                    400: "#454545",
                    500: "#151515",
                    600: "#121212",
                    700: "#0D0D0D",
                    800: "#080808",
                    900: "#050505",
                    950: "#030303"
                },
                "tertiary": {
                    50: "#DBFDFF",
                    100: "#B8FAFF",
                    200: "#70F5FF",
                    300: "#29F1FF",
                    400: "#00D1E0",
                    500: "#008E97",
                    600: "#00727A",
                    700: "#00565C",
                    800: "#00393D",
                    900: "#001D1F",
                    950: "#000E0F"
                }
            }
        },
    },

    plugins: [forms],
};
