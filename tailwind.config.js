const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Urbanist', 'Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                dashboard: '#EDECFC',
                purple: {
                    1000: '#8C91B6',
                    1100: '#827af3',
                    dashboard: {
                        gradient: {
                            1: '#827af3',
                            2: '#b47af3'
                        }
                    },
                    validation: '#827AF3'
                },
                primary: '#5252D4',
                secondary: '#4A4A68',
                tertiary: '#ECF1F4',
                quaternary: '#F8F8F9'
            },
            boxShadow: {
                dashboard: {
                    card: '0px 0px 12px 0px rgb(120 146 141 / 6%)'
                },
                main: '0px 0px 25px 0px rgb(45 69 95 / 10%)'
            },
            maxWidth: {
                '8xl': '1536px',
            },
            backgroundImage: {
                'autentikasi': "url('@src/images/landing/Autentikasi Scan.png')",
            }
        },
    },
    variants: {
        accentColor: ['responsive', 'dark', 'group-hover', 'focus-within', 'hover', 'focus'] // Listed are the defaults
    },

    plugins: [require('@tailwindcss/forms')],
};
