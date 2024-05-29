/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './public/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                accent: '#f97316',
            },
        },
    },
    plugins: [],
}
