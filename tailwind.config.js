import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/views/**/*.js',
        "./node_modules/flowbite/**/*.js"
    ],

    theme: {
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            'accent': {
                light: '#83E2C0',
                regular: '#37D7A7',
                dark: '#00C280',
                darker: '#009F65'
            },
            'secondary': {
                light: '#EB5180',
                regular: '#D73767',
                dark: '#C03361',
            },
            'gray': {
                light: '#EAEBEC',
                regular: '#B8B9BA',
                dark: '#98999A',
            },
            'neutral': {
                black: '#212121',
                white: '#F9F9FB',
            }
        },
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                ...colors
            }
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin')
    ],
};
