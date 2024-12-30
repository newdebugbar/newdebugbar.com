import defaultTheme from 'tailwindcss/defaultTheme'
import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
    ],

    plugins: [
        forms,
        typography,
    ],

    theme: {
        container: {
            center: true,
            padding: '1rem',
        },

        extend: {
            fontFamily: {
                sans: ['Outfit', ...defaultTheme.fontFamily.sans],
            },

            screens: {
                ...defaultTheme.screens,
                '2xl': '1440px',
            },
        },
    },
}
