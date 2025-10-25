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
            colors:{
                'gold':{

                '50': '#FFFBEB',  // Nagyon halvány
                '100': '#FEF3C7', // Halvány
                '300': '#FCD34D', // Világos
                '500': '#D4AF37', // A "klasszikus" arany
                '700': '#B8860B', // Sötétebb arany
                '900': '#785508', // Nagyon sötét
                
                }
            },

            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
