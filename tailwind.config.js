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
                    }
                }
            },
            boxShadow: {
                dashboard: {
                    card: '0px 0px 12px 0px rgb(120 146 141 / 6%)'
                },
            }
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
